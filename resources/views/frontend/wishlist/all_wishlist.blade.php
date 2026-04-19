@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

<div class="container-fluid">
    <div class="flex-wrap mb-5 breadcrumb-content d-flex align-items-center justify-content-between">

        <div class="media media-card align-items-center">
            <div class="rounded-full media-img media--img media-img-md">
                <img class="rounded-full" src="{{ !empty($profileData->photo) ? url('upload/user_image/' . $profileData->photo) : url('upload/noimage.jpg') }}" alt="Image miniature de l'étudiant">
            </div>
            <div class="media-body">
                <h2 class="section__title fs-30">Bonjour, {{ $profileData->name }}</h2>
    
            </div><!-- end media-body -->
        </div><!-- end media -->
    
    </div><!-- end breadcrumb-content -->

    <div class="section-block mb-5"></div>
    <div class="dashboard-heading mb-5">
        <h3 class="fs-22 font-weight-semi-bold">Mes Favoris</h3>
    </div>

    <div class="row" id="wishlist">
        
    </div><!-- end row -->
    
</div><!-- end container-fluid -->

@endsection