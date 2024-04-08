@extends('settings.edit')
@section('section')
    <div class="card w-100">
        <div class="card-body d-flex">
            @include('settings.setting_menu')
            <div class="">
                {{ Form::open(['route' => ['setting.update'], 'method' => 'post', 'files' => true, 'id' => 'createSetting']) }}
                <div class="row">
                    <!-- App Name Field -->
                    <div class="form-group col-sm-6 mb-3">
                        {{ Form::label('app_name', __('messages.setting.app_name') . ':', ['class' => 'form-label required']) }}
                        {{ Form::text('app_name', $setting['app_name'], ['class' => 'form-control', 'id' => 'settingAppName', 'placeholder' => __('messages.setting.app_name')]) }}
                    </div>
                    <!-- Email Field -->
                    <div class="form-group col-sm-6 mb-3">
                        {{ Form::label('email', __('messages.user.email') . ':', ['class' => 'form-label required']) }}
                        {{ Form::email('email', $setting['email'], ['class' => 'form-control', 'required', 'id' => 'settingEmail', 'placeholder' => __('messages.user.email')]) }}
                    </div>
                    <!-- Phone Field -->
                    <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12 mb-3">
                        {{ Form::label('phone', __('messages.user.phone') . ':', ['class' => 'form-label required']) }}
                        <br>
                        {{ Form::tel('phone', '+' . $setting['prefix_code'] . $setting['phone'], ['class' => 'form-control', 'placeholder' => __('messages.form.contact'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id' => 'phoneNumber']) }}
                        {{ Form::hidden('prefix_code', '+' . $setting['prefix_code'], ['id' => 'prefix_code']) }}
                        <p id="valid-msg" class="text-success d-block fw-400 fs-small mt-2 d-none">
                            {{ __('messages.placeholder.valid_number') }}</p>
                        <p id="error-msg" class="text-danger d-block fw-400 fs-small mt-2 d-none"></p>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-12 form-group mb-3">
                        {{ Form::label('plan_expire_notification', __('messages.plan_expire_notification') . ':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::number('plan_expire_notification', $setting['plan_expire_notification'], ['class' => 'form-control', 'min' => 0, 'onKeyPress' => 'if(this.value.length==2) return false;', 'required', 'id' => 'settingPlanExpireNotification', 'placeholder' => __('messages.plan_expire_notification')]) }}
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('address', __('messages.setting.address') . ':', ['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::text('address', $setting['address'], ['class' => 'form-control', 'min' => 0, 'id' => 'settingAddress', 'required', 'placeholder' => __('messages.setting.address')]) }}
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('default_language', __('messages.setting.default_language') . ':', ['class' => 'form-label']) }}
                            {{ Form::select('default_language', getAllLanguage(), $setting['default_language'], ['class' => 'form-control', 'data-control' => 'select2']) }}
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('user_default_language', __('messages.setting.user_default_language') . ':', ['class' => 'form-label']) }}
                            {{ Form::select('user_default_language', getAllLanguage(), $setting['user_default_language'], ['class' => 'form-control', 'data-control' => 'select2']) }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('default_country_code', __('messages.common.default_country_code') . ':', ['class' => 'form-label']) }}
                            <span class="required"></span>
                            {{ Form::text('default_country_data', null, ['class' => 'form-control', 'placeholder' => __('messages.common.default_country_code'), 'id' => 'defaultCountryData']) }}
                            {{ Form::hidden('default_country_code', $setting['default_country_code'], ['id' => 'defaultCountryCode']) }}
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                        <div class="form-group mb-3">
                            {{ Form::label('default_currency_format', __('messages.setting.default_currency_format') . ':', ['class' => 'form-label']) }}
                            {{ Form::select('default_currency', getCurrenciesCode(), $setting['default_currency'], ['class' => 'form-control', 'data-control' => 'select2']) }}
                        </div>
                    </div>
                    <div class="form-group col-sm-6 mb-3">
                        {{ Form::label('affiliation_amount', __('messages.setting.affiliation_amount') . ':', ['class' => 'form-label required']) }}
                        {{ Form::text('affiliation_amount', $setting['affiliation_amount'], ['class' => 'form-control', 'id' => 'affiliationAmount', 'placeholder' => __('messages.setting.affiliation_amount')]) }}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class=" col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('is_front_page', __('messages.common.enable_page') . ':', ['class' => 'form-label']) }}
                                        <label
                                            class="form-check form-switch form-check-solid form-switch-sm d-flex cursor-pointer">
                                            <input type="checkbox" name="is_front_page" class="form-check-input"
                                                value="1"
                                                {{ $setting['is_front_page'] == '1' ? 'checked' : '' }}>&nbsp;
                                            <span class="form-check-label text-gray-600"
                                                for="mobileValidation">{{ __('messages.common.enable_page') }}</span>&nbsp;&nbsp;
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('is_cookie_banner', __('messages.common.cookie_banner_enabled') . ':', ['class' => 'form-label']) }}
                                        <label
                                            class="form-check form-switch form-check-solid form-switch-sm d-flex cursor-pointer">
                                            <input type="checkbox" name="is_cookie_banner" class="form-check-input"
                                                value="1"
                                                {{ $setting['is_cookie_banner'] == '1' ? 'checked' : '' }}>&nbsp;
                                            <span class="form-check-label text-gray-600"
                                                for="mobileValidation">{{ __('messages.common.enable_cookie_banner') }}</span>&nbsp;&nbsp;
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('currency_after_amount', __('messages.common.currency_position') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="currency_after_amount" class="form-check-input"
                                                id="currencyAfterAmount" value="1"
                                                {{ $setting['currency_after_amount'] == '1' ? 'checked' : '' }}>
                                            <span class="form-check-label text-gray-600"
                                                for="currencyAfterAmount">{{ __('messages.common.show_currency_behind') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('mobileValidation', __('messages.common.phone_validation') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="mobile_validation" class="form-check-input"
                                                value="1" {{ $setting['mobile_validation'] == '1' ? 'checked' : '' }}
                                                id="mobileValidation">
                                            <span class="form-check-label text-gray-600"
                                                for="mobileValidation">{{ __('messages.common.enable_validation') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('registerEnable', __('messages.common.register_enable') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="register_enable" class="form-check-input"
                                                value="1" {{ $setting['register_enable'] == '1' ? 'checked' : '' }}
                                                id="registerEnable">
                                            <span class="form-check-label text-gray-600"
                                                for="registerEnable">{{ __('messages.common.enable_register') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('captchaEnable', __('messages.common.captcha_enable') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="captcha_enable" class="form-check-input"
                                                value="1" {{ $setting['captcha_enable'] == '1' ? 'checked' : '' }}
                                                id="">
                                            <span class="form-check-label text-gray-600"
                                                for="">{{ __('messages.common.captcha_enable') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('registerMail', __('messages.common.register_mail') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="register_mail" class="form-check-input"
                                                value="1" {{ $setting['register_mail'] == '1' ? 'checked' : '' }}
                                                id="">
                                            <span class="form-check-label text-gray-600"
                                                for="">{{ __('messages.common.register_mail') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        {{ Form::label('urlAlias', __('messages.common.url_alias_edit') . ':', ['class' => 'form-label mb-3']) }}
                                        <label class="form-check form-switch form-switch-sm cursor-pointer">
                                            <input type="checkbox" name="url_alias" class="form-check-input"
                                                value="1" {{ $setting['url_alias'] == '1' ? 'checked' : '' }}
                                                id="">
                                            <span class="form-check-label text-gray-600"
                                                for="">{{ __('messages.common.url_alias_enable') }}</span>&nbsp;&nbsp;
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="form-group col-sm-3 mb-3">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="appLogoPreview"
                                            class="form-label required">{{ __('messages.setting.app_logo') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.app_logo') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="appLogoPreview"
                                                    style="background-image: url('{{ isset($setting['app_logo']) ? $setting['app_logo'] : asset('assets/images/infyom-logo.png') }}')">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.tooltip.change_app_logo') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="appLogo" name="app_logo"
                                                            class="image-upload d-none" accept="image/*" />
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3 mb-3">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="faviconPreview" class="form-label required">
                                            {{ __('messages.setting.favicon') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.favicon_logo') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="faviconPreview"
                                                    style="background-image: url('{{ isset($setting['favicon']) ? $setting['favicon'] : asset('web/media/logos/favicon-infyom.png') }}');">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.tooltip.change_favicon_logo') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="favicon" name="favicon"
                                                            class="image-upload d-none" accept="image/*" />
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 mb-3">
                                    <div class="mb-3" io-image-input="true">
                                        <label for="appLogoPreview"
                                            class="form-label required">{{ __('messages.setting.dashboard_logo') . ':' }}</label>
                                        <span data-bs-toggle="tooltip" data-placement="top"
                                            data-bs-original-title="{{ __('messages.tooltip.dashboard_logo') }}">
                                            <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                                        </span>
                                        <div class="d-block">
                                            <div class="image-picker">
                                                <div class="image previewImage" id="appLogoPreview"
                                                    style="background-image: url('{{ isset($setting['dashboard_logo']) ? $setting['dashboard_logo'] : asset('assets/images/infyom-logo.png') }}')">
                                                </div>
                                                <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                                    data-bs-toggle="tooltip" data-placement="top"
                                                    data-bs-original-title="{{ __('messages.tooltip.change_dashboard_logo') }}">
                                                    <label>
                                                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                                        <input type="file" id="dashboardLogo" name="dashboard_logo"
                                                            class="image-upload d-none" accept="image/*" />
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('setting.upgradeDatabase') }}"
                            class="btn btn-warning mb-5"><i class="fa-solid fa-database"></i> {{ __('messages.setting.upgrade_database') }}</a>
                            <a href="{{ route('generateSitemap') }}"
                            class="btn btn-primary mb-5 ms-2"><i class="fa-solid fa-sitemap"></i> {{ __('messages.gnerate_sitemap') }}</a>
                        </div>
                    </div>
                </div>
                <div>
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-3']) }}
                    <a href="{{ route('setting.index') }}"
                        class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
