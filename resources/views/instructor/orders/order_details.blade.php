@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
            <div class="breadcrumb-title pe-3">Informations de la commande</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="p-0 mb-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Détails de la commande</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <h2>Informations de paiement</h2>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nom</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                       <Strong>{{$payment->name}}</strong>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <Strong>{{$payment->email}}</strong>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Téléphone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <Strong>{{$payment->phone}}</strong>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Adresse</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <Strong>{{$payment->address}}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Montant du paiement</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                       <strong>${{$payment->total_amount}}</strong>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Type de paiement</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <Strong>{{$payment->cash_delivery}}</strong>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">N° de facture</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <Strong>{{$payment->invoice_no}}</strong>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date de commande</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <Strong>{{$payment->order_date}}</strong>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Statut de la commande</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    @if($payment->status == 'Pending')
                                        <a href="" class="btn btn-block btn-success">En attente</a>
                                    @elseif($payment->status == 'Confirm')
                                        <a href="" class="btn btn-block btn-success">Confirmé</a>
                                    @endif
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 ms-3">
                                <div class="table-responsive">
                                    <table class="table" style="font-width:600;">
                                        <tbody>
                                            <tr>
                                                <td class="col-md-1">Image</td>
                                                <td class="col-md-2">Nom du cours</td>
                                                <td class="col-md-2">Catégorie</td>
                                                <td class="col-md-2">Instructeur</td>
                                                <td class="col-md-1">Prix</td>
                                            </tr>
                                            @php
                                            $totalPrice = 0;
                                            @endphp

                                            @foreach ($orderItem as $item)
                                            <tr>
                                                <td class="col-md-1">
                                                    <label for=""><img src="{{ asset($item->course->course_image) }}" alt="" width="50" height="50"></label>
                                                </td>
                                                <td class="col-md-2">{{ $item->course->course_name }}</td>
                                                <td class="col-md-2">{{ $item->course->category->category_name }}</td>
                                                <td class="col-md-2">{{ $item->instructor->name }}</td>
                                                <td class="col-md-1">${{ $item->price }}</td>
                                            </tr>

                                            @php
                                            $totalPrice += $item->price;
                                            @endphp
                                            @endforeach

                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="col-md-3">
                                                    <strong>Prix total :</strong>
                                                </td>
                                                <td class="col-md-3">
                                                    <strong>${{$totalPrice}}</strong>
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

    {{-- select image show in the img  --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
