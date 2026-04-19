@extends('frontend.master')

@section('title')
Checkout | EduPlatform
@endsection

@section('home')
@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<!-- Fil d'Ariane -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="flex-wrap breadcrumb-content d-flex align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="text-white section__title">Paiement</h2>
            </div>
            <nav aria-label="Fil d'Ariane">
                <ul class="flex-wrap generic-list-item generic-list-item-white generic-list-item-arrow d-flex align-items-center">
                    <li><a href="{{ url('/') }}" aria-label="Retour à l'accueil">Accueil</a></li>
                    <li>Paiement</li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- Zone de paiement -->
<section class="cart-area section--padding">
    <div class="container">
        <div class="row">
            @if (empty($carts) || $carts->isEmpty())
                <div class="col-lg-12">
                    <div class="card card-item shadow-sm">
                        <div class="card-body text-center">
                            <h3 class="pb-3 card-title fs-22">Votre panier est vide</h3>
                            <p class="fs-15">Ajoutez des cours à votre panier pour procéder au paiement.</p>
                            <a href="{{ url('courses') }}" class="btn theme-btn" aria-label="Voir les cours">Voir les cours</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-7">
                    <!-- Détails de facturation -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-3 card-title fs-22">Détails de facturation</h3>
                            <div class="divider"><span></span></div>
                            <form method="POST" action="{{ route('payment') }}" class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="input-box col-lg-6">
                                    <label class="label-text">Nom</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="name" value="{{ Auth::user()->name ?? '' }}" required aria-label="Votre nom">
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box col-lg-6">
                                    <label class="label-text">Nom d'utilisateur</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="username" value="{{ Auth::user()->username ?? '' }}" required aria-label="Votre nom d'utilisateur">
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box col-lg-12">
                                    <label class="label-text">Adresse e-mail</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="email" name="email" value="{{ Auth::user()->email ?? '' }}" required aria-label="Votre adresse e-mail">
                                        <span class="la la-envelope input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box col-lg-12">
                                    <label class="label-text">Numéro de téléphone</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}" required aria-label="Votre numéro de téléphone">
                                        <span class="la la-phone input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box col-lg-12">
                                    <label class="label-text">Adresse</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="address" value="{{ Auth::user()->address ?? '' }}" required aria-label="Votre adresse">
                                        <span class="la la-map-marker input-icon"></span>
                                    </div>
                                </div>
                                <div class="btn-box col-lg-12">
                                    <div class="mb-4 custom-control custom-checkbox fs-15">
                                        <input type="checkbox" class="custom-control-input" id="agreeCheckbox" required aria-label="Accepter les termes et conditions">
                                        <label class="custom-control-label custom--control-label" for="agreeCheckbox">J'accepte les
                                            <a href="{{ url('terms') }}" class="text-color hover-underline">conditions générales</a> et la
                                            <a href="{{ url('privacy') }}" class="text-color hover-underline">politique de confidentialité</a>
                                        </label>
                                    </div>
                                    <p class="pb-1 text-black-50"><i class="mr-1 la la-lock fs-24"></i>Connexion sécurisée</p>
                                    <p class="fs-14">Vos informations sont en sécurité avec nous !</p>
                                </div>
                        </div>
                    </div>

                    <!-- Méthodes de paiement -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-3 card-title fs-22">Choisir une méthode de paiement</h3>
                            <div class="divider"><span></span></div>
                            <div class="payment-option-wrap">
                                <div class="payment-tab is-active">
                                    <div class="payment-tab-toggle">
                                        <input checked id="bankTransfer" name="cash_delivery" type="radio" value="handcash" aria-label="Paiement direct">
                                        <label for="bankTransfer">Paiement direct</label>
                                    </div>
                                </div>
                                <div class="payment-tab">
                                    <div class="payment-tab-toggle">
                                        <input id="stripe" name="cash_delivery" type="radio" value="stripe" aria-label="Paiement par Stripe">
                                        <label for="stripe">Stripe</label>
                                    </div>
                                </div>
                                <div class="payment-tab">
                                    <div class="payment-tab-toggle">
                                        <input id="tmoney" name="cash_delivery" type="radio" value="tmoney" aria-label="Paiement par TMoney">
                                        <label for="tmoney">TMoney</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails de la commande -->
                <div class="col-lg-5">
                    <div class="card card-item shadow-sm">
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
                                        <a href="{{ url('course/details/' . $cart->id . '/' . $cart->options->slug) }}" class="media-img">
                                            <img src="{{ asset($cart->options->image) }}" alt="Image du cours {{ $cart->name }}">
                                        </a>
                                        <div class="media-body">
                                            <h5 class="pb-2 fs-15">
                                                <a href="{{ url('course/details/' . $cart->id . '/' . $cart->options->slug) }}">{{ $cart->name }}</a>
                                            </h5>
                                            <p class="text-black font-weight-semi-bold lh-18">{{ $setting->currency }}{{ $cart->price }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('mycart') }}" class="btn-text" aria-label="Modifier le panier"><i class="mr-1 la la-edit"></i>Modifier</a>
                        </div>
                    </div>

                    <!-- Résumé de la commande -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-3 card-title fs-22">Résumé de la commande</h3>
                            <div class="divider"><span></span></div>
                            @if (Session::has('cupon'))
                                <ul class="generic-list-item generic-list-item-flash fs-15">
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Sous-total :</span>
                                        <span>{{ $setting->currency }}{{ $cartTotal }}</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Nom du coupon :</span>
                                        <span>{{ session()->get('cupon')['cupon_name'] }} ({{ session()->get('cupon')['cupon_discount'] }}%)</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Réduction du coupon :</span>
                                        <span>-{{ $setting->currency }}{{ session()->get('cupon')['cupon_validity'] }}</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                        <span class="text-black">Total :</span>
                                        <span>{{ $setting->currency }}{{ session()->get('cupon')['total_amount'] }}</span>
                                    </li>
                                </ul>
                                <input type="hidden" name="total" value="{{ $cartTotal }}">
                            @else
                                <ul class="generic-list-item generic-list-item-flash fs-15">
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Prix total :</span>
                                        <span>{{ $setting->currency }}{{ $cartTotal }}</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                        <span class="text-black">Total :</span>
                                        <span>{{ $setting->currency }}{{ $cartTotal }}</span>
                                    </li>
                                </ul>
                                <input type="hidden" name="total" value="{{ $cartTotal }}">
                            @endif
                            <div class="pt-3 btn-box border-top border-top-gray">
                                <p class="mb-2 fs-14 lh-22">Code Tree est tenu par la loi de collecter les taxes applicables sur les transactions pour les achats effectués dans certaines juridictions fiscales.</p>
                                <p class="mb-3 fs-14 lh-22">En finalisant votre achat, vous acceptez ces <a href="{{ url('terms') }}" class="text-color hover-underline">conditions générales de service</a>.</p>
                                <button type="submit" class="btn theme-btn w-100" aria-label="Procéder au paiement">Procéder <i class="ml-1 la la-arrow-right icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</section>
@endsection