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

    <link rel="stylesheet" href="{{asset ('admin/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{asset ('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{asset ('admin/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{asset ('admin/assets/css/style.css') }}">
</head>

<body class="account-page">
    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="{{asset ('admin/assets/img/logo.png') }}" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Create an Account</h3>
                        </div>
                        <form method="POST" action="{{ route('signup') }}">
                            @csrf
                            @method('POST')
                        
                            <div class="form-login">
                                <label>Emri</label>
                                <div class="form-addons">
                                    <x-input type="text" name="name" id="name" placeholder="Ju lutem shkruani emrin tuaj"
                                             value="{{ old('name') }}">
                                    </x-input>
                                    <img src="{{ asset('admin/assets/img/icons/users1.svg') }}" alt="img">
                                </div>
                                @error('name')
                                <div class="alert alert-danger mt-2 py-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="form-login">
                                <label>Mbiemri</label>
                                <div class="form-addons">
                                    <x-input type="text" name="lastname" id="lastname" placeholder="Ju lutem shkruani mbiemrin tuaj"
                                             value="{{ old('lastname') }}">
                                    </x-input>
                                    <img src="{{ asset('admin/assets/img/icons/users1.svg') }}" alt="img">
                                </div>
                                @error('lastname')
                                <div class="alert alert-danger mt-2 py-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="form-login">
                                <label>Emri Perdorues (username)</label>
                                <div class="form-addons">
                                    <x-input type="text" name="username" id="username" placeholder="Ju lutem shkruani nje emer perdorues"
                                             value="{{ old('username') }}">
                                    </x-input>
                                    <img src="{{ asset('admin/assets/img/icons/users1.svg') }}" alt="img">
                                </div>
                                @error('username')
                                <div class="alert alert-danger mt-2 py-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <x-input type="text" name="email" placeholder="Ju lutem shkruani email"
                                             value="{{ old('email') }}">
                                    </x-input>
                                    <img src="{{ asset('admin/assets/img/icons/mail.svg') }}" alt="img">
                                </div>
                                @error('email')
                                <div class="alert alert-danger mt-2 py-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <x-input type="password" class="pass-input" name="password" placeholder="Ju lutem shkruani fjalekalimin">
                                    </x-input>
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                                @error('password')
                                <div class="alert alert-danger mt-2 py-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        
                            <div class="form-login">
                                <x-button type="submit" class="btn btn-login" label="Regjistrohu"/>
                            </div>
                        
                            <div class="signinform text-center">
                                <h4>A keni tashmë një llogari?
                                    <x-link href="{{ route('login') }}" class="hover-a">Kyqu</x-link>
                                </h4>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="login-img">
                    <img src="{{asset ('admin/assets/img/login.jpg') }}" alt="img">
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset ('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{asset ('admin/assets/js/feather.min.js') }}"></script>
    <script src="{{asset ('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset ('admin/assets/js/script.js') }}"></script>
</body>

</html>
