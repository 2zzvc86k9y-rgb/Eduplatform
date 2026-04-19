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
                    <li class="breadcrumb-item active" aria-current="page">Tous les coupons</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group gap-2">
                <a href="{{ route('admin.add.cupon') }}" class="px-5 btn btn-primary" aria-label="Ajouter un coupon">Ajouter un coupon</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des coupons</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des coupons">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nom du coupon</th>
                            <th scope="col">Remise</th>
                            <th scope="col">Validité</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cupons as $key => $cupon)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $cupon->cupon_name ?? 'N/A' }}</td>
                                <td>{{ $cupon->cupon_discount ?? '0' }}%</td>
                                <td>
                                    @if($cupon->cupon_validity)
                                        {{ Carbon\Carbon::parse($cupon->cupon_validity)->locale('fr')->format('l d F Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($cupon->cupon_validity)
                                        @if($cupon->cupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge bg-success">Valide</span>
                                        @else
                                            <span class="badge bg-danger">Expiré</span>
                                        @endif
                                    @else
                                        <span class="badge bg-danger">Non défini</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('admin.edit.cupon', $cupon->id) }}" class="px-5 btn btn-success"
                                            aria-label="Modifier le coupon {{ $cupon->cupon_name ?? 'inconnu' }}">Modifier</a>
                                        <a href="{{ route('admin.delete.cupon', $cupon->id) }}" class="px-5 btn btn-danger delete-coupon"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce coupon ?')"
                                            aria-label="Supprimer le coupon {{ $cupon->cupon_name ?? 'inconnu' }}">Supprimer</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun coupon trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection