<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}" dir="{{ session('locale', 'en') === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

    {{-- add rtl css file --}}
    @if (session('locale', 'en') === 'ar')
        <link href="{{ asset('assets/css/rtl.css') }}" rel="stylesheet" id="rtl-style">
    @endif

    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" id="dark-style" />
</head>

<body class="loading authentication-bg">

    <div class="account-pages pt-5">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Header / Logo -->
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="18">
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-4">
                            <!-- Registration Form -->
                            <form class="needs-validation" novalidate method="POST"
                                action="{{ route('register.store', ['locale' => app()->getLocale()]) }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('register.Full Name') }}</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @elseif(old('name')) is-valid @enderror"
                                        placeholder="{{ __('register.Enter your name') }}" value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('register.Email address') }}</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @elseif(old('email')) is-valid @enderror"
                                        placeholder="{{ __('register.Enter your email') }}"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('register.Password') }}</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('register.Enter your password') }}" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">
                                        {{ __('register.Confirm Password') }}
                                    </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" placeholder="{{ __('register.Confirm Password') }}"
                                        required>
                                </div>

                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('register.Register') }}
                                    </button>
                                </div>
                            </form>

                            <div class="dropdown ">
                                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-haspopup="false" aria-expanded="false">
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
                        </div> <!-- end card-body -->

                    </div> <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">
                                {{ __('register.Already have account?') }}
                                <a href="{{ route('login') }}"
                                    class="text-muted ms-1"><b>{{ __('register.Log In') }}</b></a>
                            </p>
                        </div>
                    </div>

                </div> <!-- end col -->

            </div> <!-- end row -->
        </div> <!-- end container -->
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

</html>
