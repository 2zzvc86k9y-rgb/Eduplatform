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
                    <li class="breadcrumb-item active" aria-current="page">Tous les Coupons</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('instructor.add.cupon') }}" class="px-5 btn btn-primary">Ajouter un Coupon</a>

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Tableau des Coupons</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom du Coupon</th>
                            <th>Réduction</th>
                            <th>Validité</th>
                            <th>Statut</th>
                            <th>Cours</th>


                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cupons as $key=> $cupon)
                        <tr>
                            <td>{{ $key+1 }}</td>

                            <td>{{ $cupon->cupon_name }}</td>
                            <td>{{ $cupon->cupon_discount }}%</td>
                            <td>{{ Carbon\Carbon::parse($cupon->cupon_validity)->format('D d F Y') }}</td>
                            <td>
                                @if ($cupon->cupon_validity >= Carbon\Carbon::now()->format('Y m d'))
                                <span class="badge bg-success">Valide</span>
                                @else
                                <span class="badge bg-danger">Invalide</span>
                                @endif
                            </td>
                            <td>{{ $cupon['course']['course_name'] }}</td>


                            <td>
                                <div class="gap-2 btn-group">
                                    <a href="{{ route('instructor.edit.cupon', $cupon->id) }}" class="px-5 btn btn-success">Modifier</a>
                                    <a href="{{ route('instructor.delete.cupon', $cupon->id) }}" class="px-5 btn btn-danger" id="delete">Supprimer</a>

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
