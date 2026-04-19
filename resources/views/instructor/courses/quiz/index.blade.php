@extends('instructor.instructor_dashboard')

@section('instructor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('instructor.dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('all.course') }}">Cours</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Quiz du cours</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.course.quiz', $course->id) }}" class="px-5 btn btn-primary">Ajouter un quiz</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Quiz du cours: {{ $course->course_name }}</h5>
            
            @if($quizzes->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Questions</th>
                                <th>Durée (min)</th>
                                <th>Score minimum</th>
                                <th>Tentatives max</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                            <tr>
                                <td>{{ $quiz->title }}</td>
                                <td>{{ $quiz->questions->count() }}</td>
                                <td>{{ $quiz->duration }}</td>
                                <td>{{ $quiz->passing_score }}%</td>
                                <td>{{ $quiz->max_attempts }}</td>
                                <td>
                                    @if($quiz->is_active)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-warning">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('edit.course.quiz', [$course->id, $quiz->id]) }}" 
                                           class="btn btn-sm btn-primary"
                                           title="Modifier">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="{{ route('manage.quiz.questions', [$course->id, $quiz->id]) }}"
                                           class="btn btn-sm btn-info"
                                           title="Gérer les questions">
                                            <i class="bx bx-list-check"></i>
                                        </a>
                                        <a href="{{ route('delete.course.quiz', [$course->id, $quiz->id]) }}"
                                           class="btn btn-sm btn-danger"
                                           id="delete"
                                           title="Supprimer">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center p-4">
                    <p>Aucun quiz n'a encore été créé pour ce cours.</p>
                    <a href="{{ route('add.course.quiz', $course->id) }}" class="btn btn-primary">
                        Créer le premier quiz
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection 