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
                    <li class="breadcrumb-item active" aria-current="page">Tous les avis actifs</li>
                </ol>
            </nav>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des avis</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des avis actifs">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom du cours</th>
                            <th scope="col">Utilisateur</th>
                            <th scope="col">Commentaire</th>
                            <th scope="col">Note</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($review as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item['course']['course_name'] ?? 'N/A' }}</td>
                                <td>{{ $item['user']['name'] ?? 'N/A' }}</td>
                                <td>{{ $item->comment ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $rating = $item->rating ?? 0;
                                    @endphp
                                    <span class="visually-hidden">Note : {{ $rating }} sur 5</span>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bx bxs-star {{ $i <= $rating ? 'text-warning' : 'text-secondary' }}" aria-hidden="true"></i>
                                    @endfor
                                </td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge bg-success">Actif</span>
                                    @elseif($item->status == 0)
                                        <span class="badge bg-danger">Inactif</span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <form id="statusForm{{ $item->id }}" action="{{ route('update.review.status') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="review_id" value="{{ $item->id }}">
                                        <input type="hidden" name="is_checked" value="{{ $item->status }}">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" id="statusToggle{{ $item->id }}"
                                                {{ $item->status == 1 ? 'checked' : '' }}
                                                onchange="updateReviewStatus({{ $item->id }}, this)"
                                                aria-label="Modifier le statut de l'avis {{ $item->id }} (actuellement {{ $item->status == 1 ? 'actif' : 'inactif' }})">
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun avis trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function updateReviewStatus(reviewId, element) {
        const form = document.getElementById(`statusForm${reviewId}`);
        const isCheckedInput = form.querySelector('input[name="is_checked"]');
        const newStatus = element.checked ? 1 : 0;

        // Demander une confirmation avant de modifier le statut
        const confirmationMessage = newStatus === 1
            ? "Êtes-vous sûr de vouloir activer cet avis ?"
            : "Êtes-vous sûr de vouloir désactiver cet avis ?";
        
        if (!confirm(confirmationMessage)) {
            // Annuler le changement si l'utilisateur clique sur "Annuler"
            element.checked = !element.checked;
            return;
        }

        // Mettre à jour la valeur de l'input caché
        isCheckedInput.value = newStatus;

        // Soumettre le formulaire
        form.submit();
    }
</script>
@endsection