@extends('./admin.admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <!-- Fil d'Ariane -->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">Profil utilisateur</div>
            <div class="ps-3">
                <nav aria-label="Fil d'Ariane">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" aria-label="Retour à l'accueil"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil utilisateur</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="text-center d-flex flex-column align-items-center">
                                    <img src="{{ !empty($profileData->photo) ? url('upload/admin_image/' . $profileData->photo) : url('upload/noimage.jpg') }}"
                                        alt="Photo de profil de {{ $profileData->name ?? 'l\'administrateur' }}" class="p-1 rounded bg-primary" width="110">
                                    <div class="mt-3">
                                        <h4>{{ $profileData->name ?? 'Nom indisponible' }}</h4>
                                        <p class="mb-1 text-secondary">{{ $profileData->username ?? 'Utilisateur' }}</p>
                                        <p class="text-muted font-size-sm">{{ $profileData->email ?? 'Email indisponible' }}</p>
                                        <button class="btn btn-primary" aria-label="Suivre {{ $profileData->name ?? 'l\'administrateur' }}">Suivre</button>
                                        <button class="btn btn-outline-primary" aria-label="Envoyer un message à {{ $profileData->name ?? 'l\'administrateur' }}">Message</button>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <ul class="list-group list-group-flush">
                                    @if(!empty($profileData->github))
                                        <li class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline">
                                                    <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                                </svg>
                                                GitHub
                                            </h6>
                                            <a href="{{ $profileData->github }}" class="text-secondary" target="_blank" aria-label="Profil GitHub de {{ $profileData->name ?? 'l\'administrateur' }}">codervent</a>
                                        </li>
                                    @endif
                                    @if(!empty($profileData->twitter))
                                        <li class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info">
                                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                                </svg>
                                                Twitter
                                            </h6>
                                            <a href="{{ $profileData->twitter }}" class="text-secondary" target="_blank" aria-label="Profil Twitter de {{ $profileData->name ?? 'l\'administrateur' }}">{{ $profileData->twitter }}</a>
                                        </li>
                                    @endif
                                    @if(!empty($profileData->instagram))
                                        <li class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger">
                                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                                </svg>
                                                Instagram
                                            </h6>
                                            <a href="{{ $profileData->instagram }}" class="text-secondary" target="_blank" aria-label="Profil Instagram de {{ $profileData->name ?? 'l\'administrateur' }}">{{ $profileData->instagram }}</a>
                                        </li>
                                    @endif
                                    @if(!empty($profileData->facebook))
                                        <li class="flex-wrap list-group-item d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary">
                                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                                </svg>
                                                Facebook
                                            </h6>
                                            <a href="{{ $profileData->facebook }}" class="text-secondary" target="_blank" aria-label="Profil Facebook de {{ $profileData->name ?? 'l\'administrateur' }}">{{ $profileData->facebook }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                                @csrf
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="mb-3 row">
                                        <label for="name" class="col-sm-3 col-form-label">Nom</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $profileData->name) }}" placeholder="Entrez votre nom" required />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $profileData->email) }}" placeholder="Entrez votre email" required />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="phone" class="col-sm-3 col-form-label">Téléphone</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $profileData->phone) }}" placeholder="Entrez votre numéro de téléphone" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="address" class="col-sm-3 col-form-label">Adresse</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $profileData->address) }}" placeholder="Entrez votre adresse" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="image" class="col-sm-12 col-form-label">Image de profil</label>
                                        <div class="col-sm-9">
                                            <input id="image" type="file" name="photo" class="form-control" accept="image/*" />
                                            <img id="showImage" src="{{ !empty($profileData->photo) ? url('upload/admin_image/' . $profileData->photo) : url('upload/noimage.jpg') }}"
                                                alt="Aperçu de l'image de profil" class="p-1 mt-2 rounded bg-primary" width="60">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                            <input type="submit" class="px-4 btn btn-primary" value="Enregistrer les modifications" aria-label="Enregistrer les modifications du profil" />
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
            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#showImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            });

            // Validation côté client
            $('#profileForm').on('submit', function(e) {
                let isValid = true;
                const name = $('#name').val().trim();
                const email = $('#email').val().trim();

                if (!name) {
                    alert('Le champ Nom est requis.');
                    isValid = false;
                }
                if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    alert('Veuillez entrer un email valide.');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection