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
                    <li class="breadcrumb-item active" aria-current="page">Modifier une catégorie</li>
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
                    <h5 class="mb-4">Modifier une catégorie</h5>
                    <form id="myForm" action="{{ route('update.category') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $category->id ?? '' }}">

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
                            <label for="input1" class="form-label">Nom de la catégorie</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="input1" name="category_name"
                                value="{{ old('category_name', $category->category_name ?? '') }}" placeholder="Entrez le nom de la catégorie" required>
                            @error('category_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image" class="form-label">Image de la catégorie</label>
                            <input class="form-control @error('photo') is-invalid @enderror" type="file" id="image" name="photo" accept="image/*">
                            @error('photo')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <img id="showImage" src="{{ !empty($category->photo) ? asset($category->photo) : url('upload/noimage.jpg') }}"
                                alt="Aperçu de l'image de la catégorie" class="p-1 mt-2 rounded-circle bg-primary" width="60">
                        </div>
                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Modifier la catégorie">Modifier</button>
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
        $('#image').change(function(e) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#showImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });

        // Validation côté client
        $('#myForm').on('submit', function(e) {
            let isValid = true;
            const categoryName = $('#input1').val().trim();

            if (!categoryName) {
                alert('Veuillez entrer le nom de la catégorie.');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection