@extends('instructor.instructor_dashboard')
@section('instructor')







<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Live Chat</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->

    {{-- <div class="setting-body">
        <div class="cat-btn-box mt-28px">
            <h3 class="pb-4 fs-17 font-weight-semi-bold">Live Chat</h3>
            <div id="app">
                <chat-message></chat-message>
            </div>
        </div>
    </div> --}}
    <div class="card">
        
        <div class="card-body">

            <div id="app">
                <chat-message></chat-message> 
               </div>

        </div>
    </div>




</div>




@endsection