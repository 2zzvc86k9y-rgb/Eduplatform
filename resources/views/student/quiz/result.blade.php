@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')

<div class="quiz-oc-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="quiz-oc-card">
                    <div class="quiz-oc-header text-center mb-4">
                        <h2 class="quiz-oc-title">Résultats du quiz : {{ $quiz->title }}</h2>
                        <div class="quiz-oc-meta">
                            <span class="quiz-oc-meta-item"><i class="la la-trophy"></i> Score min : {{ $quiz->passing_score }}%</span>
                            <span class="quiz-oc-meta-item"><i class="la la-star"></i> {{ $quiz->total_points ?? ($quiz->questions->sum('points') ?? '-') }} pts</span>
            </div>
                        <div class="quiz-oc-result-score mb-2">
                            <span class="quiz-oc-score-value {{ $attempt->passed ? 'text-success' : 'text-danger' }}">{{ $attempt->score }}%</span>
        </div>
                        <div class="quiz-oc-result-badge mb-2">
                            @if($attempt->passed)
                                <span class="quiz-oc-badge bg-success">Bravo ! Quiz réussi</span>
                            @else
                                <span class="quiz-oc-badge bg-danger">Échoué</span>
                            @endif
                        </div>
                        <p class="quiz-oc-result-minscore">Score minimum requis : {{ $quiz->passing_score }}%</p>
                    </div>

                    <div class="quiz-oc-result-questions">
                        @foreach($quiz->questions as $index => $question)
                        @php
                            $userAnswerId = $attempt->answers[$question->id] ?? null;
                            $userOption = $question->options->firstWhere('id', $userAnswerId);
                            $correctOption = $question->options->firstWhere('is_correct', true);
                        @endphp
                        <div class="quiz-oc-result-question mb-4 {{ $userOption && $userOption->is_correct ? 'quiz-oc-correct' : 'quiz-oc-incorrect' }}">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="quiz-oc-step">Question {{ $index + 1 }} / {{ $quiz->questions->count() }}</span>
                                <span class="quiz-oc-badge {{ $userOption && $userOption->is_correct ? 'bg-success' : 'bg-danger' }}">
                                    {{ $userOption && $userOption->is_correct ? 'Correct' : 'Incorrect' }}
                                </span>
                            </div>
                            <h4 class="quiz-oc-question-title">{{ $question->question_text }}</h4>
                            <div class="quiz-oc-options">
                                @foreach($question->options as $option)
                                <label class="quiz-oc-option {{ $option->is_correct ? 'quiz-oc-option-correct' : '' }} {{ $userAnswerId == $option->id ? ($option->is_correct ? 'quiz-oc-option-user-correct' : 'quiz-oc-option-user-wrong') : '' }}">
                                    <input type="radio" disabled {{ $userAnswerId == $option->id ? 'checked' : '' }}>
                                    <span>{{ $option->option_text }}</span>
                                    @if($option->is_correct)
                                        <i class="la la-check text-success ml-2"></i>
                                    @elseif($userAnswerId == $option->id)
                                        <i class="la la-times text-danger ml-2"></i>
                                    @endif
                                        </label>
                                @endforeach
                            </div>
                            @if($userOption && !$userOption->is_correct)
                                <div class="quiz-oc-alert quiz-oc-alert-danger mt-2">
                                    <i class="la la-info-circle"></i> La bonne réponse était :
                                    <strong>{{ $correctOption ? $correctOption->option_text : 'Non trouvée' }}</strong>
                                </div>
                            @endif
                            @if($question->explanation)
                            <div class="quiz-oc-explanation mt-3">
                                <div class="quiz-oc-explanation-card">
                                        <h6>Explication :</h6>
                                        <p>{{ $question->explanation }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <div class="quiz-oc-actions mt-4">
                        <a href="{{ route('course.view', $quiz->course_id) }}" class="quiz-oc-btn quiz-oc-btn-secondary">
                            Retour au cours
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.quiz-oc-bg {
    background: linear-gradient(135deg, #fdf1e3 0%, #f7e9d7 100%);
    min-height: 100vh;
    padding: 40px 0;
}
.quiz-oc-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px #3578e51a;
    padding: 38px 32px 32px 32px;
    max-width: 700px;
    margin: 0 auto;
}
.quiz-oc-header {
    margin-bottom: 18px;
}
.quiz-oc-title {
    font-size: 2rem;
    font-weight: 700;
    color: #3578e5;
    margin-bottom: 8px;
}
.quiz-oc-meta {
    display: flex;
    justify-content: center;
    gap: 18px;
    font-size: 1.08rem;
    color: #b47b5c;
    margin-bottom: 8px;
}
.quiz-oc-meta-item i {
    margin-right: 4px;
}
.quiz-oc-result-score {
    font-size: 2.5rem;
    font-weight: 700;
}
.quiz-oc-result-badge .quiz-oc-badge {
    font-size: 1.1rem;
    padding: 6px 18px;
}
.quiz-oc-result-minscore {
    color: #b47b5c;
    font-size: 1.08rem;
}
.quiz-oc-result-questions {
    margin-top: 32px;
}
.quiz-oc-result-question {
    background: #fffbe6;
    border-radius: 14px;
    box-shadow: 0 2px 12px #ff98001a;
    padding: 24px 22px 18px 22px;
    margin-bottom: 18px;
    border-left: 6px solid #43e97b;
}
.quiz-oc-incorrect {
    border-left: 6px solid #ff9800;
}
.quiz-oc-step {
    font-size: 1.08rem;
    color: #3578e5;
    font-weight: 600;
}
.quiz-oc-badge {
    background: #43e97b;
    color: #fff;
    border-radius: 8px;
    padding: 4px 14px;
    font-size: 1em;
    font-weight: 600;
}
.quiz-oc-badge.bg-danger {
    background: #ff9800 !important;
}
.quiz-oc-badge.bg-success {
    background: #43e97b !important;
}
.quiz-oc-question-title {
    font-size: 1.18rem;
    font-weight: 600;
    color: #222;
    margin-bottom: 14px;
}
.quiz-oc-options {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.quiz-oc-option {
    display: flex;
    align-items: center;
    background: #fdf1e3;
    border-radius: 8px;
    padding: 12px 18px;
    font-size: 1.08rem;
    cursor: pointer;
    transition: background 0.2s;
    border: 1px solid transparent;
    margin-bottom: 4px;
}
.quiz-oc-option-correct {
    background: #d4edda !important;
    border-color: #43e97b !important;
}
.quiz-oc-option-user-correct {
    box-shadow: 0 0 0 2px #43e97b44;
}
.quiz-oc-option-user-wrong {
    background: #f8d7da !important;
    border-color: #ff9800 !important;
    box-shadow: 0 0 0 2px #ff980044;
}
.quiz-oc-alert {
    border-radius: 8px;
    padding: 10px 16px;
    font-size: 1.05rem;
    margin-top: 10px;
}
.quiz-oc-alert-danger {
    background: #ffe0b2;
    color: #b47b5c;
    border: 1px solid #ff9800;
}
.quiz-oc-explanation-card {
    background: #f4f6fa;
    border-radius: 8px;
    padding: 12px 18px;
    font-size: 1rem;
    color: #444;
}
.quiz-oc-actions {
    display: flex;
    gap: 18px;
    justify-content: center;
    margin-top: 18px;
}
.quiz-oc-btn {
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 32px;
    font-size: 1.1rem;
    font-weight: 600;
    box-shadow: 0 2px 8px #3578e522;
    transition: background 0.2s;
    text-decoration: none;
    display: inline-block;
}
.quiz-oc-btn:hover {
    background: linear-gradient(90deg, #38f9d7 0%, #3578e5 100%);
    color: #fff;
    box-shadow: 0 4px 16px #3578e533;
}
.quiz-oc-btn-secondary {
    background: #fff;
    color: #3578e5;
    border: 1px solid #3578e5;
}
.quiz-oc-btn-secondary:hover {
    background: #fdf1e3;
    color: #3578e5;
}
@media (max-width: 700px) {
    .quiz-oc-card {
        padding: 12px 2px;
    }
    .quiz-oc-result-question {
        padding: 12px 6px 10px 6px;
    }
    }
</style>

@endsection 