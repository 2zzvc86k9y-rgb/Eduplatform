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
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un article de blog</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Ajouter un article de blog</h5>
                    <form id="myForm" action="{{ route('store.blog.post') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="post_title" class="form-label">Titre de l'article</label>
                            <input type="text" class="form-control @error('post_title') is-invalid @enderror" id="post_title" name="post_title"
                                value="{{ old('post_title') }}" required aria-describedby="post_title_error">
                            @error('post_title')
                                <span id="post_title_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="blogcat_id" class="form-label">Nom de la catégorie de blog</label>
                            <select name="blogcat_id" id="blogcat_id" class="mb-3 form-select @error('blogcat_id') is-invalid @enderror"
                                aria-label="Sélectionner une catégorie de blog" required>
                                <option value="" selected disabled>Sélectionnez une catégorie</option>
                                @foreach ($blogCat as $item)
                                    <option value="{{ $item->id }}" {{ old('blogcat_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('blogcat_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="long_description" class="form-label">Description de l'article</label>
                            <textarea class="form-control @error('long_description') is-invalid @enderror" name="long_description" id="summernote"
                                placeholder="Écrivez la description de l'article..." rows="3">{{ old('long_description') }}</textarea>
                            @error('long_description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="post_tags" class="form-label">Étiquettes de l'article</label>
                            <input type="text" name="post_tags" id="post_tags" class="form-control @error('post_tags') is-invalid @enderror"
                                data-role="tagsinput" value="{{ old('post_tags', 'jQuery') }}">
                            @error('post_tags')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6"></div>

                        <div class="form-group col-md-6">
                            <label for="post_image" class="form-label">Image de l'article</label>
                            <input class="form-control @error('post_image') is-invalid @enderror" type="file" id="post_image" name="post_image"
                                required aria-describedby="post_image_error">
                            @error('post_image')
                                <span id="post_image_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <img id="showImage" src="{{ url('upload/noimage.jpg') }}" alt="Aperçu de l'image de l'article"
                                class="p-1 mt-2 rounded bg-light border" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Ajouter l'article">Ajouter</button>
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
        $('#post_image').change(function(e) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Validation du formulaire
        $('#myForm').validate({
            rules: {
                post_title: {
                    required: true,
                },
                blogcat_id: {
                    required: true,
                },
                post_image: {
                    required: true,
                },
            },
            messages: {
                post_title: {
                    required: "Veuillez entrer le titre de l'article",
                },
                blogcat_id: {
                    required: "Veuillez sélectionner une catégorie de blog",
                },
                post_image: {
                    required: "Veuillez sélectionner une image pour l'article",
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