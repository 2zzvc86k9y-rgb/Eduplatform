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
                    <li class="breadcrumb-item active" aria-current="page">Modifier les paramètres du site</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier les paramètres du site</h5>
                    <form id="myForm" action="{{ route('update.siteSettings') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $frontpage->id }}">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="phone" class="form-label">Téléphone du site</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                value="{{ old('phone', $frontpage->phone) }}" required aria-describedby="phone_error">
                            @error('phone')
                                <span id="phone_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="form-label">Email du site</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                value="{{ old('email', $frontpage->email) }}" required aria-describedby="email_error">
                            @error('email')
                                <span id="email_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="address" class="form-label">Adresse du site</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                value="{{ old('address', $frontpage->address) }}" required aria-describedby="address_error">
                            @error('address')
                                <span id="address_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="watch_preview" class="form-label">Aperçu de la montre</label>
                            <input type="text" class="form-control @error('watch_preview') is-invalid @enderror" id="watch_preview" name="watch_preview"
                                value="{{ old('watch_preview', $frontpage->watch_preview) }}" aria-describedby="watch_preview_error">
                            @error('watch_preview')
                                <span id="watch_preview_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="facebook" class="form-label">Lien Facebook (optionnel)</label>
                            <input type="url" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook"
                                value="{{ old('facebook', $frontpage->facebook) }}" aria-describedby="facebook_error">
                            @error('facebook')
                                <span id="facebook_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="twitter" class="form-label">Lien Twitter (optionnel)</label>
                            <input type="url" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter"
                                value="{{ old('twitter', $frontpage->twitter) }}" aria-describedby="twitter_error">
                            @error('twitter')
                                <span id="twitter_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="instagram" class="form-label">Lien Instagram (optionnel)</label>
                            <input type="url" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram"
                                value="{{ old('instagram', $frontpage->instagram) }}" aria-describedby="instagram_error">
                            @error('instagram')
                                <span id="instagram_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="linkedin" class="form-label">Lien LinkedIn (optionnel)</label>
                            <input type="url" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" name="linkedin"
                                value="{{ old('linkedin', $frontpage->linkedin) }}" aria-describedby="linkedin_error">
                            @error('linkedin')
                                <span id="linkedin_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="copyright" class="form-label">Texte de copyright</label>
                            <input type="text" class="form-control @error('copyright') is-invalid @enderror" id="copyright" name="copyright"
                                value="{{ old('copyright', $frontpage->copyright) }}" required aria-describedby="copyright_error">
                            @error('copyright')
                                <span id="copyright_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="currency" class="form-label">Devise du site</label>
                            <input type="text" class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency"
                                value="{{ old('currency', $frontpage->currency) }}" required aria-describedby="currency_error">
                            @error('currency')
                                <span id="currency_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="logo" class="form-label">Logo du site</label>
                            <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo"
                                aria-describedby="logo_error">
                            @error('logo')
                                <span id="logo_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <img id="showImage" src="{{ $frontpage->logo ? asset($frontpage->logo) : url('upload/noimage.jpg') }}"
                                alt="Aperçu du logo du site" class="p-1 mt-2 rounded bg-light border"
                                style="width: 120px; height: 120px; object-fit: contain;">
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour les paramètres du site">Mettre à jour</button>
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
        // Aperçu de l'image
        $('#logo').change(function(e) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Validation du formulaire
        $('#myForm').validate({
            rules: {
                phone: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                address: {
                    required: true,
                },
                facebook: {
                    url: true, // Validation uniquement si le champ est rempli
                },
                twitter: {
                    url: true,
                },
                instagram: {
                    url: true,
                },
                linkedin: {
                    url: true,
                },
                copyright: {
                    required: true,
                },
                currency: {
                    required: true,
                },
            },
            messages: {
                phone: {
                    required: "Veuillez entrer le numéro de téléphone du site",
                },
                email: {
                    required: "Veuillez entrer l'email du site",
                    email: "Veuillez entrer une adresse email valide",
                },
                address: {
                    required: "Veuillez entrer l'adresse du site",
                },
                facebook: {
                    url: "Veuillez entrer une URL valide pour Facebook",
                },
                twitter: {
                    url: "Veuillez entrer une URL valide pour Twitter",
                },
                instagram: {
                    url: "Veuillez entrer une URL valide pour Instagram",
                },
                linkedin: {
                    url: "Veuillez entrer une URL valide pour LinkedIn",
                },
                copyright: {
                    required: "Veuillez entrer le texte de copyright",
                },
                currency: {
                    required: "Veuillez entrer la devise du site",
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