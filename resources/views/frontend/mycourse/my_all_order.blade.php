@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

<style>
body {
    background: linear-gradient(135deg, #fdf1e3 0%, #f7e9d7 100%) !important;
}
.dashboard-cards {
    display: flex;
    flex-direction: column;
    gap: 28px;
}
.modern-course-card {
    display: flex;
    align-items: center;
    background: linear-gradient(120deg, #fffbe6 0%, #fdf1e3 100%);
    border-radius: 18px;
    box-shadow: 0 4px 24px #3578e51a;
    padding: 24px 32px;
    gap: 32px;
    transition: box-shadow 0.2s, transform 0.2s;
    position: relative;
}
.modern-course-card:hover {
    box-shadow: 0 12px 36px #ff980033;
    transform: translateY(-2px) scale(1.02);
}
.modern-course-img-wrap {
    flex-shrink: 0;
    width: 96px;
    height: 96px;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 2px 12px #ff980022;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}
.modern-course-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
.modern-course-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.modern-course-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #3578e5;
    margin-bottom: 2px;
}
.modern-course-sub {
    font-size: 1.05rem;
    color: #b47b5c;
    margin-bottom: 6px;
}
.modern-progress-bar-wrap {
    background: #f4f6fa;
    border-radius: 12px;
    height: 18px;
    width: 100%;
    margin-bottom: 6px;
    overflow: hidden;
    box-shadow: 0 1px 4px #ff98001a;
}
.modern-progress-bar {
    background: linear-gradient(90deg, #ff9800 0%, #ffe0b2 100%);
    height: 100%;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    font-weight: bold;
    color: #fff;
    font-size: 1rem;
    padding-right: 12px;
    transition: width 0.4s;
}
.modern-badge-success {
    background: #43e97b;
    color: #fff;
    border-radius: 8px;
    padding: 4px 14px;
    font-size: 1em;
    font-weight: 600;
    margin-top: 6px;
    display: inline-block;
}
.modern-course-btn {
    margin-top: 10px;
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 8px 32px;
    font-size: 1.08rem;
    font-weight: 600;
    box-shadow: 0 2px 8px #3578e522;
    transition: background 0.2s, box-shadow 0.2s;
    text-decoration: none;
    display: inline-block;
    width: auto;
    min-width: 120px;
    max-width: 220px;
    text-align: center;
    align-self: center;
}
.modern-course-btn:hover {
    background: linear-gradient(90deg, #38f9d7 0%, #3578e5 100%);
    color: #fff;
    box-shadow: 0 4px 16px #3578e533;
}
@media (max-width: 700px) {
    .modern-course-card {
        flex-direction: column;
        align-items: flex-start;
        padding: 18px 10px;
        gap: 18px;
    }
    .modern-course-img-wrap {
        width: 72px;
        height: 72px;
    }
}
</style>

<div class="container-fluid ">
    <div class="dashboard-heading mb-5 d-flex justify-content-between align-items-center">
        <h3 class="fs-22 font-weight-semi-bold">Mes Cours</h3>
        <a href="{{ route('all.course.user') }}" class="btn theme-btn theme-btn-sm">
            <i class="la la-list mr-1"></i> Voir tous les cours disponibles
        </a>
    </div>

    <div class="dashboard-cards mb-5">
        @foreach ($myCourse as $item)
        <div class="modern-course-card mb-4">
            <div class="modern-course-img-wrap">
                <a href="{{ route('course.view', $item->course_id) }}">
                    <img class="modern-course-img" src="{{ asset($item->course->course_image) }}" alt="Image du cours">
                </a>
            </div>
            <div class="modern-course-content">
                <h5 class="modern-course-title">{{ $item->course->course_title ?? $item->course->course_name }}</h5>
                <div class="modern-course-sub">{{ $item->course->course_name }}</div>
                <!-- Barre de progression moderne -->
                <div class="modern-progress-bar-wrap">
                    <div class="modern-progress-bar" style="width: {{ $item->progress }}%;">
                        <span>{{ $item->progress }}%</span>
                    </div>
                </div>
                @if($item->progress == 100)
                    <span class="modern-badge-success">Terminé !</span>
                @endif
                <a href="{{ route('course.view', $item->course_id) }}" class="modern-course-btn">Reprendre</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
