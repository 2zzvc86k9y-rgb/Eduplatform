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
                    <li class="breadcrumb-item active" aria-current="page">Modifier les paramètres SMTP</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier les paramètres SMTP</h5>
                    <form id="myForm" action="{{ route('update.smtpsetting') }}" method="POST" class="row g-3">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $smtps->id ?? ''}}">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="mailer" class="form-label">Mailer</label>
                            <input type="text" class="form-control @error('mailer') is-invalid @enderror" id="mailer" name="mailer"
                                value="{{ old('mailer', $smtps->mailer ?? '') }}" required aria-describedby="mailer_error">
                            @error('mailer')
                                <span id="mailer_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="host" class="form-label">Hôte</label>
                            <input type="text" class="form-control @error('host') is-invalid @enderror" id="host" name="host"
                                value="{{ old('host', $smtps->host ?? '') }}" required aria-describedby="host_error">
                            @error('host')
                                <span id="host_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="port" class="form-label">Port</label>
                            <input type="text" class="form-control @error('port') is-invalid @enderror" id="port" name="port"
                                value="{{ old('port', $smtps->port ?? '') }}" required aria-describedby="port_error">
                            @error('port')
                                <span id="port_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                                value="{{ old('username', $smtps->username ?? '') }}" required aria-describedby="username_error">
                            @error('username')
                                <span id="username_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                value="{{ old('password', $smtps->password ?? '') }}" required aria-describedby="password_error">
                            @error('password')
                                <span id="password_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="encryption" class="form-label">Chiffrement</label>
                            <input type="text" class="form-control @error('encryption') is-invalid @enderror" id="encryption" name="encryption"
                                value="{{ old('encryption', $smtps->encryption ?? '') }}" required aria-describedby="encryption_error">
                            @error('encryption')
                                <span id="encryption_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="from_address" class="form-label">Adresse d'expéditeur</label>
                            <input type="email" class="form-control @error('from_address') is-invalid @enderror" id="from_address" name="from_address"
                                value="{{ old('from_address', $smtps->from_address ?? '') }}" required aria-describedby="from_address_error">
                            @error('from_address')
                                <span id="from_address_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour les paramètres SMTP">Mettre à jour</button>
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
        $('#myForm').validate({
            rules: {
                mailer: {
                    required: true,
                },
                host: {
                    required: true,
                },
                port: {
                    required: true,
                    digits: true,
                },
                username: {
                    required: true,
                },
                password: {
                    required: true,
                },
                encryption: {
                    required: true,
                },
                from_address: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                mailer: {
                    required: "Veuillez entrer le mailer",
                },
                host: {
                    required: "Veuillez entrer l'hôte",
                },
                port: {
                    required: "Veuillez entrer le port",
                    digits: "Le port doit être un nombre entier",
                },
                username: {
                    required: "Veuillez entrer le nom d'utilisateur",
                },
                password: {
                    required: "Veuillez entrer le mot de passe",
                },
                encryption: {
                    required: "Veuillez entrer le type de chiffrement",
                },
                from_address: {
                    required: "Veuillez entrer l'adresse d'expéditeur",
                    email: "Veuillez entrer une adresse email valide",
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