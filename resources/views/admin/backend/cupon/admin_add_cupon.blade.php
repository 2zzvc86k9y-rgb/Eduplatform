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
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un coupon</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Ajouter un coupon</h5>
                    <form id="myForm" action="{{ route('admin.store.cupon') }}" method="POST" class="row g-3">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="cupon_name" class="form-label">Nom du coupon</label>
                            <input type="text" class="form-control @error('cupon_name') is-invalid @enderror" id="cupon_name" name="cupon_name"
                                value="{{ old('cupon_name') }}" required aria-describedby="cupon_name_error">
                            @error('cupon_name')
                                <span id="cupon_name_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cupon_discount" class="form-label">Remise (%)</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('cupon_discount') is-invalid @enderror" id="cupon_discount" name="cupon_discount"
                                    value="{{ old('cupon_discount') }}" min="0" max="100" step="1" required aria-describedby="cupon_discount_error">
                                <span class="input-group-text">%</span>
                            </div>
                            @error('cupon_discount')
                                <span id="cupon_discount_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cupon_validity" class="form-label">Date de validité</label>
                            <input type="date" class="form-control @error('cupon_validity') is-invalid @enderror" id="cupon_validity" name="cupon_validity"
                                min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ old('cupon_validity') }}"
                                required aria-describedby="cupon_validity_error">
                            @error('cupon_validity')
                                <span id="cupon_validity_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Ajouter le coupon">Ajouter</button>
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
                cupon_name: {
                    required: true,
                },
                cupon_discount: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 100,
                },
                cupon_validity: {
                    required: true,
                    date: true,
                },
            },
            messages: {
                cupon_name: {
                    required: "Veuillez entrer le nom du coupon",
                },
                cupon_discount: {
                    required: "Veuillez entrer la remise",
                    number: "La remise doit être un nombre",
                    min: "La remise doit être au moins 0",
                    max: "La remise ne peut pas dépasser 100",
                },
                cupon_validity: {
                    required: "Veuillez sélectionner une date de validité",
                    date: "Veuillez entrer une date valide",
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