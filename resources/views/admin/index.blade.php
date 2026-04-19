@php
    $allinstructor = App\Models\User::where('role', 'instructor')->latest()->get();
    $totalOrders = App\Models\Order::count();
    $setting = App\Models\SiteSetting::find(1);
    $totalAmount = App\Models\Payment::sum('total_amount') ?? 0; // Gestion du cas où aucune donnée n'est disponible
    $totalStudents = App\Models\User::where('role', 'user')->latest()->get();
    $totalInstructor = App\Models\User::where('role', 'instructor')->latest()->get();
    $courses = App\Models\Course::withCount('orders')->get();

    $courseNames = $courses->pluck('course_title')->toArray();
    $courseCounts = $courses->pluck('orders_count')->toArray();
@endphp

@extends('./admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="border-0 border-4 card radius-10 border-start border-info shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Commandes</p>
                                <h4 class="my-1 text-info">{{ $totalOrders }}</h4>
                            </div>
                            <div class="text-white widgets-icons-2 rounded-circle bg-gradient-blues ms-auto">
                                <i class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="border-0 border-4 card radius-10 border-start border-danger shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Montant total</p>
                                <h4 class="my-1 text-danger">{{ $setting->currency ?? '€' }}{{ number_format($totalAmount, 2) }}</h4>
                            </div>
                            <div class="text-white widgets-icons-2 rounded-circle bg-gradient-burning ms-auto">
                                <i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="border-0 border-4 card radius-10 border-start border-success shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Étudiants</p>
                                <h4 class="my-1 text-success">{{ count($totalStudents) }}</h4>
                            </div>
                            <div class="text-white widgets-icons-2 rounded-circle bg-gradient-ohhappiness ms-auto">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="border-0 border-4 card radius-10 border-start border-warning shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Instructeurs</p>
                                <h4 class="my-1 text-warning">{{ count($totalInstructor) }}</h4>
                            </div>
                            <div class="text-white widgets-icons-2 rounded-circle bg-gradient-orange ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100 shadow-sm">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Instructeurs récents</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" aria-label="Options pour les instructeurs">
                                    <i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Ajouter un instructeur</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Exporter la liste</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="javascript:;">Paramètres</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle" aria-label="Liste des instructeurs">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Nom de l'instructeur</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allinstructor as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name ?? 'N/A' }}</td>
                                            <td>{{ $item->email ?? 'N/A' }}</td>
                                            <td>{{ $item->phone ?? 'N/A' }}</td>
                                            <td>
                                                <form id="statusForm{{ $item->id }}" action="{{ route('update.userstatus') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="is_checked" value="{{ $item->status }}">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input status-toggle" type="checkbox" {{ $item->status == 1 ? 'checked' : '' }} onchange="updateStatus({{ $item->id }}, this)" id="statusToggle{{ $item->id }}" aria-label="Activer ou désactiver le statut de l'instructeur {{ $item->name }}">
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Aucun instructeur trouvé.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100 shadow-sm">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Cours populaires</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2">
                            @if($courses->isNotEmpty())
                                <canvas id="chart2"></canvas>
                            @else
                                <p class="text-center">Aucun cours disponible pour afficher le graphique.</p>
                            @endif
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse($courses as $course)
                            <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                                {{ $course->course_title }} <span class="badge bg-success rounded-pill">{{ $course->orders_count }}</span>
                            </li>
                        @empty
                            <li class="bg-transparent list-group-item text-center">Aucun cours disponible.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if($courses->isNotEmpty())
            var ctx2 = document.getElementById('chart2').getContext('2d');

            var gradientStroke1 = ctx2.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#fc4a1a');
            gradientStroke1.addColorStop(1, '#f7b733');

            var gradientStroke2 = ctx2.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#4776e6');
            gradientStroke2.addColorStop(1, '#8e54e9');

            var gradientStroke3 = ctx2.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#ee0979');
            gradientStroke3.addColorStop(1, '#ff6a00');

            var gradientStroke4 = ctx2.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#42e695');
            gradientStroke4.addColorStop(1, '#3bb2b8');

            var courseNames = @json($courseNames);
            var courseCounts = @json($courseCounts);

            var myChart2 = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: courseNames,
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4
                        ],
                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4
                        ],
                        data: courseCounts,
                        borderWidth: [1, 1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: 82,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        @endif
    });

    function updateStatus(userId, element) {
        const form = document.getElementById(`statusForm${userId}`);
        const input = form.querySelector('input[name="is_checked"]');
        input.value = element.checked ? 1 : 0;
        form.submit();
    }
</script>