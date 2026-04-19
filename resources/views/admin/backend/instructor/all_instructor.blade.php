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
                    <li class="breadcrumb-item active" aria-current="page">Tous les instructeurs</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des instructeurs</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des instructeurs">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom de l'instructeur</th>
                            <th scope="col">Nom d'utilisateur</th>
                            <th scope="col">Email</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allinstructor as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name ?? 'N/A' }}</td>
                                <td>{{ $item->username ?? 'N/A' }}</td>
                                <td>{{ $item->email ?? 'N/A' }}</td>
                                <td>{{ $item->phone ?? 'N/A' }}</td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge bg-success">Actif</span>
                                    @elseif($item->status == 0)
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <form id="statusForm{{ $item->id }}" action="{{ route('update.userstatus') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $item->id }}">
                                        <input type="hidden" name="is_checked" value="{{ $item->status }}">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" id="statusToggle{{ $item->id }}"
                                                {{ $item->status == 1 ? 'checked' : '' }} onchange="updateStatus({{ $item->id }}, this)"
                                                aria-label="Changer le statut de l'instructeur {{ $item->name ?? 'inconnu' }}">
                                            <label class="form-check-label" for="statusToggle{{ $item->id }}">
                                                {{ $item->status == 1 ? 'Actif' : 'Inactif' }}
                                            </label>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun instructeur trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function updateStatus(instructorId, element) {
        const form = document.getElementById('statusForm' + instructorId);
        const isCheckedInput = form.querySelector('input[name="is_checked"]');
        isCheckedInput.value = element.checked ? 1 : 0;
        form.submit();
    }
</script>
@endsection