@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')
<div class="quiz-oc-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="quiz-oc-card">
                    <div class="quiz-oc-header text-center mb-4">
                        <h2 class="quiz-oc-title">Tous mes quiz</h2>
                        <div class="quiz-oc-meta">
                            <span class="quiz-oc-meta-item"><i class="la la-book"></i> {{ collect($courses)->sum(fn($c) => $c->quizzes->count()) }} quiz</span>
                        </div>
                    </div>
                    @if(count($courses))
                        @foreach($courses as $course)
                            @if($course->quizzes->count())
                                <div class="quiz-oc-course-title mb-2 mt-4"><i class="la la-book-open"></i> {{ $course->title ?? $course->course_name }}</div>
                                <div class="quiz-oc-list mb-3">
                                    @foreach($course->quizzes as $quiz)
                                    <div class="quiz-oc-list-card mb-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between p-3">
                                        <div class="d-flex align-items-center mb-2 mb-md-0">
                                            <div class="quiz-oc-list-icon mr-3">
                                                <i class="la la-graduation-cap"></i>
                                            </div>
                                            <div>
                                                <div class="quiz-oc-list-title">{{ $quiz->title }}</div>
                                                <div class="quiz-oc-list-meta text-muted small">
                                                    {{ $quiz->questions->count() }} questions &bull; {{ $quiz->duration ?? $quiz->time_limit }} min &bull; Score min : {{ $quiz->passing_score }}%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            @php
                                                $attempt = $quiz->userAttempts->sortByDesc('created_at')->first();
                                            @endphp
                                            @if($attempt)
                                                @if($attempt->passed)
                                                    <span class="quiz-oc-badge bg-success mr-2">Réussi</span>
                                                    <a href="{{ route('student.quiz.result', [$quiz->course_id, $quiz->id]) }}" class="quiz-oc-btn quiz-oc-btn-secondary">Voir résultat</a>
                                                @else
                                                    <span class="quiz-oc-badge bg-danger mr-2">Échoué</span>
                                                    <a href="{{ route('student.quiz.take', [$quiz->course_id, $quiz->id]) }}" class="quiz-oc-btn">Recommencer</a>
                                                @endif
                                            @else
                                                <span class="quiz-oc-badge bg-warning mr-2">À faire</span>
                                                <a href="{{ route('student.quiz.take', [$quiz->course_id, $quiz->id]) }}" class="quiz-oc-btn">Commencer</a>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                        @if(collect($courses)->sum(fn($c) => $c->quizzes->count()) == 0)
                            <div class="text-center text-muted py-5">Aucun quiz disponible pour vos cours.</div>
                        @endif
                    @else
                        <div class="text-center text-muted py-5">Aucun cours trouvé.</div>
                    @endif
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
.quiz-oc-course-title {
    font-size: 1.15rem;
    font-weight: 600;
    color: #3578e5;
    margin-bottom: 6px;
    margin-top: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.quiz-oc-list {
    margin-top: 0;
}
.quiz-oc-list-card {
    background: #fffbe6;
    border-radius: 14px;
    box-shadow: 0 2px 12px #ff98001a;
    border-left: 6px solid #43e97b;
    transition: box-shadow 0.2s, border-color 0.2s;
    align-items: center;
}
.quiz-oc-list-card:hover {
    box-shadow: 0 4px 16px #3578e533;
    border-left: 6px solid #3578e5;
}
.quiz-oc-list-icon {
    font-size: 2.2rem;
    color: #3578e5;
    margin-right: 18px;
}
.quiz-oc-list-title {
    font-size: 1.18rem;
    font-weight: 600;
    color: #222;
}
.quiz-oc-list-meta {
    font-size: 1rem;
    color: #b47b5c;
}
.quiz-oc-badge {
    background: #43e97b;
    color: #fff;
    border-radius: 8px;
    padding: 4px 14px;
    font-size: 1em;
    font-weight: 600;
    margin-right: 8px;
}
.quiz-oc-badge.bg-danger {
    background: #ff9800 !important;
}
.quiz-oc-badge.bg-success {
    background: #43e97b !important;
}
.quiz-oc-badge.bg-warning {
    background: #ffc107 !important;
    color: #fff !important;
}
.quiz-oc-btn {
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 22px;
    font-size: 1.08rem;
    font-weight: 600;
    box-shadow: 0 2px 8px #3578e522;
    transition: background 0.2s;
    text-decoration: none;
    display: inline-block;
    margin-left: 8px;
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
    .quiz-oc-list-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 16px 8px;
    }
    .quiz-oc-list-icon {
        margin-bottom: 8px;
    }
}
</style>
@endsection 