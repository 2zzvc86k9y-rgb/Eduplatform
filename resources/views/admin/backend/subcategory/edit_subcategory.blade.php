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
                        <a href="javascript:;" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier une sous-catégorie</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier une sous-catégorie</h5>
                    <form id="myForm" action="{{ route('update.subcategory') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $subcategory->id ?? '' }}">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="category_id" class="form-label">Nom de la catégorie</label>
                            <select class="mb-3 form-select col-md-6 @error('category_id') is-invalid @enderror" id="category_id" name="category_id"
                                aria-label="Sélectionner une catégorie" required>
                                <option value="" disabled>Sélectionnez une catégorie</option>
                                @forelse ($category as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $subcategory->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->category_name ?? 'N/A' }}
                                    </option>
                                @empty
                                    <option value="" disabled>Aucune catégorie disponible</option>
                                @endforelse
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="subcategory_name" class="form-label">Nom de la sous-catégorie</label>
                            <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" id="subcategory_name" name="subcategory_name"
                                value="{{ old('subcategory_name', $subcategory->subcategory_name ?? '') }}" placeholder="Entrez le nom de la sous-catégorie" required>
                            @error('subcategory_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Modifier la sous-catégorie">Modifier</button>
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
                category_id: {
                    required: true,
                },
                subcategory_name: {
                    required: true,
                },
            },
            messages: {
                category_id: {
                    required: 'Veuillez sélectionner une catégorie',
                },
                subcategory_name: {
                    required: 'Veuillez entrer le nom de la sous-catégorie',
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