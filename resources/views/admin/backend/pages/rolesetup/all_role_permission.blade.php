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
                    <li class="breadcrumb-item active" aria-current="page">Tous les rôles et permissions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group gap-2">
                <a href="{{ route('admin.role.permission') }}" class="btn btn-primary" aria-label="Ajouter des permissions à un rôle">Ajouter des permissions à un rôle</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des rôles et permissions</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des rôles et permissions">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom du rôle</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name ?? 'N/A' }}</td>
                                <td>
                                    @forelse($item->permissions as $permission)
                                        <span class="badge bg-primary">{{ $permission->name ?? 'N/A' }}</span> 
                                    @empty
                                        <span class="text-muted">Aucune permission</span>
                                    @endforelse
                                </td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('edit.role.in.permission', $item->id) }}" class="px-5 btn btn-success"
                                            aria-label="Modifier les permissions du rôle {{ $item->name ?? 'inconnu' }}">Modifier</a>
                                        <a href="{{ route('delete.role.in.permission', $item->id) }}" class="px-5 btn btn-danger delete-role-permission"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle et ses permissions ?')"
                                            aria-label="Supprimer le rôle {{ $item->name ?? 'inconnu' }} et ses permissions">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucun rôle trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection