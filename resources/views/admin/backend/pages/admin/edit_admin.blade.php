@extends('./admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!-- Fil d'Ariane -->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="Fil d'Ariane">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier un administrateur</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier un administrateur</h5>
                    <form id="myForm" action="{{ route('update.admindata', $user->id) }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="name" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required aria-describedby="name_error">
                            @error('name')
                                <span id="name_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="username" class="form-label">Nom d’utilisateur</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                                value="{{ old('username', $user->username) }}" required aria-describedby="username_error">
                            @error('username')
                                <span id="username_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required aria-describedby="email_error">
                            @error('email')
                                <span id="email_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                value="{{ old('phone', $user->phone) }}" required aria-describedby="phone_error">
                            @error('phone')
                                <span id="phone_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address" class="form-label">Adresse</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                value="{{ old('address', $user->address) }}" required aria-describedby="address_error">
                            @error('address')
                                <span id="address_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password" class="form-label">Nouveau mot de passe (laisser vide pour ne pas modifier)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                aria-describedby="password_error">
                            @error('password')
                                <span id="password_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="role" class="form-label">Rôle</label>
                            <select class="mb-3 form-select @error('role') is-invalid @enderror" id="role" name="role"
                                aria-label="Sélectionner un rôle" required>
                                <option value="" disabled>Sélectionnez un rôle</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="my-3 row">
                            <div class="col-sm-9">
                                <h6 class="mb-2">Image de profil</h6>
                                <input id="image" type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                                    accept="image/*" aria-describedby="photo_error">
                                @error('photo')
                                    <span id="photo_error" class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3 text-secondary">
                                <img id="showImage"
                                    src="{{ !empty($user->photo) ? url('upload/admin_image/' . $user->photo) : url('upload/noimage.jpg') }}"
                                    alt="Photo de {{ $user->name ?? 'l’administrateur' }}" class="p-1 mt-2 rounded-circle bg-primary" width="60">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour l’administrateur">Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Aperçu de l’image
        $('#image').change(function(e) {
            const reader = new FileReader();
            reader.onload = (e) => {
                $('#showImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });

        // Validation du formulaire
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                },
                username: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                phone: {
                    required: true,
                },
                address: {
                    required: true,
                },
                password: {
                    minlength: 8,
                },
                role: {
                    required: true,
                },
                photo: {
                    extension: "jpg|jpeg|png|gif",
                },
            },
            messages: {
                name: {
                    required: "Veuillez entrer le nom",
                },
                username: {
                    required: "Veuillez entrer le nom d’utilisateur",
                },
                email: {
                    required: "Veuillez entrer l’email",
                    email: "Veuillez entrer un email valide",
                },
                phone: {
                    required: "Veuillez entrer le numéro de téléphone",
                },
                address: {
                    required: "Veuillez entrer l’adresse",
                },
                password: {
                    minlength: "Le mot de passe doit contenir au moins 8 caractères",
                },
                role: {
                    required: "Veuillez sélectionner un rôle",
                },
                photo: {
                    extension: "Veuillez sélectionner une image au format JPG, JPEG, PNG ou GIF",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection