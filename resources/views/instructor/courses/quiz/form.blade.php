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
                    <li class="breadcrumb-item">
                        <a href="{{ route('course.quizzes', $course->id) }}">Quiz</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ isset($quiz) ? 'Modifier' : 'Ajouter' }} un quiz
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">{{ isset($quiz) ? 'Modifier' : 'Ajouter' }} un quiz - {{ $course->course_name }}</h5>
            
            <form method="POST" action="{{ isset($quiz) ? route('update.course.quiz', [$course->id, $quiz->id]) : route('store.course.quiz', $course->id) }}">
                @csrf
                @if(isset($quiz))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label">Titre du quiz</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $quiz->title ?? '') }}" 
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="3">{{ old('description', $quiz->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="duration" class="form-label">Durée (minutes)</label>
                            <input type="number" 
                                   class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" 
                                   name="duration" 
                                   value="{{ old('duration', $quiz->duration ?? 30) }}" 
                                   min="1" 
                                   required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="passing_score" class="form-label">Score minimum (%)</label>
                            <input type="number" 
                                   class="form-control @error('passing_score') is-invalid @enderror" 
                                   id="passing_score" 
                                   name="passing_score" 
                                   value="{{ old('passing_score', $quiz->passing_score ?? 60) }}" 
                                   min="0" 
                                   max="100" 
                                   required>
                            @error('passing_score')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="max_attempts" class="form-label">Tentatives maximum</label>
                            <input type="number" 
                                   class="form-control @error('max_attempts') is-invalid @enderror" 
                                   id="max_attempts" 
                                   name="max_attempts" 
                                   value="{{ old('max_attempts', $quiz->max_attempts ?? 3) }}" 
                                   min="1" 
                                   required>
                            @error('max_attempts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="is_active" class="form-label">Statut</label>
                            <select class="form-select @error('is_active') is-invalid @enderror" 
                                    id="is_active" 
                                    name="is_active" 
                                    required>
                                <option value="1" {{ (old('is_active', $quiz->is_active ?? 1) == 1) ? 'selected' : '' }}>
                                    Actif
                                </option>
                                <option value="0" {{ (old('is_active', $quiz->is_active ?? 1) == 0) ? 'selected' : '' }}>
                                    Inactif
                                </option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($quiz) ? 'Mettre à jour' : 'Créer' }} le quiz
                    </button>
                    <a href="{{ route('course.quizzes', $course->id) }}" class="btn btn-secondary">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection 