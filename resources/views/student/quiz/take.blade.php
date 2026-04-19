@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')

<div class="quiz-oc-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="quiz-oc-card">
                    <div class="quiz-oc-header text-center mb-4">
                        <h2 class="quiz-oc-title">Quiz : {{ $quiz->title }}</h2>
                        <div class="quiz-oc-meta">
                            <span class="quiz-oc-meta-item"><i class="la la-clock-o"></i> {{ $quiz->time_limit ?? $quiz->duration }} min</span>
                            <span class="quiz-oc-meta-item"><i class="la la-trophy"></i> Score min : {{ $quiz->passing_score }}%</span>
                            <span class="quiz-oc-meta-item"><i class="la la-star"></i> {{ $quiz->total_points ?? ($quiz->questions->sum('points') ?? '-') }} pts</span>
                        </div>
                        @if(isset($timeRemaining))
                        <div class="quiz-oc-timer" id="quiz-timer">
                            <i class="la la-hourglass-half"></i> <span id="timer"></span>
                </div>
                @endif
            </div>

                    <!-- Barre de progression -->
                    <div class="quiz-oc-progress-bar mb-4">
                        <div class="quiz-oc-progress" style="width: 100%" id="quizProgressBar"></div>
    </div>

                    <form id="quiz-form" action="{{ route('submit.quiz', [$quiz->course_id, $quiz->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">
                        @foreach($quiz->questions as $index => $question)
                        <div class="quiz-oc-question mb-5">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="quiz-oc-step">Question {{ $index + 1 }} / {{ $quiz->questions->count() }}</span>
                                <span class="quiz-oc-badge">
                                    {{ $question->question_type == 'multiple_choice' ? 'Choix multiple' : ($question->question_type == 'true_false' ? 'Vrai/Faux' : 'Réponse courte') }}
                                </span>
                            </div>
                            <h4 class="quiz-oc-question-title">{{ $question->question_text }}</h4>
                            @if($question->question_type == 'multiple_choice')
                                <div class="quiz-oc-options">
                            @foreach($question->options as $option)
                                    <label class="quiz-oc-option">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" required
                                           {{ isset($attempt->answers[$question->id]) && $attempt->answers[$question->id] == $option->id ? 'checked' : '' }}>
                                        <span>{{ $option->option_text }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            @elseif($question->question_type == 'true_false')
                                <div class="quiz-oc-options">
                                    <label class="quiz-oc-option">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="true" required
                                            {{ isset($attempt->answers[$question->id]) && $attempt->answers[$question->id] == 'true' ? 'checked' : '' }}>
                                        <span>Vrai</span>
                                    </label>
                                    <label class="quiz-oc-option">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="false" required
                                            {{ isset($attempt->answers[$question->id]) && $attempt->answers[$question->id] == 'false' ? 'checked' : '' }}>
                                        <span>Faux</span>
                                    </label>
                                </div>
                            @else
                                <input type="text" class="quiz-oc-input" name="answers[{{ $question->id }}]" value="{{ $attempt->answers[$question->id] ?? '' }}" required>
                            @endif
                        </div>
                        @endforeach

                        <div class="quiz-oc-actions mt-4">
                            <button type="submit" class="quiz-oc-btn">Soumettre le quiz</button>
                            <a href="{{ route('course.view', $quiz->course_id) }}" class="quiz-oc-btn quiz-oc-btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@if(isset($timeRemaining))
<script>
    $(document).ready(function() {
        let duration = {{ $timeRemaining }};
        const timerDisplay = $('#timer');
        const quizForm = $('#quiz-form');
        const progressBar = document.getElementById('quizProgressBar');
        if(progressBar) progressBar.style.width = '100%';

        function updateTimer() {
            const minutes = Math.floor(duration / 60);
            const seconds = duration % 60;
            timerDisplay.text(
                minutes.toString().padStart(2, '0') + ':' + 
                seconds.toString().padStart(2, '0')
            );
            if (duration <= 0) {
                clearInterval(timerInterval);
                alert('Le temps est écoulé ! Le quiz va être soumis automatiquement.');
                quizForm.submit();
            }
            duration--;
        }
        updateTimer();
        const timerInterval = setInterval(updateTimer, 1000);
        window.onbeforeunload = function() {
            return "Êtes-vous sûr de vouloir quitter ? Votre progression sera perdue.";
        };
        quizForm.on('submit', function() {
            window.onbeforeunload = null;
        });
    });
</script>
@endif
@endpush

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
.quiz-oc-timer {
    background: #fdf1e3;
    color: #ff9800;
    font-weight: 600;
    border-radius: 8px;
    display: inline-block;
    padding: 6px 18px;
    font-size: 1.1rem;
    margin-bottom: 8px;
}
.quiz-oc-progress-bar {
    background: #f4f6fa;
    border-radius: 8px;
    height: 10px;
    width: 100%;
    overflow: hidden;
}
.quiz-oc-progress {
    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
    height: 100%;
    transition: width 0.3s;
}
.quiz-oc-question {
    background: #fffbe6;
    border-radius: 14px;
    box-shadow: 0 2px 12px #ff98001a;
    padding: 24px 22px 18px 22px;
    margin-bottom: 18px;
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
}
.quiz-oc-option input[type=radio] {
    margin-right: 12px;
    accent-color: #43e97b;
}
.quiz-oc-option:hover, .quiz-oc-option input[type=radio]:checked + span {
    background: #ffe0b2;
    border-color: #ff9800;
}
.quiz-oc-input {
    width: 100%;
    border-radius: 8px;
    border: 1px solid #e3e8ee;
    padding: 10px 14px;
    font-size: 1.08rem;
    margin-bottom: 8px;
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
    .quiz-oc-question {
        padding: 12px 6px 10px 6px;
    }
}
</style>

@endsection 