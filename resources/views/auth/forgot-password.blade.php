@extends('frontend.master')

@section('title', 'Réinitialisation de mot de passe | EduPlatform')

@section('home')
    <!-- ================================
        START BREADCRUMB AREA
    ================================= -->
    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="text-white section__title">Lien de réinitialisation de mot de passe</h2>
                </div>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <div class="mb-4 container w-50 m-auto py-5">
        <p>Vous avez oublié votre mot de passe ? Pas de souci. Indiquez-nous simplement votre adresse email et nous vous enverrons un lien de réinitialisation qui vous permettra d'en choisir un nouveau.</p>
    </div>

    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    <div class="container">
        <div class="card w-50 m-auto py-5" style="box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1); border-radius: 10px;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
    
                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                    </div>
    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Envoyer le lien de réinitialisation') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection