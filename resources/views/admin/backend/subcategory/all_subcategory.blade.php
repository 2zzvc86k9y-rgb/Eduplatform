@extends('./admin.admin_dashboard')

@section('admin')
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
                    <li class="breadcrumb-item active" aria-current="page">Toutes les sous-catégories</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.subcategory') }}" class="px-5 btn btn-primary" aria-label="Ajouter une sous-catégorie">Ajouter une sous-catégorie</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des sous-catégories</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des sous-catégories">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom de la catégorie</th>
                            <th scope="col">Nom de la sous-catégorie</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subcategories as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['category']['category_name'] ?? 'N/A' }}</td>
                                <td>{{ $item->subcategory_name ?? 'N/A' }}</td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('edit.subcategory', $item->id) }}" class="px-5 btn btn-success" aria-label="Modifier la sous-catégorie {{ $item->subcategory_name ?? 'inconnue' }}">Modifier</a>
                                        <a href="{{ route('delete.subcategory', $item->id) }}" class="px-5 btn btn-danger" id="delete"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer la sous-catégorie {{ $item->subcategory_name ?? 'inconnue' }} ?')"
                                            aria-label="Supprimer la sous-catégorie {{ $item->subcategory_name ?? 'inconnue' }}">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucune sous-catégorie trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection