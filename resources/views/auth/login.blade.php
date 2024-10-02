<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MonPark</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href=" {{ url('fonts/material-icon/css/material-design-iconic-font.min.css')}} ">
    <link href="assets/img/logo1.png" rel="icon">

    <!-- Main css -->
    <link rel="stylesheet" href=" {{ url('css/style.css')}} ">
</head>
<body>

    {{-- <div class="main"> --}}
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div><br><br><br><br><br><br><br></div>
            <div class="container">
                <div class="signin-content">

                    <div class="signin-image"><br><br>
                        <figure><img src="images/signin.jpg" alt="sing up image"></figure>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="signup-image-link">{{ __('Mot de passe oublié?') }}</a>
                        @endif
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title" style="color: #018692">S'identifier</h2>
                        <form method="POST" action="{{ route('login') }}" class="register-form" id="login-form">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email" :value="__('Email')"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="email" placeholder="E-mail" :value="old('email')" required autofocus/>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password" :value="__('Password')"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Mot de passe..." required autocomplete="current-password"/>
                            </div>

                            <!-- Remember Me -->
                            {{-- <div class="form-group">
                                <input type="checkbox" name="remember" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term">
                                    <span>
                                        <span></span>
                                    </span>{{ __('Se souvenir de moi') }}
                                </label>
                            </div> --}}
                            <div class="form-group form-button">
                                <button style="color: #fff; background: #05bbcb; font-size: 14px; font-weight: 400; padding: 12px 18px; display: inline-block; line-height: 1.42857143; text-align: center; white-space: nowrap; border: 1px solid transparent; border-radius: 4px;" class="btn btn-theme" class="form-submit">{{ __('Se Connecter') }}</button>
                            </div>
                        </form>

                    </div> {{-- signin-form --}}
                </div>
            </div>
        </section>
    {{-- </div> --}}

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
