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

    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="pb-4 fs-17 font-weight-semi-bold">Modifier le profil</h3>
            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" class="row pt-40px shadow-sm">
                @csrf
                <div class="media media-card align-items-center">
                    <div class="m-4 media-img media-img-lg bg-gray">
                        <img id="profile-preview" class="mr-3" src="{{ !empty($profileData->photo) ? url('upload/user_image/' . $profileData->photo) : url('upload/noimage.jpg') }}" alt="Photo de profil">
                    </div>
                    <div class="media-body">
                        <div class="file-upload-wrap file-upload-wrap-2">
                            <input type="file" name="photo" id="photo" class="file-upload-input" accept="image/jpeg,image/png" onchange="previewImage(event)">
                            <span class="file-upload-text"><i class="mr-2 la la-photo"></i>Télécharger photo</span>
                        </div><!-- file-upload-wrap -->
                        <p class="fs-14">Taille maximale : 5 Mo, dimensions minimales : 200x200, formats acceptés : .jpg et .png</p>
                        @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end media -->

                <div class="input-box col-lg-6">
                    <label class="label-text">Nom complet</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="name" value="{{ old('name', $profileData->name) }}" placeholder="Votre nom" required autofocus>
                        <span class="la la-user input-icon"></span>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-6">
                    <label class="label-text">Nom d'utilisateur</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="username" value="{{ old('username', $profileData->username) }}" placeholder="Votre nom d'utilisateur" required>
                        <span class="la la-user input-icon"></span>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-6">
                    <label class="label-text">Email</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="email" name="email" value="{{ old('email', $profileData->email) }}" placeholder="Votre adresse email" required>
                        <span class="la la-envelope input-icon"></span>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-6">
                    <label class="label-text">Téléphone</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="tel" name="phone" value="{{ old('phone', $profileData->phone) }}" placeholder="Votre numéro de téléphone">
                        <span class="la la-phone input-icon"></span>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->

                <div class="input-box col-lg-12">
                    <label class="label-text">Adresse</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="address" value="{{ old('address', $profileData->address) }}" placeholder="Votre adresse">
                        <span class="la la-building input-icon"></span>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->

                <div class="py-2 input-box col-lg-12">
                    <button class="btn theme-btn" type="submit">Enregistrer les modifications</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('profile-preview');
            const file = input.files[0];

            // Vérifier la taille (max 5MB)
            if (file && file.size > 5 * 1024 * 1024) {
                alert('La taille du fichier dépasse 5 Mo.');
                input.value = '';
                return;
            }

            // Vérifier les dimensions minimales (200x200)
            const img = new Image();
            img.onload = function() {
                if (img.width < 200 || img.height < 200) {
                    alert('Les dimensions de l\'image doivent être au moins de 200x200 pixels.');
                    input.value = '';
                    return;
                }
                preview.src = URL.createObjectURL(file);
            };
            img.onerror = function() {
                alert('Erreur lors du chargement de l\'image. Veuillez vérifier le format (.jpg ou .png).');
                input.value = '';
            };
            img.src = URL.createObjectURL(file);
        }
    </script>
@endsection