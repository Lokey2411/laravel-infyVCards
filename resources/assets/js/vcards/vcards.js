$(document).on("click", ".vcardStatus", function () {
    let vcardId = $(this).data("id");
    let updateUrl = route("vcard.status", vcardId);
    $.ajax({
        type: "get",
        url: updateUrl,
        success: function (response) {
            displaySuccessMessage(response.message);
            Livewire.emit("refresh");
        },
    });
});

listen("click", ".vcard_delete-btn", function (event) {
    let vcardDeleteId = $(event.currentTarget).data("id");
    let url = route("vcards.destroy", { vcard: vcardDeleteId });
    deleteItem(url, "VCard");
});

window.deleteVcard = function (url, header) {
    var callFunction =
        arguments.length > 3 && arguments[3] !== undefined
            ? arguments[3]
            : null;
    Swal.fire({
        title: Lang.get("js.delete") + " !",
        text: Lang.get("js.are_you_sure") + '"' + header + '" ?',
        type: "warning",
        icon: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        cancelButtonText: Lang.get("js.no"),
        confirmButtonText: Lang.get("js.yes"),
        confirmButtonColor: "#009ef7",
    }).then(function (result) {
        if (result.isConfirmed) {
            deleteVcardAjax(url, header, callFunction);
        }
    });
};

function deleteVcardAjax(url, header, callFunction = null) {
    $.ajax({
        url: url,
        type: "DELETE",
        dataType: "json",
        success: function (obj) {
            if (obj.success) {
                Livewire.emit("refresh");
            }
            obj.data.make_vcard
                ? $(".create-vcard-btn").removeClass("d-none")
                : $(".create-vcard-btn").addClass("d-none");
            Swal.fire({
                title: Lang.get("js.deleted") + " !",
                text: header + Lang.get("js.has_been_deleted"),
                icon: "success",
                timer: 2000,
                confirmButtonColor: "#009ef7",
            });
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            Swal.fire({
                title: "Error",
                icon: "error",
                text: data.responseJSON.message,
                type: "error",
                timer: 5000,
                confirmButtonColor: "#009ef7",
            });
        },
    });
}

listen("click", ".duplicate-vcard-btn", function (event) {
    let duplicateId = $(event.currentTarget).data("id");
    swal({
        title: Lang.get("js.duplicate"),
        text: Lang.get("js.are_you_sure_dublicate_vcard"),
        buttons: {
            confirm: Lang.get("js.duplicate"),
            cancel: Lang.get("js.no"),
        },
        reverseButtons: true,
        icon: "warning",
    }).then(function (willDuplicate) {
        if (willDuplicate) {
            duplicateItemAjax(
                duplicateId,
                route("duplicate.vcard", duplicateId)
            );
        }
    });
});

function duplicateItemAjax(id, url) {
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        success: function (obj) {
            if (obj.success) {
                window.livewire.emit("resetPageTable");
                livewire.emit("refresh");
            }
            swal({
                icon: "success",
                title: Lang.get("js.duplicate_vcard"),
                text: Lang.get("js.duplicate_vcard_create"),
                timer: 2000,
                buttons: {
                    confirm: Lang.get("js.ok"),
                },
            });
            // if (callFunction) {
            //     eval(callFunction);
            // }
        },
        error: function (data) {
            swal({
                title: "Error",
                icon: "error",
                text: data.responseJSON.message,
                type: "error",
                timer: 4000,
            });
        },
    });
}

document.addEventListener("turbo:load", loadVcardQRCode);

function loadVcardQRCode() {
    setTimeout(() => {
        $(".vcard-qr-code-btn").each(function () {
            const svg = $(this).parent().find("svg")[0];
            const { x, y, width, height } = svg.viewBox.baseVal;
            const blob = new Blob([svg.outerHTML], { type: "image/svg+xml" });
            const url = URL.createObjectURL(blob);
            const image = document.createElement("img");
            image.src = url;
            image.addEventListener("load", () => {
                const canvas = document.createElement("canvas");
                canvas.width = width;
                canvas.height = height;
                const context = canvas.getContext("2d");
                context.drawImage(image, x, y, width, height);
                $(this).attr("href", canvas.toDataURL());
                URL.revokeObjectURL(url);
            });
        });
    }, 200);
}

listen("change", "#verified", function () {
    window.livewire.emit("verifiedFilter", $(this).val());
    hideDropdownManually($("#vcardFilterBtn"), $("#userFilter"));
});

listen("change", "#status", function () {
    window.livewire.emit("statusFilter", $(this).val());
    hideDropdownManually($("#vcardFilterBtn"), $("#userFilter"));
});

listen('click', '#vcardResetFilter', function () {
    $('#verified').val(2).change()
    $('#status').val(2).change()
    window.livewire.emit('verifiedFilter', "");
    window.livewire.emit('statusFilter', "");
    hideDropdownManually($('#vcardFilterBtn'), $('#userFilter'))
})

listen('click', '#vcardFilterBtn', function () {
    openDropdownManually($('#vcardFilterBtn'), $('#userFilter'))
})
