@extends('instructor.instructor_dashboard')
@section('instructor')


<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        {{-- <div class="breadcrumb-title pe-3">All Category</div> --}}
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tous les Commandes</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.course') }}" class="px-5 btn btn-primary">Ajouter un Cours</a>

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Tableau des Commandes</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>N° Facture</th>
                            <th>Montant</th>
                            <th>Paiement</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItem as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item['payment']['order_date'] }}</td>
                            <td>{{ $item['payment']['invoice_no'] }}</td>
                            <td>{{ $item['payment']['total_amount'] }}</td>
                            <td>{{ $item['payment']['payment_type'] }}</td>
                            <td><span class="badge rounded-pill bg-success">{{ $item['payment']['status'] }}</span></td>



                            <td>
                                <div class="gap-2 btn-group">
                                    <a href="{{ route('instructor.order.details', $item->payment->id) }}" class="px-2 btn btn-success" title="Voir"><i class="lni lni-eye"></i></a>
                                    <a href="{{ route('instructor.order.invoice', $item->payment->id) }}" class="px-2 btn btn-danger" title="Télécharger"><i class="lni lni-download"></i></a>

                                </div>
                            </td>
 
                        </tr>
                        @endforeach

                </table>
            </div>
        </div>
    </div>

</div>

@endsection
