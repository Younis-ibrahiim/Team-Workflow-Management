<!DOCTYPE html>
{{-- Dynamically set language and direction --}}
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <title>{{ __('login.login_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

    @if (app()->getLocale() === 'ar')
        <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet" id="rtl-style">
    @endif

    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" id="dark-style" />
</head>

<body class="loading authentication-bg">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <div>
                                <span><img src="{{ asset('assets/images/logo.png') }}" alt=""
                                        height="18"></span>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">{{ __('login.login_title') }}</h4>
                            </div>

                            {{-- Laravel Form starts here --}}
                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">{{ __('login.email_label') }}</label>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        type="email" id="emailaddress"
                                        placeholder="{{ __('login.email_placeholder') }}" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <a href="" class="text-muted float-end">
                                        <small>{{ __('login.forgot_password') }}</small>
                                    </a>
                                    <label for="password" class="form-label">{{ __('login.password_label') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="{{ __('login.password_placeholder') }}">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" class="form-check-input"
                                            id="checkbox-signin" checked>
                                        <label class="form-check-label"
                                            for="checkbox-signin">{{ __('login.remember_me') }}</label>
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary"
                                        type="submit">{{ __('login.login_button') }}</button>
                                </div>

                                <div class="dropdown ">
                                    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown"
                                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <span class="align-middle d-none d-sm-inline-block">
                                            {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                                        </span>
                                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
                                    </a>
                                    <div class="dropdown-menu topbar-dropdown-menu">
                                        {{-- Item: English --}}
                                        <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'en'])) }}"
                                            class="dropdown-item notify-item {{ app()->getLocale() === 'en' ? 'active' : '' }}">
                                            <span class="align-middle">English</span>
                                        </a>

                                        {{-- Item: Arabic --}}
                                        <a href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'ar'])) }}"
                                            class="dropdown-item notify-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}">
                                            <span class="align-middle">العربية</span>
                                        </a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">{{ __('login.no_account') }}
                                <a href="{{ route('register') }}"
                                    class="text-muted ms-1"><b>{{ __('login.register') }}</b></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>
