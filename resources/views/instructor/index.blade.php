@extends('instructor.instructor_dashboard')
@section('instructor')

@php
    $id = Auth::user()->id;
    $coursess = App\Models\Course::where('instructor_id',$id)->orderBy('id','desc')->get();
    $instructorid = App\Models\User::find($id);
    $status = $instructorid->status;

    $totalOrders = App\Models\Order::get();
    $setting = App\Models\SiteSetting::find(1);
    $totalAmount = App\Models\Payment::sum('total_amount');//need to change for count amount
    $totalStudents  = App\Models\User::where('role','user')->latest()->get();
    $totalInstructor  = App\Models\User::where('role','instructor')->latest()->get();
    $courses = App\Models\Course::withCount('orders')->get();


    $courseNames = $courses->pluck('course_title')->toArray();
    $courseCounts = $courses->pluck('orders_count')->toArray();
@endphp

    <div class="page-content">
        @if ($status == 1)
            <h4>Le compte instructeur est <span class="text-success">Actif</span></h4>
        @else
        <h4>Le compte instructeur est <span class="text-danger">Inactif</span>  </h4>
        <p>Veuillez attendre l'approbation de l'administrateur</p>
            
        @endif


        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="border-0 border-4 card radius-10 border-start border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Commandes</p>
                                <h4 class="my-1 text-info">{{count($totalOrders)}}</h4>
                                {{-- <p class="mb-0 font-13">+2.5% from last week</p> --}}
                            </div>
                            <div class="text-white widgets-icons-2 rounded-circle bg-gradient-blues ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="border-0 border-4 card radius-10 border-start border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Montant total</p>
                                <h4 class="my-1 text-danger">{{$setting->currency}}{{$totalAmount}}</h4>
                            </div>
                            <div class="text-white widgets-icons-2 rounded-circle bg-gradient-burning ms-auto">
                                <i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="border-0 border-4 card radius-10 border-start border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total étudiants</p>
                            <h4 class="my-1 text-success">{{count($totalStudents)}}</h4>
                            </div>
                            <div class="text-white widgets-icons-2 rounded-circle bg-gradient-ohhappiness ms-auto">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="border-0 border-4 card radius-10 border-start border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Instructeurs</p>
                                <h4 class="my-1 text-warning">{{count($totalInstructor)}}</h4>
                            </div>
                            <div class="text-white widgets-icons-2 rounded-circle bg-gradient-orange ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Commandes récentes</h6>
                            </div>
                            <div class="dropdown ms-auto">
                                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                        class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Autre action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Autre chose ici</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom du cours</th>
                                        <th>Prix</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coursess as $key=> $item)
                                    <tr class="h-full">
                                        <td>{{ $key+1 }}</td>
                                        
                                        <td>{{ $item->course_name }}</td>
                                       
                                        <td>{{ $item->selling_price }}</td>
                                        
            
            
                                        <td>
                                            <div class="gap-2 btn-group">
                                                <a href="{{ route('edit.course', $item->id) }}" class="px-2 btn btn-success" title="Modifier">Modifier</a>
                                                <a href="{{ route('delete.course', $item->id) }}" class="px-2 btn btn-danger" id="delete" title="Supprimer">Supprimer</a>
                                                <a href="{{ route('add.course.lecture', $item->id) }}" class="px-2 text-white btn btn-warning" title="Leçon">Leçon</a>
            
                                            </div>
                                        </td>
             
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Cours tendance</h6>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container-2">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($courses as $course)
                                <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                                    {{ $course->course_title }} <span class="badge bg-success rounded-pill">{{ $course->orders_count }}</span>
                                </li>
                            @endforeach

                    </ul>
                </div>
            </div>
        </div><!--end row-->

       





    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        // Repeat for other charts if needed
    });
</script>

