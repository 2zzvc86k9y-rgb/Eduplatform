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
                    <li class="breadcrumb-item active" aria-current="page">Rechercher un rapport</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <div class="row">
                        <!-- Formulaire de recherche par date -->
                        <div class="col-md-3 d-flex flex-column">
                            <form id="dateForm" action="{{ route('admin.search.by.date') }}" method="POST" class="row g-3 flex-grow-1" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->has('date'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('date') }}
                                    </div>
                                @endif
                                <div class="form-group col-md-12">
                                    <label for="date" class="form-label">Rechercher par date</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                                    @error('date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-auto">
                                    <div class="gap-3 d-md-flex d-grid align-items-center">
                                        <button type="submit" class="px-4 btn btn-primary" aria-label="Rechercher par date">Rechercher</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Formulaire de recherche par mois et année -->
                        <div class="col-md-6 d-flex flex-column">
                            <form id="monthForm" action="{{ route('admin.search.by.month') }}" method="POST" class="row g-3 flex-grow-1" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->has('month') || $errors->has('year_name'))
                                    <div class="alert alert-danger">
                                        @error('month') {{ $message }} @enderror
                                        @error('year_name') {{ $message }} @enderror
                                    </div>
                                @endif
                                <div class="gap-2 d-flex col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="month" class="form-label">Rechercher par mois</label>
                                        <select name="month" id="month" class="mb-3 form-select @error('month') is-invalid @enderror" aria-label="Sélectionner un mois" required>
                                            <option value="" selected disabled>Sélectionnez un mois</option>
                                            <option value="january" {{ old('month') == 'january' ? 'selected' : '' }}>Janvier</option>
                                            <option value="February" {{ old('month') == 'February' ? 'selected' : '' }}>Février</option>
                                            <option value="March" {{ old('month') == 'March' ? 'selected' : '' }}>Mars</option>
                                            <option value="April" {{ old('month') == 'April' ? 'selected' : '' }}>Avril</option>
                                            <option value="May" {{ old('month') == 'May' ? 'selected' : '' }}>Mai</option>
                                            <option value="June" {{ old('month') == 'June' ? 'selected' : '' }}>Juin</option>
                                            <option value="July" {{ old('month') == 'July' ? 'selected' : '' }}>Juillet</option>
                                            <option value="August" {{ old('month') == 'August' ? 'selected' : '' }}>Août</option>
                                            <option value="September" {{ old('month') == 'September' ? 'selected' : '' }}>Septembre</option>
                                            <option value="October" {{ old('month') == 'October' ? 'selected' : '' }}>Octobre</option>
                                            <option value="November" {{ old('month') == 'November' ? 'selected' : '' }}>Novembre</option>
                                            <option value="December" {{ old('month') == 'December' ? 'selected' : '' }}>Décembre</option>
                                        </select>
                                        @error('month')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="year_name" class="form-label">Année</label>
                                        <select name="year_name" id="year_name" class="mb-3 form-select @error('year_name') is-invalid @enderror" aria-label="Sélectionner une année" required>
                                            <option value="" selected disabled>Sélectionnez une année</option>
                                            <option value="2020" {{ old('year_name') == '2020' ? 'selected' : '' }}>2020</option>
                                            <option value="2021" {{ old('year_name') == '2021' ? 'selected' : '' }}>2021</option>
                                            <option value="2022" {{ old('year_name') == '2022' ? 'selected' : '' }}>2022</option>
                                            <option value="2023" {{ old('year_name') == '2023' ? 'selected' : '' }}>2023</option>
                                            <option value="2024" {{ old('year_name') == '2024' ? 'selected' : '' }}>2024</option>
                                            <option value="2025" {{ old('year_name') == '2025' ? 'selected' : '' }}>2025</option>
                                            <option value="2026" {{ old('year_name') == '2026' ? 'selected' : '' }}>2026</option>
                                        </select>
                                        @error('year_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="gap-3 d-md-flex d-grid align-items-center mt-auto">
                                    <button type="submit" class="px-4 btn btn-primary" aria-label="Rechercher par mois et année">Rechercher</button>
                                </div>
                            </form>
                        </div>

                        <!-- Formulaire de recherche par année -->
                        <div class="col-md-3 d-flex flex-column">
                            <form id="yearForm" action="{{ route('admin.search.by.year') }}" method="POST" class="row g-3 flex-grow-1" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->has('year'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('year') }}
                                    </div>
                                @endif
                                <div class="form-group col-md-12">
                                    <label for="year" class="form-label">Rechercher par année</label>
                                    <select name="year" id="year" class="mb-3 form-select @error('year') is-invalid @enderror" aria-label="Sélectionner une année" required>
                                        <option value="" selected disabled>Sélectionnez une année</option>
                                        <option value="2020" {{ old('year') == '2020' ? 'selected' : '' }}>2020</option>
                                        <option value="2021" {{ old('year') == '2021' ? 'selected' : '' }}>2021</option>
                                        <option value="2022" {{ old('year') == '2022' ? 'selected' : '' }}>2022</option>
                                        <option value="2023" {{ old('year') == '2023' ? 'selected' : '' }}>2023</option>
                                        <option value="2024" {{ old('year') == '2024' ? 'selected' : '' }}>2024</option>
                                        <option value="2025" {{ old('year') == '2025' ? 'selected' : '' }}>2025</option>
                                        <option value="2026" {{ old('year') == '2026' ? 'selected' : '' }}>2026</option>
                                    </select>
                                    @error('year')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-auto">
                                    <div class="gap-3 d-md-flex d-grid align-items-center">
                                        <button type="submit" class="px-4 btn btn-primary" aria-label="Rechercher par année">Rechercher</button>
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

<script type="text/javascript">
    $(document).ready(function() {
        // Validation pour le formulaire de recherche par date
        $('#dateForm').validate({
            rules: {
                date: {
                    required: true,
                },
            },
            messages: {
                date: {
                    required: 'Veuillez sélectionner une date',
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

        // Validation pour le formulaire de recherche par mois et année
        $('#monthForm').validate({
            rules: {
                month: {
                    required: true,
                },
                year_name: {
                    required: true,
                },
            },
            messages: {
                month: {
                    required: 'Veuillez sélectionner un mois',
                },
                year_name: {
                    required: 'Veuillez sélectionner une année',
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

        // Validation pour le formulaire de recherche par année
        $('#yearForm').validate({
            rules: {
                year: {
                    required: true,
                },
            },
            messages: {
                year: {
                    required: 'Veuillez sélectionner une année',
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