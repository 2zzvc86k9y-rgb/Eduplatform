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
                    <li class="breadcrumb-item active" aria-current="page">Toutes les commandes confirmées</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <!-- Note : La route 'add.category' semble incorrecte pour 'Add Pending Order'. Remplacer par la route appropriée, par exemple 'add.order'. -->
                <a href="#" class="px-5 btn btn-primary" aria-label="Ajouter une commande en attente">Ajouter une commande</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des commandes</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des commandes en attente">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Date</th>
                            <th scope="col">Numéro de facture</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Paiement</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payment as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->order_date ?? 'N/A' }}</td>
                                <td>{{ $item->invoice_no ?? 'N/A' }}</td>
                                <td>{{ $item->total_amount ?? 'N/A' }}</td>
                                <td>{{ $item->payment_type ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-success">{{ $item->status ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('admin.order.details', $item->id) }}" class="px-5 btn btn-success" aria-label="Voir les détails de la commande {{ $item->invoice_no ?? 'inconnue' }}">Détails</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucune commande en attente trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection