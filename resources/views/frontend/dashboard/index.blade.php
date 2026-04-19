@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')

@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
    $enrolledCourses = App\Models\Order::where('user_id', $id)->count();
    $suggestedCourses = App\Models\Course::where('status', 'active')->take(6)->get();
    // Récupération des cours et calcul de la progression globale
    $latestOrder = App\Models\Order::where('user_id', $id)
        ->select('course_id', \DB::raw('MAX(id) as max_id'))
        ->groupBy('course_id');
    $myCourses = App\Models\Order::joinSub($latestOrder, 'latest_order', function($join){
        $join->on('orders.id', '=', 'latest_order.max_id');
    })
    ->join('payments', 'orders.payment_id', '=', 'payments.id')
    ->where('payments.status', 'confirm')
    ->orderBy('latest_order.max_id', 'DESC')
    ->get();
    $totalProgress = 0;
    $completedCourses = 0;
    foreach ($myCourses as $item) {
        // Progression basée sur les leçons
        $totalLectures = App\Models\CourseLecture::where('course_id', $item->course_id)->count();
        $completedLectures = App\Models\UserCourseProgress::where('user_id', $id)
            ->where('course_id', $item->course_id)
            ->where('completed', true)
            ->count();
        $progress = $totalLectures > 0 ? round(($completedLectures / $totalLectures) * 100) : 0;
        $totalProgress += $progress;
        if ($progress == 100) $completedCourses++;
    }
    $globalProgress = count($myCourses) > 0 ? round($totalProgress / count($myCourses)) : 0;
    // Checklist façon OpenClassrooms
    $checklist = [
        [
            'label' => 'Compléter mon profil',
            'done' => !empty($profileData->phone) && !empty($profileData->address),
            'icon' => '<svg width="20" height="20" fill="#2196f3" viewBox="0 0 24 24"><path d="M12 12c2.7 0 8 1.34 8 4v2H4v-2c0-2.66 5.3-4 8-4zm0-2a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/></svg>'
        ],
        [
            'label' => "S'inscrire à un cours",
            'done' => $enrolledCourses > 0,
            'icon' => '<svg width="20" height="20" fill="#ff9800" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14H7v-2h5v2zm5-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>'
        ],
        [
            'label' => 'Terminer un cours',
            'done' => $completedCourses > 0,
            'icon' => '<svg width="20" height="20" fill="#4caf50" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>'
        ],
    ];
@endphp

<div class="flex-wrap mb-5 breadcrumb-content d-flex align-items-center justify-content-between">
    <div class="media media-card align-items-center">
        <div class="rounded-full media-img media--img media-img-md">
            <img class="rounded-full" src="{{ !empty($profileData->photo) ? url('upload/user_image/' . $profileData->photo) : url('upload/noimage.jpg') }}" alt="Image miniature de l'étudiant">
        </div>
        <div class="media-body">
            <h2 class="section__title fs-30">Bonjour, {{ $profileData->name }}</h2>
            <div class="pt-2 rating-wrap d-flex align-items-center">
                <div class="review-stars">
                    <span class="rating-number">4.4</span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star-o"></span>
                </div>
                <span class="pl-1 rating-total">(20,230)</span>
            </div><!-- end rating-wrap -->
        </div><!-- end media-body -->
    </div><!-- end media -->

</div><!-- end breadcrumb-content -->
<div class="mb-5 section-block"></div>
<div class="mb-5 dashboard-heading">
    <h3 class="fs-22 font-weight-semi-bold">Tableau de bord</h3>
</div>
<div class="dashboard-oc">
    <div class="dashboard-row">
        <!-- Carte Cours inscrits modernisée -->
        <div class="dashboard-card dashboard-courses modern-courses-card">
            <div class="modern-courses-icon">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="24" fill="url(#grad1)"/>
                    <path d="M32 18H16a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2zm0 10H16v-8h16v8zm-8-7a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0 4a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" fill="#fff"/>
                    <defs>
                        <linearGradient id="grad1" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#ff8a65"/>
                            <stop offset="1" stop-color="#f76c6c"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <div>
                <div class="modern-courses-label">Cours inscrits</div>
                <div class="modern-courses-value">{{ $enrolledCourses }}</div>
                <div class="modern-courses-sub">Nombre total de cours auxquels vous êtes inscrit</div>
            </div>
        </div>
        <!-- Carte Progression globale modernisée -->
        <div class="dashboard-card dashboard-progress modern-progress-card">
            <div class="modern-progress-icon">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="24" fill="url(#grad2)"/>
                    <path d="M24 12a12 12 0 1 1 0 24 12 12 0 0 1 0-24zm0 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 3a1 1 0 0 1 1 1v6.59l5.3 5.3a1 1 0 1 1-1.42 1.42l-5.58-5.59A1 1 0 0 1 23 23V16a1 1 0 0 1 1-1z" fill="#fff"/>
                    <defs>
                        <linearGradient id="grad2" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#ffb347"/>
                            <stop offset="1" stop-color="#ff9800"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <div>
                <div class="modern-progress-label">Progression globale</div>
                <div class="modern-progress-value">{{ $globalProgress }}%</div>
                <div class="modern-progress-sub">Votre avancement moyen sur tous vos cours suivis.</div>
            </div>
        </div>
        <!-- Carte Checklist modernisée -->
        <div class="dashboard-card dashboard-checklist modern-checklist-card">
            <div class="modern-checklist-icon">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="24" r="24" fill="url(#grad3)"/>
                    <path d="M34 18l-10 10-4-4a1 1 0 1 0-1.41 1.41l4.7 4.7a1 1 0 0 0 1.41 0l10.7-10.7A1 1 0 1 0 34 18z" fill="#fff"/>
                    <defs>
                        <linearGradient id="grad3" x1="0" y1="0" x2="48" y2="48" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#43e97b"/>
                            <stop offset="1" stop-color="#38f9d7"/>
                        </linearGradient>
                    </defs>
                    </svg>
                </div>
            <div>
                <div class="modern-checklist-label">Checklist</div>
                <ul class="modern-checklist-list">
                    @foreach($checklist as $item)
                        <li>{!! $item['icon'] !!} {{ $item['label'] }}
                            @if($item['done'])
                                <span class="badge badge-success">Fait</span>
                            @else
                                <span class="badge badge-warning">À faire</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="dashboard-oc-actions mt-4 text-center">
        <a href="{{ route('student.quiz.index') }}" class="dashboard-oc-btn">
            <i class="la la-list mr-2"></i> Tous mes quiz
        </a>
    </div>
                </div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('globalProgressChart').getContext('2d');
        var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 120);
        gradientStroke1.addColorStop(0, '#ff9800');
        gradientStroke1.addColorStop(1, '#ffe0b2');
        var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 120);
        gradientStroke2.addColorStop(0, '#e9ecef');
        gradientStroke2.addColorStop(1, '#f8f9fa');
        var percent = {{ $globalProgress }};
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Progression', 'Restant'],
                datasets: [{
                    backgroundColor: [
                        gradientStroke1,
                        gradientStroke2
                    ],
                    hoverBackgroundColor: [
                        gradientStroke1,
                        gradientStroke2
                    ],
                    data: [percent, 100 - percent],
                    borderWidth: [1, 1]
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: 60,
                plugins: {
                    legend: { display: false }
                }
            }
        });
        document.getElementById('globalProgressPercent').innerText = percent + '%';
    });
</script>
@endsection

<style>
body, .dashboard-oc {
    background: #fdf1e3 !important;
}
.dashboard-oc {
    display: flex;
    flex-direction: column;
    gap: 32px;
    margin: 32px 0;
}
.dashboard-row {
    display: flex;
    flex-wrap: wrap;
    gap: 32px;
    justify-content: flex-start;
}
.dashboard-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px #3578e51a;
    padding: 32px 28px;
    min-width: 260px;
    flex: 1 1 260px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    transition: box-shadow 0.2s;
}
.dashboard-card-icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.2rem;
    margin-bottom: 18px;
    color: #fff;
}
.bg-red { background: #f76c6c; }
.text-orange { color: #ff9800; font-weight: bold; font-size: 2.1rem; }
.dashboard-card-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: #222;
    margin-bottom: 8px;
}
.dashboard-card-value {
    font-size: 2.2rem;
    font-weight: 700;
    color: #3578e5;
    margin-bottom: 8px;
}
.dashboard-card-desc {
    font-size: 1rem;
    color: #666;
    margin-top: 8px;
}
.dashboard-checklist-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.dashboard-checklist-list li {
    display: flex;
    align-items: center;
    font-size: 1.08rem;
    margin-bottom: 10px;
    gap: 8px;
}
.badge-success {
    background: #43e97b;
    color: #fff;
    border-radius: 8px;
    padding: 2px 10px;
    font-size: 0.95em;
    margin-left: 8px;
}
.badge-warning {
    background: #ff9800;
    color: #fff;
    border-radius: 8px;
    padding: 2px 10px;
    font-size: 0.95em;
    margin-left: 8px;
}
@media (max-width: 900px) {
    .dashboard-row { flex-direction: column; gap: 24px; }
    .dashboard-card { min-width: 0; width: 100%; }
}
.modern-courses-card {
    background: linear-gradient(120deg, #ffe0b2 0%, #fdf1e3 100%);
    box-shadow: 0 6px 32px #f76c6c22;
    flex-direction: row;
    align-items: center;
    gap: 18px;
    transition: box-shadow 0.2s, transform 0.2s;
    border: none;
}
.modern-courses-card:hover {
    box-shadow: 0 12px 36px #f76c6c33;
    transform: translateY(-2px) scale(1.02);
}
.modern-courses-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
}
.modern-courses-label {
    font-size: 1.05rem;
    font-weight: 500;
    color: #f76c6c;
    margin-bottom: 2px;
    letter-spacing: 0.5px;
}
.modern-courses-value {
    font-size: 2.7rem;
    font-weight: 800;
    color: #d84315;
    margin-bottom: 2px;
    line-height: 1.1;
}
.modern-courses-sub {
    font-size: 0.98rem;
    color: #b47b5c;
    margin-top: 2px;
    font-style: italic;
}
.modern-progress-card {
    background: linear-gradient(120deg, #ffe9c7 0%, #fffbe6 100%);
    box-shadow: 0 6px 32px #ff980022;
    flex-direction: row;
    align-items: center;
    gap: 18px;
    transition: box-shadow 0.2s, transform 0.2s;
    border: none;
}
.modern-progress-card:hover {
    box-shadow: 0 12px 36px #ff980033;
    transform: translateY(-2px) scale(1.02);
}
.modern-progress-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
}
.modern-progress-label {
    font-size: 1.05rem;
    font-weight: 500;
    color: #ff9800;
    margin-bottom: 2px;
    letter-spacing: 0.5px;
}
.modern-progress-value {
    font-size: 2.7rem;
    font-weight: 800;
    color: #ff9800;
    margin-bottom: 2px;
    line-height: 1.1;
}
.modern-progress-sub {
    font-size: 0.98rem;
    color: #b47b5c;
    margin-top: 2px;
    font-style: italic;
}
.modern-checklist-card {
    background: linear-gradient(120deg, #e0ffe9 0%, #f1fff7 100%);
    box-shadow: 0 6px 32px #43e97b22;
    flex-direction: row;
    align-items: center;
    gap: 18px;
    transition: box-shadow 0.2s, transform 0.2s;
    border: none;
}
.modern-checklist-card:hover {
    box-shadow: 0 12px 36px #43e97b33;
    transform: translateY(-2px) scale(1.02);
}
.modern-checklist-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
}
.modern-checklist-label {
    font-size: 1.05rem;
    font-weight: 500;
    color: #43e97b;
    margin-bottom: 2px;
    letter-spacing: 0.5px;
}
.modern-checklist-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.modern-checklist-list li {
    display: flex;
    align-items: center;
    font-size: 1.08rem;
    margin-bottom: 10px;
    gap: 8px;
}
.dashboard-oc-btn {
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
    margin-top: 18px;
}
.dashboard-oc-btn:hover {
    background: linear-gradient(90deg, #38f9d7 0%, #3578e5 100%);
    color: #fff;
    box-shadow: 0 4px 16px #3578e533;
}
</style>