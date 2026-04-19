@extends('instructor.instructor_dashboard')

@section('instructor')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="Fil d'Ariane">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('instructor.dashboard') }}" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier une leçon</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.course.lecture', ['id' => $lecture->course_id]) }}" class="px-5 btn btn-primary" aria-label="Retour à la liste des leçons">
                    <i class="bx bx-arrow-back"></i> Retour
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier une leçon</h5>
                    <form id="myForm" action="{{ route('update.course.lecture') }}" method="POST" class="row g-3" enctype="multipart/form-data" role="form" aria-label="Formulaire de modification de leçon">
                        @csrf
                        <input type="hidden" name="id" value="{{ $lecture->id }}">

                        <div class="form-group col-md-6">
                            <label for="lecture_title" class="form-label">Titre de la leçon</label>
                            <input type="text" class="form-control" id="lecture_title" name="lecture_title" value="{{ $lecture->lecture_title }}" aria-label="Titre de la leçon">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="video" class="form-label">Vidéo</label>
                            <input type="file" class="form-control" id="video" name="video" accept="video/*" aria-label="Vidéo de la leçon">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="content" class="form-label">Contenu de la leçon</label>
                            <textarea name="content" id="content" class="form-control" rows="5" placeholder="Contenu de la leçon ..." aria-label="Contenu de la leçon">{{ $lecture->content }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour la leçon">Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                lecture_title: {
                    required: true,
                },
                video: {
                    required: true,
                },
                content: {
                    required: true,
                }
            },
            messages: {
                lecture_title: {
                    required: "Veuillez entrer le titre de la leçon",
                },
                video: {
                    required: "Veuillez uploader la vidéo de la leçon",
                },
                content: {
                    required: "Veuillez entrer le contenu de la leçon",
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

@endsection