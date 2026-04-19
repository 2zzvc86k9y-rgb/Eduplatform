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
                    <li class="breadcrumb-item active" aria-current="page">Tous les utilisateurs</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des utilisateurs</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des utilisateurs">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ !empty($item->photo) ? url('upload/user_image/' . $item->photo) : url('upload/noimage.jpg') }}"
                                        alt="Photo de l'utilisateur {{ $item->name ?? 'inconnu' }}" class="img-fluid rounded" width="50" height="50">
                                </td>
                                <td>{{ $item->name ?? 'N/A' }}</td>
                                <td>{{ $item->email ?? 'N/A' }}</td>
                                <td>{{ $item->phone ?? 'N/A' }}</td>
                                <td>
                                    @if ($item->userOnline())
                                        <span class="badge badge-pill bg-success">Actif maintenant</span>
                                    @else
                                        <span class="badge badge-pill bg-danger">
                                            Dernière connexion : {{ Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun utilisateur trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection