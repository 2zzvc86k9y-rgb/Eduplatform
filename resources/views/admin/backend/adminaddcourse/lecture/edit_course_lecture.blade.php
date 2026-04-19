@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!-- Fil d'Ariane -->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        {{-- <div class="breadcrumb-title pe-3">All Category</div> --}}
        <div class="ps-3">
            <nav aria-label="Fil d'Ariane">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier la leçon</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.course.lecture',['id'=>$lecture->course_id]) }}" class="px-5 btn btn-primary">Retour</a>

            </div>
        </div>
    </div>
    <!--end breadcrumb-->


    <div class="row">
        <div class="mx-auto col-xl-10">

            <div class="card">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier la leçon</h5>
                    <form id="myForm" action="{{ route('update.course.lecture') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $lecture->id }}">
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Titre de la leçon</label>
                            <input type="text" class="form-control" id="input1" name="lecture_title" value="{{ $lecture->lecture_title }}" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">URL de la vidéo</label>
                            <input type="text" class="form-control" id="input1" name="url" value="{{ $lecture->url }}" >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Contenu de la leçon</label>
                           <textarea name="content" id="" class="form-control"> {{ $lecture->content }}</textarea>
                        </div>
                        
                     

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary">Enregistrer</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>




        </div>
    </div>



</div>








@endsection