<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('backend/assets/images/edulog.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <title>Connexion - EduPlatform</title>
    <style>
    body {
        background: linear-gradient(135deg, #fdf1e3 0%, #f7e9d7 100%) !important;
    }
    </style>
</head>

<body class="">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">
                    <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                        <div class="mb-0 bg-transparent shadow-none card rounded-0">
                            <div class="card-body">
                                <img src="{{ asset('backend/assets/images/login-images/login-cover.svg') }}"
                                    class="img-fluid auth-img-cover-login" width="650" alt="Illustration de connexion pour EduPlatform" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="m-3 mb-0 bg-transparent shadow-sm card rounded-0">
                            <div class="card-body p-sm-5">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <a href="{{ url('/') }}">
                                        <img src="{{ asset('backend/assets/images/edulog.png') }}" width="60" alt="Logo de EduPlatform">
                                        </a>
                                    </div>
                                    <div class="mb-4">
                                        <h5 class="">Connexion Instructeur</h5>
                                        <p class="mb-0">Veuillez vous connecter à votre compte</p>
                                    </div>
                                </div>
                                
                                <div class="form-body">
                                    <form class="row g-3" method="POST" action="{{ route('login') }}" role="form" aria-label="Formulaire de connexion">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control" id="email"
                                                    @error('email') class="is-invalid" @enderror placeholder="exemple@eduplatform.com"
                                                    autocomplete="email" aria-label="Adresse email">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="bx bx-envelope"></i>
                                                </span>
                                            </div>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Mot de passe</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control" id="password"
                                                    name="password" @error('password') class="is-invalid" @enderror
                                                    placeholder="Entrez votre mot de passe" autocomplete="current-password"
                                                    aria-label="Mot de passe">
                                                <a href="javascript:;" class="input-group-text bg-transparent"
                                                    aria-label="Afficher ou masquer le mot de passe">
                                                    <i class="bx bx-hide"></i>
                                                </a>
                                            </div>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                    name="remember">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Se souvenir de moi</label>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <div class="col-md-6 text-end">
                                                <a href="{{ route('password.request') }}"
                                                    aria-label="Mot de passe oublié">Mot de passe oublié ?</a>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary" aria-label="Se connecter">Se connecter</button>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="text-center">
                                                <p class="mb-0">Don't have an account yet? <a
                                                        href="authentication-signup.html">Sign up here</a>
                                                </p>
                                            </div>
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on("click", function(event) {
                event.preventDefault();
                const passwordInput = $("#show_hide_password input");
                const icon = $("#show_hide_password i");

                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    icon.removeClass("bx-hide").addClass("bx-show");
                } else {
                    passwordInput.attr("type", "password");
                    icon.removeClass("bx-show").addClass("bx-hide");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}", "Information");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}", "Succès");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}", "Attention");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}", "Erreur");
                    break;
            }
    @endif
    </script>
</body>

</html>