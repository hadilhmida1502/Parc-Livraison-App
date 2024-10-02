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
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Sign up form -->
        <section class="signup">
            <div><br><br><br></div>
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title" style="color: #018692">S'inscrire</h2>
                        <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
                            @csrf

                            <!-- Name -->
                            <div class="form-group">
                                <label for="name" :value="__('Name')"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Nom & Prénom..." :value="old('name')" required autofocus/>
                            </div>

                            <!-- Role -->
                            <div class="form-group">
                                <label for="role" :value="__('Role')"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <select type="text" name="role" id="role" :value="old('role')" required autofocus style="border: none; width: 100%; display: block; border: none; border-bottom: 1px solid #999; padding: 6px 30px; font-family: Poppins; box-sizing: border-box; outline: none; text-indent: 0px; ">
                                    <option style="color: #737373;" value="1" disabled selected>Role...</option>
                                    <option value="Administrateur">Administrateur</option>
                                    <option value="Gestionnaire parc">Gestionnaire parc</option>
                                    <option value="Gestionnaire livraison">Gestionnaire livraison</option>
                                </select>
                            </div>

                            {{-- <div class="form-group">
                                <label for="role" :value="__('Role')"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="role" id="role" placeholder="Role..." :value="old('role')" required autofocus/>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="role" :value="__('Role')"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="role" id="role" placeholder="Role..." :value="old('role')" required autofocus/>
                                <center><select style="border: none; width: 100%; display: block; border: none; border-bottom: 1px solid #999; padding: 6px 30px; font-family: Poppins; box-sizing: border-box; outline: none; text-indent: 0px; color: #737373;" type="text" name="role" id="role" :value="old('role')" class="form-group" required autofocus>
                                    <option value="1" disabled selected>Role...</option>
                                    <option value="Administrateur">Administrateur</option>
                                    <option value="Administrateur">Gestionnaire parc</option>
                                    <option value="Administrateur">Gestionnaire livraison</option>
                                </select></center>
                            </div> --}}

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email" :value="__('Email')"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="E-mail..." :value="old('email')" required />
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password" :value="__('Password')"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Mot de passe..." required autocomplete="new-password"/>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation" :value="__('Confirm Password')"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Répétez votre mot de passe..." required/>
                            </div>

                            {{-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>J'accepte <a href="{{ route('register') }}" class="term-service">Les conditions d'utilisation</a></label>
                            </div> --}}

                            <!---->
                            <div class="form-group form-button">
                                <button style="color: #fff; background: #05bbcb; font-size: 14px; font-weight: 400; padding: 12px 18px; display: inline-block; line-height: 1.42857143; text-align: center; white-space: nowrap; border: 1px solid transparent; border-radius: 4px;" class="btn btn-theme" class="form-submit">{{ __('Enregistrer') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image"><br><br><br><br>
                        <figure><img src="images/signin.jpg" alt="sing up image"></figure><br>
                        <a href="{{ route('login') }}" class="signup-image-link">{{ __('Je suis déjà membre') }}</a>
                    </div>
                </div>
            </div>
        </section>
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
