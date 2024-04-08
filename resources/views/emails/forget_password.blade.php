@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        <img src="{{ getLogoUrl() }}" class="logo" alt="{{ getAppName() }}" style="height:auto!important;width:auto!important;object-fit:cover">
        @endcomponent
    @endslot

    {{-- Body --}}
    <div>
        <h2>{{ __('messages.mail.hello') }} <b>{{ $user->first_name . ' ' . $user->last_name }}</b></h2>
        <p> {{ __('You are receiving this email because we received a password reset request for your account.') }}</p>
        @component('mail::button', ['url' => $url])
            {{ __('messages.user.change_password') }}
        @endcomponent
        <p>{{ __('This password reset link will expire in 60 minutes.') }}</p>
        <p>{{ __('If you did not request a password reset, no further action is required.') }}</p>
        <p>{{ getAppName() }}</p>
        <hr>
        <p>{{ __('If you\'re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:') }}: <a href="{{ $url }}">{!! $url !!}</a></p>
    </div>

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <h6>© {{ date('Y') }} {{ getAppName() }}.</h6>
        @endcomponent
    @endslot
@endcomponent
