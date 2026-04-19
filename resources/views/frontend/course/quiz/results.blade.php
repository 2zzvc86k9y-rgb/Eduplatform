@extends('frontend.master')
@section('main')

<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h4>Résultats du quiz: {{ $quiz->title }}</h4>
                            <div class="mt-3">
                                <h1 class="{{ $attempt->passed ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($attempt->score_percentage, 1) }}%
                                </h1>
                                <p class="text-muted">
                                    Score minimum requis: {{ $quiz->passing_score }}%
                                </p>
                                @if($attempt->passed)
                                    <div class="alert alert-success">
                                        <i class="bx bx-check-circle me-1"></i>
                                        Félicitations ! Vous avez réussi le quiz.
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <i class="bx bx-x-circle me-1"></i>
                                        Vous n'avez pas atteint le score minimum requis.
                                        @if($attempt->remaining_attempts > 0)
                                            Il vous reste {{ $attempt->remaining_attempts }} tentative(s).
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row text-center mb-4">
                            <div class="col-md-4">
                                <div class="border rounded p-3">
                                    <h6 class="text-muted mb-1">Questions correctes</h6>
                                    <h4 class="mb-0 text-success">{{ $attempt->correct_answers }}/{{ $quiz->questions->count() }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3">
                                    <h6 class="text-muted mb-1">Points obtenus</h6>
                                    <h4 class="mb-0">{{ $attempt->score }}/{{ $quiz->total_points }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3">
                                    <h6 class="text-muted mb-1">Temps utilisé</h6>
                                    <h4 class="mb-0">{{ $attempt->duration_minutes }} min</h4>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5 class="mb-3">Révision des réponses</h5>
                            @foreach($attempt->answers as $answer)
                                <div class="card mb-3 {{ $answer->is_correct ? 'border-success' : 'border-danger' }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h6 class="card-title">Question {{ $loop->iteration }}</h6>
                                            <span class="badge {{ $answer->is_correct ? 'bg-success' : 'bg-danger' }}">
                                                {{ $answer->is_correct ? 'Correct' : 'Incorrect' }}
                                                ({{ $answer->points_earned }}/{{ $answer->question->points }} points)
                                            </span>
                                        </div>
                                        
                                        <p class="mb-3">{{ $answer->question->question_text }}</p>
                                        
                                        @if($answer->question->question_type == 'multiple_choice')
                                            <div class="list-group">
                                                @foreach($answer->question->options as $option)
                                                    <div class="list-group-item {{ $option->is_correct ? 'list-group-item-success' : '' }} 
                                                                               {{ $answer->answer == $option->id && !$option->is_correct ? 'list-group-item-danger' : '' }}">
                                                        @if($option->is_correct)
                                                            <i class="bx bx-check text-success me-2"></i>
                                                        @elseif($answer->answer == $option->id)
                                                            <i class="bx bx-x text-danger me-2"></i>
                                                        @endif
                                                        {{ $option->option_text }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @elseif($answer->question->question_type == 'true_false')
                                            <div class="list-group">
                                                <div class="list-group-item {{ $answer->question->correct_answer === 'true' ? 'list-group-item-success' : '' }}
                                                                           {{ $answer->answer === 'true' && $answer->question->correct_answer !== 'true' ? 'list-group-item-danger' : '' }}">
                                                    @if($answer->question->correct_answer === 'true')
                                                        <i class="bx bx-check text-success me-2"></i>
                                                    @elseif($answer->answer === 'true')
                                                        <i class="bx bx-x text-danger me-2"></i>
                                                    @endif
                                                    Vrai
                                                </div>
                                                <div class="list-group-item {{ $answer->question->correct_answer === 'false' ? 'list-group-item-success' : '' }}
                                                                           {{ $answer->answer === 'false' && $answer->question->correct_answer !== 'false' ? 'list-group-item-danger' : '' }}">
                                                    @if($answer->question->correct_answer === 'false')
                                                        <i class="bx bx-check text-success me-2"></i>
                                                    @elseif($answer->answer === 'false')
                                                        <i class="bx bx-x text-danger me-2"></i>
                                                    @endif
                                                    Faux
                                                </div>
                                            </div>
                                        @else
                                            <div class="mb-2">
                                                <strong>Votre réponse:</strong>
                                                <span class="{{ $answer->is_correct ? 'text-success' : 'text-danger' }}">
                                                    {{ $answer->answer }}
                                                </span>
                                            </div>
                                            @if(!$answer->is_correct)
                                                <div>
                                                    <strong>Réponse correcte:</strong>
                                                    <span class="text-success">{{ $answer->question->correct_answer }}</span>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-grid gap-2 col-md-6 mx-auto mt-4">
                            @if(!$attempt->passed && $attempt->remaining_attempts > 0)
                                <a href="{{ route('start.quiz', [$course->id, $quiz->id]) }}" class="btn btn-primary">
                                    Réessayer le quiz
                                </a>
                            @endif
                            <a href="{{ route('course.view', $course->id) }}" class="btn btn-secondary">
                                Retourner au cours
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 