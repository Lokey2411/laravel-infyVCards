@extends('layouts.app')
@section('title')
    {{ __('messages.nfc.order_nfc') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>{{ __('messages.nfc.order_nfc') }}</h1>
            <a class="btn btn-outline-primary float-end"
                href="{{ route('user.orders') }}">{{ __('messages.common.back') }}</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form data-turbo="false" method="post" id="orderNfcForm" class="order-nfc-card-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('messages.nfc.nfc_card_type') }}</label>
                        </div>
                        @foreach ($nfcCards as $nfcCard)
                            <div class="col-md-4 col-sm-6 g-5 nfccard">
                                <div class="card nfc-img-radio img-fluid" data-id={{ $nfcCard['id'] }}>
                                    <img src="{{ $nfcCard['media'][0]['original_url'] }}"
                                        class="card-img-top rounded nfc-card-img"
                                        alt="{{ $nfcCard['media'][0]['original_url'] }}" />
                                </div>
                                <div class="text-center mt-5 me-5 nfc-price d-none" id="nfc-price">
                                    <p class="fw-bold ">
                                        {{ $currency . number_format($nfcCard['price'], 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                        <input type="hidden" name="card_type" id="card-id">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.vcard.vcard_name') }}</label>
                            <select id="vcard-id" name="vcard_id" required>
                                <option selected disabled>{{ __('messages.nfc.select_vcard') }}</option>
                                @foreach ($vcards as $id => $vcard)
                                    <option value="{{ $id }}" @selected(old('vcard_id'))>{{ $vcard }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.nfc.company_name') }}</label>
                            <input type="text" class="form-control" name="company_name" id="companyName" required
                                value="{{ old('company_name') }}" placeholder="{{ __('messages.form.company') }}">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.common.name') }}</label>
                            <input type="text" class="form-control" name="name" id="e-card-name" required
                                value="{{ old('name') }}" placeholder="{{ __('messages.form.enter_name') }}">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.common.email') }}</label>
                            <input type="text" class="form-control" name="email" id="e-card-email" required
                                value="{{ old('email') }}" placeholder="{{ __('messages.form.enter_email') }}">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.common.phone') }}</label>
                            <input type="number" class="form-control" name="phone" id="phoneNumber" required
                                placeholder="{{ __('messages.form.enter_phone') }}" value="{{ old('phone') }}">
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.nfc.designation') }}</label>
                            <input type="text" class="form-control" name="designation" id="e-card-occupation" required
                                value="{{ old('designation') }}" placeholder="{{ __('messages.form.designation') }}">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.setting.shipping_address') }}</label>
                            <input type="text" class="form-control" name="address" id="e-card-location" required
                                value="{{ old('address') }}" placeholder="{{ __('messages.nfc.enter_address') }}">
                        </div>
                        @php
                            $translatedPaymentTypes = collect($paymentTypes)->map(function ($value) {
                                return trans('messages.' . $value);
                            });
                        @endphp
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">{{ __('messages.select_payment_type') }}</label>
                            {{ Form::select('payment_method', $translatedPaymentTypes, null, ['class' => 'form-select', 'required', 'id' => 'paymentType', 'data-control' => 'select2', 'placeholder' => __('messages.select_payment_type')]) }}

                        </div>
                        
                    </div>

                    <div class="col-lg-6 mt-3">
                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <div class="mb-3" io-image-input="true">
                                    <label for="appLogoPreview"
                                        class="form-label required">{{ __('messages.nfc.logo') }}</label>
                                    <div class="d-block">
                                        <div class="image-picker">
                                            <div class="image previewImage" id="appLogoPreview"
                                                style="background-image: url('{{ asset('assets/img/nfc/nfc_default_logo.png') }}')">
                                            </div>
                                            <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                data-bs-toggle="tooltip" data-placement="top"
                                                data-bs-original-title="{{ '' }}">
                                                <label>
                                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                    <input type="file" id="compan" name="logo"
                                                        class="image-upload d-none" accept="image/*" />
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mb-3">
                                  @if (getSuperAdminSettingValue('is_manual_payment_guide_on'))
                                <div class="col-12 d-none mt-5 plan-controls manuallyPayAttachment">
                                    <label
                                        class="form-label text-muted mb-5 pb-md-3">{{ __('messages.vcard.manual_payment_guide') }}
                                        :-</label>
                                    {!! getSuperAdminSettingValue('manual_payment_guide') !!}
                                </div>
                            @endif
                            </div>

                            <div class="col-lg-12 d-flex mt-5">
                                <button type="submit" class="btn btn-primary me-3" id="order-btn">
                                    {{ __('messages.nfc.order') }}
                                </button>
                                <a href="{{ route('user.orders') }}"
                                    class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@pushOnce('scripts')
    <script>
        let options = {
            'key': "{{ getSelectedPaymentGateway('razorpay_key') }}",
            'amount': 0, //  100 refers to 1
            'currency': 'INR',
            'name': "{{ getAppName() }}",
            'order_id': '',
            'description': '',
            'image': '{{ asset(getAppLogo()) }}', // logo here
            'callback_url': "{{ route('nfc.razorpay.success') }}",
            'prefill': {
                'email': '', // recipient email here
                'name': '', // recipient name here
                'contact': '', // recipient phone here
            },
            'readonly': {
                'name': 'true',
                'email': 'true',
                'contact': 'true',
            },
            'theme': {
                'color': '#0ea6e9',
            },
            'modal': {
                'ondismiss': function() {
                    $('#paymentGatewayModal').modal('hide');
                    displayErrorMessage(Lang.get('js.payment_not_complete'));
                    setTimeout(function() {
                        Turbo.visit(window.location.href);
                    }, 1000);
                },
            },
        };
    </script>
@endPushOnce
