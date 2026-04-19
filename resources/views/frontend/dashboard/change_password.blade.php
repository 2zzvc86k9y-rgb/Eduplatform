@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')
    <div class="flex-wrap mb-5 breadcrumb-content d-flex align-items-center justify-content-between">
        <div class="media media-card align-items-center">
            <div class="rounded-full media-img media--img media-img-md">
                <img class="rounded-full" src="{{ !empty($profileData->photo) ? url('upload/user_image/' . $profileData->photo) : url('upload/noimage.jpg') }}" alt="Photo de profil">
            </div>
            <div class="media-body">
                <h2 class="section__title fs-30">Bonjour, {{ $profileData->name }}</h2>
            </div><!-- end media-body -->
        </div><!-- end media -->
    </div><!-- end breadcrumb-content -->

    <div class="setting-body">
        <h3 class="fs-17 font-weight-semi-bold pb-4">Changer le mot de passe</h3>
        <form method="POST" action="{{ route('user.password.update') }}" class="row shadow-sm">
            @csrf
            <div class="input-box col-lg-4">
                <label class="label-text" for="old_password">Ancien mot de passe</label>
                <div class="form-group mb-3 input-group">
                    <span class="la la-lock input-icon"></span>
                    <input class="form-control form--control @error('old_password') is-invalid @enderror" type="password"
                        name="old_password" id="old_password" placeholder="Ancien mot de passe" required autofocus>
                    <div class="input-group-append">
                        <button class="btn theme-btn theme-btn-transparent toggle-password" type="button">
                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
                            </svg>
                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/>
                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"/>
                            </svg>
                        </button>
                    </div>
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div><!-- end input-box -->

            <div class="input-box col-lg-4">
                <label class="label-text" for="new_password">Nouveau mot de passe</label>
                <div class="form-group mb-3 input-group">
                    <span class="la la-lock input-icon"></span>
                    <input class="form-control form--control @error('new_password') is-invalid @enderror" type="password"
                        name="new_password" id="new_password" placeholder="Nouveau mot de passe" required>
                    <div class="input-group-append">
                        <button class="btn theme-btn theme-btn-transparent toggle-password" type="button">
                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
                            </svg>
                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/>
                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"/>
                            </svg>
                        </button>
                    </div>
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div><!-- end input-box -->

            <div class="input-box col-lg-4">
                <label class="label-text" for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
                <div class="form-group mb-3 input-group">
                    <span class="la la-lock input-icon"></span>
                    <input class="form-control form--control @error('new_password_confirmation') is-invalid @enderror"
                        type="password" name="new_password_confirmation" id="new_password_confirmation"
                        placeholder="Confirmer le nouveau mot de passe" required>
                    <div class="input-group-append">
                        <button class="btn theme-btn theme-btn-transparent toggle-password" type="button">
                            <svg class="eye-on" xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5C19.17 14.87 15.79 17 12 17s-7.17-2.13-8.82-5.5C4.83 8.13 8.21 6 12 6m0-2C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 5c1.38 0 2.5 1.12 2.5 2.5S13.38 14 12 14s-2.5-1.12-2.5-2.5S10.62 9 12 9m0-2c-2.48 0-4.5 2.02-4.5 4.5S9.52 16 12 16s4.5-2.02 4.5-4.5S14.48 7 12 7z"/>
                            </svg>
                            <svg class="eye-off" xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 0 24 24" width="22px" fill="#7f8897">
                                <path d="M0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/>
                                <path d="M12 6c3.79 0 7.17 2.13 8.82 5.5-.59 1.22-1.42 2.27-2.41 3.12l1.41 1.41c1.39-1.23 2.49-2.77 3.18-4.53C21.27 7.11 17 4 12 4c-1.27 0-2.49.2-3.64.57l1.65 1.65C10.66 6.09 11.32 6 12 6zm-1.07 1.14L13 9.21c.57.25 1.03.71 1.28 1.28l2.07 2.07c.08-.34.14-.7.14-1.07C16.5 9.01 14.48 7 12 7c-.37 0-.72.05-1.07.14zM2.01 3.87l2.68 2.68C3.06 7.83 1.77 9.53 1 11.5 2.73 15.89 7 19 12 19c1.52 0 2.98-.29 4.32-.82l3.42 3.42 1.41-1.41L3.42 2.45 2.01 3.87zm7.5 7.5l2.61 2.61c-.04.01-.08.02-.12.02-1.38 0-2.5-1.12-2.5-2.5 0-.05.01-.08.01-.13zm-3.4-3.4l1.75 1.75c-.23.55-.36 1.15-.36 1.78 0 2.48 2.02 4.5 4.5 4.5.63 0 1.23-.13 1.77-.36l.98.98c-.88.24-1.8.38-2.75.38-3.79 0-7.17-2.13-8.82-5.5.7-1.43 1.72-2.61 2.93-3.53z"/>
                            </svg>
                        </button>
                    </div>
                    @error('new_password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div><!-- end input-box -->

            <div class="input-box col-lg-12 py-2">
                <button class="btn theme-btn" type="submit">Modifier le mot de passe</button>
            </div><!-- end input-box -->
        </form>

        {{-- Section commentée pour la récupération de mot de passe --}}
        <form method="POST" class="pt-5 mt-5 border-top border-top-gray">
            <h3 class="fs-17 font-weight-semi-bold pb-1">Mot de passe oublié ? Récupérez-le</h3>
            <p class="pb-4">Entrez l'adresse email de votre compte pour réinitialiser le mot de passe. Vous recevrez ensuite un lien par email pour réinitialiser le mot de passe. Si vous rencontrez un problème avec la réinitialisation, <a href="{{ route('contact') }}" class="text-color">contactez-nous</a>.</p>
            <div class="input-box">
                <label class="label-text" for="email">Adresse email</label>
                <div class="form-group">
                    <input class="form-control form--control" type="email" name="email" id="email" placeholder="Entrez votre adresse email">
                    <span class="la la-envelope input-icon"></span>
                </div>
            </div><!-- end input-box -->
            <div class="input-box py-2">
                <button class="btn theme-btn">Récupérer le mot de passe</button>
            </div><!-- end input-box -->
        </form>
    </div><!-- end setting-body -->
@endsection

@section('scripts')
    <script>
        // Script pour basculer la visibilité des mots de passe
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const passwordField = this.parentElement.previousElementSibling;
                const eyeOn = this.querySelector('.eye-on');
                const eyeOff = this.querySelector('.eye-off');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    eyeOn.style.display = 'none';
                    eyeOff.style.display = 'inline';
                } else {
                    passwordField.type = 'password';
                    eyeOn.style.display = 'inline';
                    eyeOff.style.display = 'none';
                }
            });
        });
    </script>
@endsection