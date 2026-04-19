@extends('frontend.master')
@section('home')
@section('title')
Panier | EduPlatform
@endsection

{{-- change the currency  --}}
@php
    $setting = App\Models\SiteSetting::find(1);
@endphp


<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="flex-wrap breadcrumb-content d-flex align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="text-white section__title">Mon Panier</h2>
            </div>
            <ul class="flex-wrap generic-list-item generic-list-item-white generic-list-item-arrow d-flex align-items-center">
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li>Mon Panier</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->

<section class="cart-area section-padding">
    <div class="container">
        <div class="table-responsive">
            <table class="table generic-table">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Détails du cours</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody id="cartpage">
                </tbody>
            </table>
            <div class="flex-wrap pt-4 d-flex align-items-center justify-content-between">

                @if (Session::has('cupon'))

                @else
                <form action="#">
                    <div class="mb-2 input-group" id="cuponField">
                        <input class="pl-3 form-control form--control" type="text" placeholder="Code promo" id="cupon_name">
                        <div class="input-group-append">
                            <a class="btn theme-btn" type="submit" onclick="applyCupon() ">Appliquer le code</a>
                        </div>
                    </div>
                </form>
                @endif

            </div>

        </div>
        <div class="ml-auto col-lg-4">
            <div class="p-4 bg-gray rounded-rounded mt-40px" id="cuponCalField">


            </div>
            <a href="{{route('checkout')}}" class="btn theme-btn w-100">Commander <i class="ml-1 la la-arrow-right icon"></i></a>
        </div>
    </div><!-- end container -->
</section>



@endsection
