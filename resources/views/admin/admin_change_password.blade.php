@extends('admin.admin_dashboard')

@section('admin')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="Fil d'Ariane">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Changement de mot de passe</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="text-center d-flex flex-column align-items-center">
                                <img src="{{ !empty($profileData->photo) ? url('upload/admin_image/' . $profileData->photo) : url('upload/noimage.jpg') }}"
                                     alt="Photo de profil de {{ $profileData->name }} sur EduPlatform"
                                     class="p-1 rounded-circle bg-primary" width="110">
                                <div class="mt-3">
                                    <h4>{{ $profileData->name }}</h4>
                                    <p class="mb-1 text-secondary">{{ $profileData->username }}</p>
                                    <p class="text-muted font-size-sm">{{ $profileData->email }}</p>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                <li class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0"><i class="bx bxl-twitter me-2 text-info"></i>Twitter</h6>
                                    <span class="text-secondary">{{ $profileData->twitter ?? 'Non défini' }}</span>
                                </li>
                                <li class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0"><i class="bx bxl-instagram me-2 text-danger"></i>Instagram</h6>
                                    <span class="text-secondary">{{ $profileData->instagram ?? 'Non défini' }}</span>
                                </li>
                                <li class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0"><i class="bx bxl-facebook me-2 text-primary"></i>Facebook</h6>
                                    <span class="text-secondary">{{ $profileData->facebook ?? 'Non défini' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <form id="passwordForm" action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data" role="form" aria-label="Formulaire de changement de mot de passe">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ancien mot de passe</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="old_password" id="old_password"
                                               class="form-control @error('old_password') is-invalid @enderror"
                                               aria-label="Ancien mot de passe">
                                        @error('old_password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nouveau mot de passe</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password" id="new_password"
                                               class="form-control @error('new_password') is-invalid @enderror"
                                               aria-label="Nouveau mot de passe">
                                        @error('new_password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Confirmer le mot de passe</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                               class="form-control" aria-label="Confirmation du nouveau mot de passe">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="px-4 btn btn-primary" value="Enregistrer les modifications" aria-label="Enregistrer les modifications du mot de passe">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#passwordForm').validate({
            rules: {
                old_password: {
                    required: true,
                    minlength: 8
                },
                new_password: {
                    required: true,
                    minlength: 8
                },
                new_password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#new_password"
                }
            },
            messages: {
                old_password: {
                    required: "Veuillez entrer votre ancien mot de passe",
                    minlength: "L'ancien mot de passe doit contenir au moins 8 caractères"
                },
                new_password: {
                    required: "Veuillez entrer un nouveau mot de passe",
                    minlength: "Le nouveau mot de passe doit contenir au moins 8 caractères"
                },
                new_password_confirmation: {
                    required: "Veuillez confirmer votre nouveau mot de passe",
                    minlength: "La confirmation doit contenir au moins 8 caractères",
                    equalTo: "Les mots de passe ne correspondent pas"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.col-sm-9').append(error);
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