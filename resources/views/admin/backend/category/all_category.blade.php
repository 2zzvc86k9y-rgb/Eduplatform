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
                    <li class="breadcrumb-item active" aria-current="page">Toutes les catégories</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.category') }}" class="px-5 btn btn-primary" aria-label="Ajouter une catégorie">Ajouter une catégorie</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des catégories</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des catégories">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nom de la catégorie</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ !empty($item->photo) ? asset($item->photo) : url('upload/noimage.jpg') }}"
                                        alt="Image de la catégorie {{ $item->category_name ?? 'inconnue' }}" class="img-fluid rounded" width="50" height="50">
                                </td>
                                <td>{{ $item->category_name ?? 'N/A' }}</td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('edit.category', $item->id) }}" class="px-5 btn btn-success" aria-label="Modifier la catégorie {{ $item->category_name ?? 'inconnue' }}">Modifier</a>
                                        <a href="{{ route('delete.category', $item->id) }}" class="px-5 btn btn-danger" id="delete"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer la catégorie {{ $item->category_name ?? 'inconnue' }} ?')"
                                            aria-label="Supprimer la catégorie {{ $item->category_name ?? 'inconnue' }}">Supprimer</a>
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
@endsection