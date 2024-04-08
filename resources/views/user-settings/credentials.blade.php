    @extends('layouts.app')
    @section('title')
        {{ __('messages.setting.credentials') }}
    @endsection
    @section('content')
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <div class="col-12">
                    @include('layouts.errors')
                    @include('flash::message')
                    @include('user-settings.setting_menu')
                    <div class="card">
                        <div class="card-body">
                            {{ Form::open(['route' => 'user.setting.update', 'id' => 'UserCredentialsSettings', 'files' => true, 'class' => 'form']) }}
                            {{ Form::hidden('sectionName', $sectionName) }}
                            <div class="row">

                                {{--  STRIPE --}}
                                <div class="col-12 d-flex align-items-center">
                                    <span class="fs-3 my-3 me-3">{{ __('messages.setting.stripe') }}</span>
                                    <label class="form-switch">
                                        <input type="checkbox" name="stripe_enable" class="form-check-input stripe-enable"
                                            value="1" {{ !empty($setting['stripe_enable']) == '1' ? 'checked' : '' }}
                                            id="stripeEnable">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                                <div
                                    class="stripe-div {{ !empty($setting['stripe_enable']) == '1' ? '' : 'd-none' }} col-12">
                                    <div class="row">
                                        <div class="form-group col-sm-6 mb-5">
                                            {{ Form::label('stripe_key', __('messages.setting.stripe_key') . ':', ['class' => 'form-label']) }}
                                            {{ Form::text('stripe_key', isset($setting['stripe_key']) ? $setting['stripe_key'] : null, ['class' => 'form-control', 'id' => 'stripeKey', 'placeholder' => __('messages.setting.stripe_key')]) }}
                                        </div>
                                        <div class="form-group col-sm-6 mb-5">
                                            {{ Form::label('stripe_secret', __('messages.setting.stripe_secret') . ':', ['class' => 'form-label']) }}
                                            {{ Form::text('stripe_secret', isset($setting['stripe_secret']) ? $setting['stripe_secret'] : null, ['class' => 'form-control', 'id' => 'stripeSecret', 'placeholder' => __('messages.setting.stripe_secret')]) }}
                                        </div>
                                    </div>
                                </div>
                                {{--  PAYSTACK --}}
                                <div class="col-12 d-flex align-items-center">
                                    <span class="fs-3 my-3 me-3">{{ __('messages.setting.paystack') }}</span>
                                    <label class="form-switch">
                                        <input type="checkbox" name="paytack_enable"
                                            class="form-check-input paystack-enable" value="1"
                                            {{ !empty($setting['paytack_enable']) == '1' ? 'checked' : '' }}
                                            id="paystackEnable">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                                <div
                                    class="paystack-div {{ !empty($setting['paytack_enable']) == '1' ? '' : 'd-none' }} col-12">
                                    <div class="row">
                                        <div class="form-group col-sm-6 mb-5">
                                            {{ Form::label('paystack_key', __('messages.setting.paystack_key') . ':', ['class' => 'form-label']) }}
                                            {{ Form::text('paystack_key', isset($setting['paystack_key']) ? $setting['paystack_key'] : null, ['class' => 'form-control', 'id' => 'paystackKey', 'placeholder' => __('messages.setting.paystack_key')]) }}
                                        </div>
                                        <div class="form-group col-sm-6 mb-5">
                                            {{ Form::label('paystack_secret', __('messages.setting.paystack_secret') . ':', ['class' => 'form-label']) }}
                                            {{ Form::text('paystack_secret', isset($setting['paystack_secret']) ? $setting['paystack_secret'] : null, ['class' => 'form-control', 'id' => 'paystackSecret', 'placeholder' => __('messages.setting.paystack_secret')]) }}
                                        </div>
                                    </div>
                                </div>
                                {{--  Phonepe --}}
                                <div class="col-12 d-flex align-items-center">
                                    <span class="fs-3 my-3">{{ __('messages.setting.phonepe') }}</span>
                                    <label class="form-check form-switch ms-3">
                                        <input type="checkbox" name="phonepe_enable" class="form-check-input phonepe-enable"
                                            value="1" {{ !empty($setting['phonepe_enable']) == '1' ? 'checked' : '' }}
                                            id="phonepeEnable">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                                <div
                                    class="phonepe-div {{ !empty($setting['phonepe_enable']) == '1' ? '' : 'd-none' }} col-12">
                                    <div class="row">
                                        <div class="form-group col-lg-6 mb-5">
                                            {{ Form::label('phonepe_merchant_id', __('messages.setting.phonepe_merchant_id') . ':', ['class' => 'form-label mb-3']) }}
                                            {{ Form::text('phonepe_merchant_id', isset($setting['phonepe_merchant_id']) ? $setting['phonepe_merchant_id'] : null, ['class' => 'form-control  phonepe_merchant_id', 'id' => 'phonepeMerchantId', 'placeholder' => __('messages.setting.phonepe_merchant_id')]) }}
                                        </div>
                                        <div class="form-group col-lg-6 mb-5">
                                            {{ Form::label('phonepe_merchant_user_id', __('messages.setting.phonepe_merchant_user_id') . ':', ['class' => 'form-label stripe-secret-label mb-3']) }}
                                            {{ Form::text('phonepe_merchant_user_id', isset($setting['phonepe_merchant_user_id']) ? $setting['phonepe_merchant_user_id'] : null, ['class' => 'form-control phonepe_merchant_user_id ', 'id' => 'phonepeMerchantUserId', 'placeholder' => __('messages.setting.phonepe_merchant_user_id')]) }}
                                        </div>
                                        <div class="form-group col-lg-6 mb-5">
                                            {{ Form::label('phonepe_env', __('messages.setting.phonepe_env') . ':', ['class' => 'form-label mb-3']) }}
                                            {{ Form::text('phonepe_env', isset($setting['phonepe_env']) ? $setting['phonepe_env'] : null, ['class' => 'form-control  phonepe_env ', 'id' => 'phonepeEnv', 'placeholder' => __('messages.setting.phonepe_env')]) }}
                                        </div>
                                        <div class="form-group col-lg-6 mb-5">
                                            {{ Form::label('phonepe_salt_key', __('messages.setting.phonepe_salt_key') . ':', ['class' => 'form-label stripe-secret-label mb-3']) }}
                                            {{ Form::text('phonepe_salt_key', isset($setting['phonepe_salt_key']) ? $setting['phonepe_salt_key'] : null, ['class' => 'form-control phonepe_salt_key ', 'id' => 'phonepeSaltKey', 'placeholder' => __('messages.setting.phonepe_salt_key')]) }}
                                        </div>
                                        <div class="form-group col-lg-6 mb-5">
                                            {{ Form::label('phonepe_salt_index', __('messages.setting.phonepe_salt_index') . ':', ['class' => 'form-label mb-3']) }}
                                            {{ Form::text('phonepe_salt_index', isset($setting['phonepe_salt_index']) ? $setting['phonepe_salt_index'] : null, ['class' => 'form-control  phonepe_salt_index ', 'id' => 'phonepeSaltIndex', 'placeholder' => __('messages.setting.phonepe_salt_index')]) }}
                                        </div>
                                        <div class="form-group col-lg-6 mb-5">
                                            {{ Form::label('phonepe_merchant_transaction_id', __('messages.setting.phonepe_merchant_transaction_id') . ':', ['class' => 'form-label stripe-secret-label mb-3']) }}
                                            {{ Form::text('phonepe_merchant_transaction_id', isset($setting['phonepe_merchant_transaction_id']) ? $setting['phonepe_merchant_transaction_id'] : null, ['class' => 'form-control phonepe_merchant_transactionId ', 'id' => 'phonepeMerchantTransactionId', 'placeholder' => __('messages.setting.phonepe_merchant_transaction_id')]) }}
                                        </div>
                                    </div>
                                </div>
                                {{--  PAYPAL --}}
                                <div class="col-12 d-flex align-items-center">
                                    <span class="fs-3 my-3">{{ __('messages.setting.paypal') }}</span>
                                    <label class="form-check form-switch ms-3">
                                        <input type="checkbox" name="paypal_enable" class="form-check-input paypal-enable"
                                            value="1" {{ !empty($setting['paypal_enable']) == '1' ? 'checked' : '' }}
                                            id="paypalEnable">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                                <div class="row">
                                    <div
                                        class="form-group col-sm-6 mb-5 paypal-div {{ !empty($setting['paypal_enable']) == '1' ? '' : 'd-none' }} col-12">
                                        {{ Form::label('paypal_client_id', __('messages.setting.paypal_client_id') . ':', ['class' => 'form-label']) }}
                                        {{ Form::text('paypal_client_id', !empty($setting['paypal_client_id']) ? $setting['paypal_client_id'] : null, ['class' => 'form-control', 'id' => 'paypalKey', 'placeholder' => __('messages.setting.paypal_client_id')]) }}
                                    </div>
                                    <div
                                        class="form-group col-sm-6 mb-5 paypal-div {{ !empty($setting['paypal_enable']) == '1' ? '' : 'd-none' }} col-12">
                                        {{ Form::label('paypal_secret', __('messages.setting.paypal_secret') . ':', ['class' => 'form-label']) }}
                                        {{ Form::text('paypal_secret', !empty($setting['paypal_secret']) ? $setting['paypal_secret'] : null, ['class' => 'form-control', 'id' => 'paypalSecret', 'placeholder' => __('messages.setting.paypal_secret')]) }}
                                    </div>
                                    <div
                                        class="form-group col-sm-6 mb-5 paypal-div {{ !empty($setting['paypal_enable']) == '1' ? '' : 'd-none' }} col-12">
                                        {{ Form::label('paypal_mode', __('messages.setting.paypal_mode') . ':', ['class' => 'form-label']) }}
                                        {{ Form::text('paypal_mode', !empty($setting['paypal_mode']) ? $setting['paypal_mode'] : null, ['class' => 'form-control', 'id' => 'paypalMode', 'placeholder' => __('messages.setting.paypal_mode')]) }}
                                    </div>
                                    @if (checkFeature('affiliation'))
                                        <div class="form-group col-sm-6 mb-5">
                                            {{ Form::label('paypal_email', __('messages.setting.paypal_payout_email')) }}
                                            {{ Form::email('paypal_email', !empty($setting['paypal_email']) ? $setting['paypal_email'] : null, ['class' => 'form-control mt-2', 'id' => 'paypalEmail', 'placeholder' => __('messages.setting.paypal_payout_email')]) }}
                                        </div>
                                    @endif
                                    <div class="form-group col-sm-6 mb-5">
                                        {{ Form::label('currency', __('messages.setting.currency') . ':', ['class' => 'form-label required']) }}
                                        <div class="input-group ">
                                            {{ Form::select('currency_id', getCurrencies(), !empty($setting['currency_id']) ? $setting['currency_id'] : null, ['class' => 'form-control', 'required', 'data-control' => 'select2', 'id' => 'userCurrencySettingId', 'placeholder' => __('messages.setting.select_currency')]) }}
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 mb-5">
                                        {{ Form::label('subscription_model_time', __('messages.setting.subscription_time') . ':', ['class' => 'form-label']) }}
                                        {{ Form::text('subscription_model_time', isset($setting['subscription_model_time']) ? $setting['subscription_model_time'] : 5, ['class' => 'form-control', 'id' => 'subscription_model_time', 'placeholder' => __('messages.setting.subscription_time')]) }}
                                    </div>
                                </div>
                                {{-- MANUALLY --}}
                                <div class="col-12 d-flex align-items-center">
                                    <span class="fs-3 my-3">{{ __('messages.setting.manually') }}</span>
                                    <label class="form-check form-switch ms-3">
                                        <input type="checkbox" name="manually_payment"
                                            class="form-check-input manually-payment-enable" value="1"
                                            {{ !empty($setting['manually_payment']) == '1' ? 'checked' : '' }}
                                            id="userManualPaymentSetting">
                                        <span class="custom-switch-indicator"></span>&nbsp;&nbsp;
                                    </label>
                                </div>
                                <div
                                    class="col-lg-10 row user-manually-cred{{ (isset($setting['manually_payment']) && $setting['manually_payment'] == false) || empty($setting['manually_payment']) ? ' d-none' : '' }}">
                                    {{ Form::hidden('manual_payment_guide', isset($setting['manual_payment_guide']) ? $setting['manual_payment_guide'] : '', ['id' => 'manualPaymentGuideData']) }}
                                    <div class="col-lg-12">
                                        <div class="mb-5">
                                            {{ Form::label('manual_payment_guide', __('messages.vcard.manual_payment_guide') . ':', ['class' => 'form-label']) }}
                                            <div id="manualPaymentGuideId" class="editor-height" style="height: 200px">
                                            </div>
                                            {{ Form::hidden('manual_payment_guide', null, ['id' => 'guideData']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="form-group col-sm-3 col-md-3 mb-3">
                                    <label for="time_format"
                                        class="form-label required fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.placeholder.time_format') }}
                                        :</label>
                                    <div class="radio-button-group">
                                        <div class="btn-group btn-group-toggle m-0" data-toggle="buttons">
                                            <input type="radio" name="time_format" id="time_format-0" value="0"
                                                checked=""
                                                {{ !empty($setting['time_format']) == \App\Models\UserSetting::HOUR_12 ? 'checked' : '' }}>
                                            <label for="time_format-0" class="me-2"
                                                role="button">{{ __('messages.placeholder.12_hour') }}</label>
                                            <input type="radio" name="time_format" id="time_format-1" value="1"
                                                {{ !empty($setting['time_format']) == \App\Models\UserSetting::HOUR_24 ? 'checked' : '' }}>
                                            <label for="time_format-1"
                                                role="button">{{ __('messages.placeholder.24_hour') }}</label>
                                        </div>
                                    </div>
                                </div>
                                @if (checkFeature('affiliation'))
                                    <div class="col-sm-3 col-md-3 mb-3">
                                        <div class="form-group mb-3">
                                            <label for="enable_affiliation"
                                                class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.setting.enable_affiliation') }}

                                            </label> <span data-bs-toggle="tooltip" class="mb-3" data-placement="top"
                                                data-bs-original-title="{{ __('messages.tooltip.enable_affiliation') }}">
                                                <i class="fas fa-question-circle ml-1 general-question-mark"></i> :
                                            </span>
                                            <label
                                                class="form-check form-switch form-check-solid form-switch-sm d-flex cursor-pointer">
                                                <input type="checkbox" name="enable_affiliation" class="form-check-input"
                                                    value="1"
                                                    {{ !empty($setting['enable_affiliation']) ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-3 col-md-3 mb-3">
                                    <div class="form-group mb-3">
                                        <label for="enable_contact"
                                            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.setting.enable_addcontact') }}

                                        </label> <span data-bs-toggle="tooltip" class="mb-3" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.enable_contact') }}">
                                            <i class="fas fa-question-circle ml-1 general-question-mark"></i> :
                                        </span>
                                        <label
                                            class="form-check form-switch form-check-solid form-switch-sm d-flex cursor-pointer">
                                            <input type="checkbox" name="enable_contact" class="form-check-input"
                                                value="1"
                                                {{ !isset($setting['enable_contact']) || (!$setting['enable_contact'] && $setting['enable_contact'] != 0) || $setting['enable_contact'] == 1 ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 mb-3">
                                    <div class="form-group mb-3">
                                        <label for="hide_stickybar"
                                            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.setting.hide_stickybar') }}

                                        </label> <span data-bs-toggle="tooltip" class="mb-3" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.hide_stickybar') }}">
                                            <i class="fas fa-question-circle ml-1 general-question-mark"></i> :
                                        </span>
                                        <label
                                            class="form-check form-switch form-check-solid form-switch-sm d-flex cursor-pointer">
                                            <input type="checkbox" name="hide_stickybar" class="form-check-input"
                                                value="1" {{ !empty($setting['hide_stickybar']) ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 mb-3">
                                    <div class="form-group mb-3">
                                        <label for="whatsapp_share"
                                            class="form-label fs-6 fw-bolder text-gray-700 mb-3">{{ __('messages.setting.whatsapp_share') }}
                                        </label> <span data-bs-toggle="tooltip" class="mb-3" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.whatsapp_share') }}">
                                            <i class="fas fa-question-circle ml-1 general-question-mark"></i> :
                                        </span>
                                        <label
                                            class="form-check form-switch form-check-solid form-switch-sm d-flex cursor-pointer">
                                            <input type="checkbox" name="whatsapp_share" class="form-check-input"
                                                value="1" {{ !empty($setting['whatsapp_share']) ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 mb-3">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="pwaPreview" class="form-label fw-bolder">
                                            {{ __('messages.pwa.pwa_icon') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.pwa.pwa_icon_size') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="pwaPreview"
                                                    style="background-image: url('{{ isset($setting['pwa_icon']) ? $setting['pwa_icon'] : asset('web/media/logo/favicon-infyom.png') }}');">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.pwa.pwa_icon_change') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="favicon" name="pwa_icon"
                                                            class="image-upload d-none" accept="image/*" />
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"
                                id="userCredentialSettingBtn">{{ __('messages.common.save') }}</button>

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
