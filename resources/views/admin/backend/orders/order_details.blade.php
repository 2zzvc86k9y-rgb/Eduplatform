@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

@extends('./admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <!-- Fil d'Ariane -->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="breadcrumb-title pe-3">Informations sur la commande</div>
        <div class="ps-3">
            <nav aria-label="Fil d'Ariane">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:;" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Détails de la commande</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <h2>Informations de paiement</h2>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->name ?? 'N/A' }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->email ?? 'N/A' }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Téléphone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->phone ?? 'N/A' }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Adresse</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->address ?? 'N/A' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Montant du paiement</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $setting->currency ?? '$' }}{{ $payment->total_amount ?? 'N/A' }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Type de paiement</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->cash_delivery ?? 'N/A' }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Numéro de facture</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->invoice_no ?? 'N/A' }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date de la commande</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <strong>{{ $payment->order_date ?? 'N/A' }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Statut de la commande</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    @if($payment->status == 'Pending')
                                        <a href="{{ route('pending-confirm', $payment->id) }}" class="btn btn-block btn-success" id="confirm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir confirmer cette commande ?')"
                                            aria-label="Confirmer la commande {{ $payment->invoice_no ?? 'inconnue' }}">En attente</a>
                                    @elseif($payment->status == 'Confirm')
                                        <a href="#" class="btn btn-block btn-success" aria-label="Commande confirmée {{ $payment->invoice_no ?? 'inconnue' }}">Confirmée</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card radius-10 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 ms-3">
                            <div class="table-responsive">
                                <table class="table" aria-label="Liste des articles de la commande">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Nom du cours</th>
                                            <th scope="col">Nom de la catégorie</th>
                                            <th scope="col">Instructeur</th>
                                            <th scope="col">Prix</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPrice = 0;
                                        @endphp

                                        @forelse ($orderItem as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ !empty($item->course->course_image) ? asset($item->course->course_image) : url('upload/noimage.jpg') }}"
                                                        alt="Image du cours {{ $item->course->course_name ?? 'inconnu' }}" width="50" height="50" class="rounded">
                                                </td>
                                                <td>{{ $item->course->course_name ?? 'N/A' }}</td>
                                                <td>{{ $item->course->category->category_name ?? 'N/A' }}</td>
                                                <td>{{ $item->instructor->name ?? 'N/A' }}</td>
                                                <td>{{ $setting->currency ?? '$' }}{{ $item->price ?? '0' }}</td>
                                            </tr>

                                            @php
                                                $totalPrice += $item->price ?? 0;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Aucun article trouvé dans cette commande.</td>
                                            </tr>
                                        @endforelse

                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <strong>Prix total :</strong>
                                            </td>
                                            <td>
                                                <strong>{{ $setting->currency ?? '$' }}{{ $totalPrice }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection