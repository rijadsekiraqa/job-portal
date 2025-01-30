<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
</head>

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{ asset('admin/assets/img/logo.png') }}" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Mirë se vini në Portalin e Punes</h3>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <x-input type="text" name="identifier" id="identifier"
                                        placeholder="Ju lutem shkruani email adresen">
                                    </x-input>
                                    <img src="{{ asset('admin/assets/img/icons/mail.svg') }}" alt="img">
                                </div>
                                @error('identifier')
                                    <div class="alert alert-danger mt-2 py-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <x-input type="password" name="password" class="pass-input" id="password"
                                        placeholder="Ju lutem shkruani fjalekalimin">
                                    </x-input>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger mt-2 py-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if ($errors->has('login'))
                                <div class="alert alert-danger mt-2">
                                    {{ $errors->first('login') }}
                                </div>
                            @endif
                            <div class="form-login">
                                <x-button type="submit" class="btn btn-login">Kyqu</x-button>
                            </div>
                        </form>

                        <div class="signinform text-center">
                            <h4>
                                Nuk keni llogari? 
                                <a href="{{ route('signup') }}" class="text-decoration-underline text-uppercase">
                                    Regjistrohu si punëdhënës
                                </a>
                            </h4>
                            
                        </div>
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{ asset('admin/assets/img/login.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/script.js') }}"></script>
</body>

</html>
