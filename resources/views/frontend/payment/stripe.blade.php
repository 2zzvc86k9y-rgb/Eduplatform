<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Paiement | EduPlatform</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontend/images/favicon.png') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tooltipster.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- end inject -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <script src="https://js.stripe.com/v3/"></script>

    <style>
            a{
                text-decoration:none;
                color:black;
                font-width:bold;
            }
    </style>
</head>

<body>
    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    <!--======================================
        START HEADER AREA
    ======================================-->
    @include('frontend.layout.header')
    <!--======================================
        END HEADER AREA
======================================-->

<style>
    .StripeElement {
      box-sizing: border-box;
      height: 40px;
      padding: 10px 12px;
      border: 1px solid transparent;
      border-radius: 4px;
      background-color: white;
      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
      border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }
    </style>

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="flex-wrap breadcrumb-content d-flex align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="text-white section__title">Paiement Stripe</h2>
            </div>
            <ul class="flex-wrap generic-list-item generic-list-item-white generic-list-item-arrow d-flex align-items-center">
                <li><a href="index.html">Accueil</a></li>
                <li>Paiement Stripe</li>
            </ul>
        </div>
    </div>
</section>
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
          
                            <div class="input-box col-lg-6">
                                <label class="label-text">Nom</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name" value="{{ Auth::user()->name }}"> 
                                </div>
                            </div>
                            <div class="input-box col-lg-6">
                                <label class="label-text">Nom d'utilisateur</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="username" value="{{ Auth::user()->username }}">
                                </div>
                            </div>
                         
                            <div class="input-box col-lg-12">
                                <label class="label-text">Adresse e-mail</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="input-box col-lg-12">
                                <label class="label-text">Numéro de téléphone</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                          
                            <div class="input-box col-lg-12">
                                <label class="label-text">Adresse</label>
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="address" value="{{ Auth::user()->address }}">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card card-item">
                    <div class="card-body">
                        <h3 class="pb-3 card-title fs-22">Sélectionner le mode de paiement</h3>
                        <div class="divider"><span></span></div>

                       <div class="col-lg-12">
                            <div class="p-40 border cart-totals">
                                <div class="divider-2 mb-30">
                                    <div class="table-responsive order-table checkout">
                                        <form action="{{ route('stripe.order') }}" method="POST" id="payment-form">
                                            @csrf
                                            <input type="hidden" name="name" value="{{ $data['name'] }}">
                                            <input type="hidden" name="email" value="{{ $data['email'] }}">
                                            <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                                            <input type="hidden" name="address" value="{{ $data['address'] }}">
                                            <div class="form-row">
                                                <label for="card-element">Carte de crédit ou de débit</label>
                                                <div id="card-element">
                                                    <!-- Élément Stripe sera inséré ici -->
                                                </div>
                                                <div id="card-errors" role="alert"></div>
                                                <br>
                                                <button class="btn btn-primary">Soumettre le paiement</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                       </div>
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
                                <span>${{ $cartTotal }}</span>
                            </li>
                            <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                <span class="text-black">Total :</span>
                                <span>${{ $cartTotal }}</span>
                            </li>
                        </ul>
                        <input type="hidden" name="total" value="{{ $cartTotal }}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    // Créer un client Stripe
var stripe = Stripe('pk_test_51PShl909xhMv6pOrDy3phk9K18gxkG58hvllLvWEMg2ExGNKUP3M4L3EUDe4Is2sdCofwZKut5BBHCcWLh2vNufz00G0ApZBzQ');
    
    // Créer une instance d'Elements
var elements = stripe.elements();
    
    // Style personnalisé
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};
    
    // Créer une instance de l'élément carte
var card = elements.create('card', {style: style});
    
    // Ajouter l'instance de l'élément carte dans le div 'card-element'
card.mount('#card-element');
    
    // Gérer les erreurs de validation en temps réel
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
    
    // Gérer la soumission du formulaire
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(card).then(function(result) {
    if (result.error) {
          // Informer l'utilisateur en cas d'erreur
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
          // Envoyer le token au serveur
      stripeTokenHandler(result.token);
    }
  });
});
    
    // Soumettre le formulaire avec l'ID du token
function stripeTokenHandler(token) {
      // Insérer l'ID du token dans le formulaire pour l'envoyer au serveur
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
      // Soumettre le formulaire
  form.submit();
}
</script>

<script src="https://js.stripe.com/v3/"></script>

    <!-- ================================
         END FOOTER AREA
================================= -->
@include('frontend.layout.footer')
<!-- ================================
      END FOOTER AREA
================================= -->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="la la-arrow-up" title="Aller en haut"></i>
</div>
<!-- end scroll top -->

<!-- template js files -->
<script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.js') }}"></script>
<script src="{{ asset('frontend/js/waypoint.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/fancybox.js') }}"></script>
<script src="{{ asset('frontend/js/datedropper.min.js') }}"></script>
<script src="{{ asset('frontend/js/emojionearea.min.js') }}"></script>
<script src="{{ asset('frontend/js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.lazy.min.js') }}"></script>
<script src="{{ asset('frontend/js/plyr.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    var player = new Plyr('#player');
</script>

<script type="text/javascript">
$(document).ready(function() {
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
});
</script>
</body>
</html>