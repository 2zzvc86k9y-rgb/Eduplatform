@extends('./admin.admin_dashboard')

@section('admin')
<!-- Inclure jQuery si ce n'est pas déjà dans le layout -->
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
                    <li class="breadcrumb-item active" aria-current="page">Toutes les catégories de blog</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal" aria-label="Ajouter une catégorie de blog">
                    Ajouter une catégorie de blog
                </button>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des catégories</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des catégories de blog">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom de la catégorie</th>
                            <th scope="col">Slug de la catégorie</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->category_name ?? 'N/A' }}</td>
                                <td>{{ $item->category_slug ?? 'N/A' }}</td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <button type="button" class="px-5 btn btn-success" data-bs-toggle="modal" data-bs-target="#editCategoryModal"
                                            id="{{ $item->id }}" onclick="categoryEdit(this.id)" aria-label="Modifier la catégorie {{ $item->category_name ?? 'inconnue' }}">
                                            Modifier
                                        </button>
                                        <a href="{{ route('delete.blog.category', $item->id) }}" class="px-5 btn btn-danger delete-category"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"
                                            aria-label="Supprimer la catégorie {{ $item->category_name ?? 'inconnue' }}">
                                            Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucune catégorie trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour créer une catégorie de blog -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Ajouter une catégorie de blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm" action="{{ route('blog.category.store') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group col-md-12">
                        <label for="category_name_create" class="form-label">Nom de la catégorie de blog</label>
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name_create" name="category_name"
                            value="{{ old('category_name') }}" required aria-describedby="category_name_error">
                        @error('category_name')
                            <span id="category_name_error" class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" aria-label="Enregistrer la nouvelle catégorie">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour modifier une catégorie de blog -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Modifier une catégorie de blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" action="{{ route('blog.category.update') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <input type="hidden" name="cat_id" id="cat_id">
                    <div class="form-group col-md-12">
                        <label for="category_name_edit" class="form-label">Nom de la catégorie de blog</label>
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name_edit" name="category_name"
                            value="{{ old('category_name') }}" required aria-describedby="category_name_edit_error">
                        @error('category_name')
                            <span id="category_name_edit_error" class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" aria-label="Enregistrer les modifications">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fonction pour éditer une catégorie
    function categoryEdit(id) {
        $.ajax({
            type: "GET",
            url: "/edit/blog/category/" + id,
            dataType: "JSON",
            success: function(data) {
                $('#category_name_edit').val(data.category_name);
                $('#cat_id').val(data.id);
                $('#editCategoryModal').modal('toggle');
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite lors de la récupération des données de la catégorie.");
            }
        });
    }

    // Validation des formulaires avec jQuery Validate
    $(document).ready(function() {
        $('#createCategoryForm').validate({
            rules: {
                category_name: {
                    required: true,
                },
            },
            messages: {
                category_name: {
                    required: "Veuillez entrer un nom pour la catégorie",
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

        $('#editCategoryForm').validate({
            rules: {
                category_name: {
                    required: true,
                },
            },
            messages: {
                category_name: {
                    required: "Veuillez entrer un nom pour la catégorie",
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