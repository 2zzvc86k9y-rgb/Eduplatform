@extends('instructor.instructor_dashboard')
@section('instructor')


<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        {{-- <div class="breadcrumb-title pe-3">All Category</div> --}}
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Toutes les questions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.course') }}" class="px-5 btn btn-primary">Ajouter un cours</a>

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Tableau des questions</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom du cours</th>
                            <th>Sujet</th>
                            <th>Utilisateur</th>
                            <th>Date</th>
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($question as $key=> $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item['course']['course_name'] }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>{{ $item['user']['name'] }}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>


                            <td>
                                <div class="gap-2 btn-group">
                                    <a href="{{ route('instructor.question.details', $item->id) }}" class="px-2 btn btn-success" title="Voir"><i class="lni lni-eye"></i></a>
                                    

                                </div>
                            </td>
 
                        </tr>
                        @endforeach

                </table>
            </div>
        </div>
    </div>

</div>

@endsection
