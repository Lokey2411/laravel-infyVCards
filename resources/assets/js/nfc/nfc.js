document.addEventListener("turbo:load", loadNFCData);

function loadNFCData() {
    $("#vcard-id").select2({
        placeholder: "Select Vcard",
    });

    $("#NFC-card-type").select2({
        placeholder: "Select Card Type",
    });
}

listenChange("#vcard-id", function (e) {
    e.preventDefault();
    let vcardId = $("#vcard-id").val();
    $.ajax({
        url: route("vcard-data"),
        type: "GET",
        data: { vcardId: vcardId },
        success: function (result) {
            if (result.success) {
                let name = result.data.first_name + " " + result.data.last_name;
                $("#e-card-name").val(name);
                $("#e-card-email").val(result.data.email);
                $("#e-card-occupation").val(result.data.occupation);
                $("#e-card-location").val(result.data.location);
                $("#phoneNumber").val(result.data.phone);
                $("#companyName").val(result.data.company);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenChange('#paymentType', function () {
    let paymentType = $('#paymentType').val();
    let form = $('.order-nfc-card-form');
    if (paymentType == 4) {
        form.removeAttr('id');
        form.attr('action', route('nfc.order.store'));
    }else{
        form.removeAttr('action');
        form.attr('id', 'orderNfcForm');
    }
});

listenClick(".nfc-img-radio", function () {
    $(".nfc-price").addClass("d-none");
    $(".nfc-img-radio").removeClass("img-border");
    $(this).addClass("img-border");
    $("#card-id").val($(this).attr("data-id"));
    $(this).parent().find(".nfc-price").removeClass("d-none");
});

listenSubmit('#orderNfcForm', function (e) {
    e.preventDefault()
    $('#order-btn').prop('disabled',true)
    $.ajax({
        url: route('nfc.order.store'),
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                if(!isEmpty(result.data)){
                    if (result.data.payment_method == 1) {
                        let sessionId = result.data[0].sessionId;
                        stripe.redirectToCheckout({
                            sessionId: sessionId,
                        });
                    }

                    if (result.data.payment_method == 3) {
                        let { id, amount, name, email, contact } = result.data[0]

                        options.amount = amount
                        options.order_id = id
                        options.prefill.name = name
                        options.prefill.email = email
                        options.prefill.contact = contact
                        let razorPay = new Razorpay(options)
                        razorPay.open()
                        razorPay.on('nfc.payment.failed')
                        return false;
                    }

                    if (result.data.payment_method == 2) {
                        if (result.data[0].original.link) {
                            window.location.href = result.data[0].original.link
                        }

                        if (result.data[0].original.statusCode === 201) {
                            let redirectTo = ''

                            $.each(result.data[0].original.result.links,
                                function (key, val) {
                                    if (val.rel == 'approve') {
                                        redirectTo = val.href
                                    }
                                })
                            location.href = redirectTo
                        }
                    }

                    if (result.data.payment_method == 6) {
                        if (result.data[0].original.link) {
                            window.location.href = result.data[0].original.link
                        }

                        if (result.data[0].original.statusCode === 201) {
                            let redirectTo = ''

                            $.each(result.data[0].original.result.links,
                                function (key, val) {
                                    if (val.rel == 'approve') {
                                        redirectTo = val.href
                                    }
                                })
                            location.href = redirectTo
                        }
                    }

                    if(result.data.payment_method == 4) {
                        location.href = route('user.orders');
                    }
                }
                $('#order-btn').prop('disabled',false)
                resetModalForm('#orderNfcForm');
                displaySuccessMessage(result.message);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#order-btn').prop('disabled',false)
        },
    })
})

listenClick('#paymentStatus', function () {
    let transactionId = $(this).data('id')
    let updateUrl = route('nfc.payment.status',transactionId)
    $.ajax({
        type: 'get',
        url: updateUrl,
        success: function (response) {
            displaySuccessMessage(response.message)
            Livewire.emit('resetPageTable')
        },
    })
})

listenClick('.order-status', function () {
    let status = $(this).data('status')
    let orderId = $(this).parents("ul").next().val();
    let updateUrl = route('nfc.order.status',orderId)
    $.ajax({
        type: 'get',
        url: updateUrl,
        data: {status: status},
        success: function (response) {
            displaySuccessMessage(response.message)
            Livewire.emit('resetPageTable')
        },
    })
})

// NFC Card Type Filter

listen('change', '#cardType', function () {
    window.livewire.emit('changeFilter', $(this).val());
    hideDropdownManually($('#cardTypeFilterBtn'), $('#cardTypeFilter'))
})
listen('change', '#appointmentStatus', function () {
    window.livewire.emit('changeFilterStatus', $(this).val());
    hideDropdownManually($('#cardTypeFilterBtn'), $('#cardTypeFilter'))
})

listen('click', '#cardTypeResetFilter', function () {
    $('#cardType').val(0);
    window.livewire.emit('changeFilter', "");
    window.livewire.emit('changeFilterStatus', "");
    hideDropdownManually($('#cardTypeFilterBtn'), $('#cardTypeFilter'))
})

