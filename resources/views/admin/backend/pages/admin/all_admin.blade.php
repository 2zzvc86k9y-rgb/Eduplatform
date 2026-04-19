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
                    <li class="breadcrumb-item active" aria-current="page">Tous les administrateurs</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group gap-2">
                <a href="{{ route('add.admin') }}" class="btn btn-primary" aria-label="Ajouter un administrateur">Ajouter un administrateur</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des administrateurs</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des administrateurs">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Rôle</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alladmin as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ !empty($item->photo) ? url('upload/admin_image/' . $item->photo) : url('upload/noimage.jpg') }}"
                                        alt="Photo de {{ $item->name ?? 'l’administrateur' }}" width="50">
                                </td>
                                <td>{{ $item->name ?? 'N/A' }}</td>
                                <td>{{ $item->email ?? 'N/A' }}</td>
                                <td>{{ $item->phone ?? 'N/A' }}</td>
                                <td>
                                    @forelse($item->roles as $role)
                                        <span class="badge bg-primary">{{ $role->name ?? 'N/A' }}</span>
                                    @empty
                                        <span class="text-muted">Aucun rôle</span>
                                    @endforelse
                                </td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('edit.admin', $item->id) }}" class="px-5 btn btn-success"
                                            aria-label="Modifier l’administrateur {{ $item->name ?? 'inconnu' }}">Modifier</a>
                                        <a href="{{ route('delete.admin', $item->id) }}" class="px-5 btn btn-danger delete-admin"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ?')"
                                            aria-label="Supprimer l’administrateur {{ $item->name ?? 'inconnu' }}">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun administrateur trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection