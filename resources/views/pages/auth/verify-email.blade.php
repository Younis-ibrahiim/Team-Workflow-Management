<!DOCTYPE html>
{{-- Set dynamic language and direction --}}
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <title>{{ __('verify_email.verify_email_title') ?? 'Verify Email' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />

    {{-- Load RTL CSS if Arabic --}}
    @if (app()->getLocale() === 'ar')
        <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet" id="rtl-style">
    @endif

    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
</head>

<body class="loading authentication-bg">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="#">
                                <span><img src="{{ asset('assets/images/logo.png') }}" alt="" height="18"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center m-auto">
                                <img src="{{ asset('assets/images/mail_sent.svg') }}" alt="mail sent image" height="64" />
                                <h4 class="text-dark-50 text-center mt-4 fw-bold">{{ __('verify_email.check_email') }}</h4>

                                {{-- Success Alert for Resending --}}
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success border-0 mt-3" role="alert">
                                        {{ __('verify_email.verify_email_sent') }}
                                    </div>
                                @endif

                                <p class="text-muted mb-4 mt-3">
                                    {!! __('verify_email.verify_email_text', ['email' => '<b>' . auth()->user()->email . '</b>']) !!}
                                </p>
                            </div>

                            {{-- Functional Resend Form --}}
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <div class="mb-0 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="mdi mdi-email-sync me-1"></i> {{ __('verify_email.resend_verification_email') }}
                                    </button>
                                </div>
                            </form>

                            {{-- Simple Logout Link --}}
                            <div class="text-center mt-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-muted p-0">
                                        {{ __('auth.logout') }}
                                    </button>
                                </form>
                            </div>

                        </div> </div> </div> </div> </div> </div> <footer class="footer footer-alt">
        {{ date('Y') }} © Hyper - Coderthemes.com
    </footer>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>
</html>
