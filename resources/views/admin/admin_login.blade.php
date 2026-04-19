<!doctype html>
<html lang="fr">

<head>
    <!-- Métadonnées requises -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('backend/assets/images/edulog.png') }}" type="image/png" />
    <!-- Plugins -->
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Loader -->
    <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <title>Connexion Administrateur - EduPlatform</title>
    <style>
        body {
            background: linear-gradient(135deg, #fdf1e3 0%, #f7e9d7 100%) !important;
        }
    </style>
</head>

<body class="">
    <!-- Conteneur principal -->
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="row g-0">
                <div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
                    <div class="mb-0 bg-transparent shadow-none card rounded-0">
                        <div class="card-body">
                            <img src="{{ asset('backend/assets/images/login-images/login-cover.svg') }}"
                                class="img-fluid auth-img-cover-login" width="650" alt="Illustration de connexion administrateur" />
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                    <div class="m-3 mb-0 bg-transparent shadow-sm card rounded-0">
                        <div class="card-body p-sm-5">
                            <div class="text-center">
                                
                                <div class="mb-3">
                                    <a href="{{ url('/') }}">
                                    <img src="{{ asset('backend/assets/images/edulog.png') }}" width="60" alt="Logo EduPlatform" />
                                    </a>
                                </div>
                                <div class="mb-4">
                                    <h5>Connexion Administrateur</h5>
                                    <p class="mb-0">Veuillez vous connecter à votre compte</p>
                                </div>
                            </div>

                            <div class="form-body">
                                <form class="row g-3" method="POST" action="{{ route('login') }}" id="loginForm">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" value="{{ old('email') }}" placeholder="Entrez votre email" required />
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror border-end-0"
                                                id="password" name="password" placeholder="Entrez votre mot de passe" required />
                                            <button type="button" class="bg-transparent input-group-text" aria-label="Afficher ou masquer le mot de passe">
                                                <i class="bx bx-hide"></i>
                                            </button>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="remember" id="flexSwitchCheckChecked"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Se souvenir de moi</label>
                                        </div>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div class="col-md-6 text-end">
                                            <a href="{{ route('password.request') }}" aria-label="Mot de passe oublié">Mot de passe oublié ?</a>
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary" aria-label="Se connecter">Se connecter</button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Plugins -->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!-- Afficher/Masquer le mot de passe -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password button").on('click', function(event) {
                event.preventDefault();
                const passwordInput = $('#show_hide_password input');
                const icon = $('#show_hide_password i');
                if (passwordInput.attr("type") === "text") {
                    passwordInput.attr('type', 'password');
                    icon.removeClass("bx-show").addClass("bx-hide");
                    $(this).attr('aria-label', 'Afficher le mot de passe');
                } else {
                    passwordInput.attr('type', 'text');
                    icon.removeClass("bx-hide").addClass("bx-show");
                    $(this).attr('aria-label', 'Masquer le mot de passe');
                }
            });

            // Validation côté client
            $('#loginForm').on('submit', function(e) {
                let isValid = true;
                const email = $('#email').val().trim();
                const password = $('#password').val().trim();

                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    alert('Veuillez entrer un email valide.');
                    isValid = false;
                }
                if (!password) {
                    alert('Le champ Mot de passe est requis.');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
    <!-- App JS -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>
</html>