@extends('frontend.master')
@section('home')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title')
Paiement TMoney | EduPlatform
@endsection

@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="flex-wrap breadcrumb-content d-flex align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="text-white section__title">Paiement TMoney</h2>
            </div>
            <ul class="flex-wrap generic-list-item generic-list-item-white generic-list-item-arrow d-flex align-items-center">
                <li><a href="index.html">Accueil</a></li>
                <li>Paiement TMoney</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START CONTACT AREA
================================= -->
<section class="cart-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="pb-3 card-title fs-22">Détails de facturation</h3>
                        <div class="divider"><span></span></div>

                        <form method="post" id="tmoneyPaymentForm">
                            @csrf

                            <div class="input-box col-lg-6">
                                <label class="label-text">Nom</label>
                                <div class="form-group">
                                    <input class="form-control form--control" id="name" type="text" name="name" value="{{ Auth::user()->name }}" required>
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div>

                            <div class="input-box col-lg-6">
                                <label class="label-text">Numéro TMoney</label>
                                <div class="form-group">
                                    <input class="form-control form--control" id="tmoney_number" type="text" name="tmoney_number" placeholder="Entrez votre numéro TMoney" required>
                                    <span class="la la-mobile input-icon"></span>
                                </div>
                            </div>

                            <div class="input-box col-lg-12">
                                <label class="label-text">Adresse e-mail</label>
                                <div class="form-group">
                                    <input class="form-control form--control" id="email" type="email" name="email" value="{{ Auth::user()->email }}" required>
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                            </div>

                            <div class="btn-box col-lg-12">
                                <div class="mb-4 custom-control custom-checkbox fs-15">
                                    <input type="checkbox" class="custom-control-input" id="agreeCheckbox" required>
                                    <label class="custom-control-label custom--control-label" for="agreeCheckbox">J'accepte les
                                        <a href="terms-and-conditions.html" class="text-color hover-underline">conditions générales</a> et la
                                        <a href="privacy-policy.html" class="text-color hover-underline">politique de confidentialité</a>
                                    </label>
                                </div>
                                <p class="pb-1 text-black-50"><i class="mr-1 la la-lock fs-24"></i>Connexion sécurisée</p>
                                <p class="fs-14">Vos informations sont en sécurité avec nous !</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="pb-3 card-title fs-22">Détails de la commande</h3>
                        <div class="divider"><span></span></div>
                        <div class="order-details-lists">
                            @foreach ($carts as $cart)
                            <input type="hidden" name="slug[]" value="{{ $cart->options->slug }}">
                            <input type="hidden" name="course_id[]" value="{{ $cart->id }}">
                            <input type="hidden" name="course_title[]" value="{{ $cart->name }}">
                            <input type="hidden" name="price[]" value="{{ $cart->price }}">
                            <input type="hidden" name="instructor_id[]" value="{{ $cart->options->instructor_id }}">

                            <div class="pb-3 mb-3 media media-card border-bottom border-bottom-gray">
                                <a href="{{url('course/details/'.$cart->id.'/'.$cart->options->slug)}}" class="media-img">
                                    <img src="{{ asset($cart->options->image) }}" alt="Image du panier">
                                </a>
                                <div class="media-body">
                                    <h5 class="pb-2 fs-15"><a href="{{url('course/details/'.$cart->id.'/'.$cart->options->slug)}}">{{ $cart->name }}</a></h5>
                                    <p class="text-black font-weight-semi-bold lh-18">{{ $cart->price }} </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('mycart') }}" class="btn-text"><i class="mr-1 la la-edit"></i>Modifier</a>
                    </div>
                </div>

                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="pb-3 card-title fs-22">Résumé de la commande</h3>
                        <div class="divider"><span></span></div>

                        @if (Session::has('cupon'))
                        <ul class="generic-list-item generic-list-item-flash fs-15">
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Sous-total :</span>
                                <span>${{ $cartTotal }}</span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Nom du coupon :</span>
                                <span>{{ session()->get('cupon')['cupon_name'] }} ({{ session()->get('cupon')['cupon_discount'] }}%)</span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Réduction du coupon :</span>
                                <span>-$ {{ session()->get('cupon')['cupon_validity'] }}</span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                <span class="text-black">Total :</span>
                                <span>${{ session()->get('cupon')['total_amount'] }}</span>
                            </li>
                        </ul>
                        <input type="hidden" name="total" value="{{ $cartTotal }}">
                        @else
                        <ul class="generic-list-item generic-list-item-flash fs-15">
                            <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                <span class="text-black">Prix total :</span>
                                <span>{{ $setting->currency }} {{ $cartTotal }}</span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                <span class="text-black">Total :</span>
                                <span>{{ $setting->currency }} {{ $cartTotal }}</span>
                            </li>
                        </ul>
                        <input type="hidden" id="total" name="total" value="{{ $cartTotal }}">
                        @endif

                        <div class="pt-3 btn-box border-top border-top-gray">
                            <p class="mb-2 fs-14 lh-22">EduPlatform est tenu par la loi de collecter les taxes de transaction applicables pour les achats effectués dans certaines juridictions fiscales.</p>
                            <p class="mb-3 fs-14 lh-22">En finalisant votre achat, vous acceptez ces <a href="#" class="text-color hover-underline">Conditions d'utilisation.</a></p>

                            <button type="button" class="btn btn-primary btn-lg btn-block" id="tmoneyPayBtn">
                                Payer avec TMoney
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tmoneyPayBtn').click(function(e) {
            e.preventDefault();
            
            var formData = {
                name: $('#name').val(),
                tmoney_number: $('#tmoney_number').val(),
                email: $('#email').val(),
                total: $('#total').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: "{{ route('pay-via-tmoney') }}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    if(response.success) {
                        window.location.href = response.redirect_url;
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Une erreur est survenue lors du traitement de votre paiement.');
                }
            });
        });
    });
</script> 