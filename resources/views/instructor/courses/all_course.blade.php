@extends('instructor.instructor_dashboard')

@section('instructor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="Fil d'Ariane">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('instructor.dashboard') }}" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tous les cours</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.course') }}" class="px-5 btn btn-primary" aria-label="Ajouter un nouveau cours">Ajouter un cours</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Tableau des cours</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Tableau de tous les cours">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Image</th>
                            <th>Nom du cours</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Réduction</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->course_image) }}"
                                         alt="Image du cours {{ $item->course_name }}"
                                         class="img-fluid" width="50" height="50">
                                </td>
                                <td>{{ $item->course_name }}</td>
                                <td>{{ $item['category']['category_name'] }}</td>
                                <td>{{ $item->selling_price }}</td>
                                <td>{{ $item->discount_price ?? 'Aucune' }}</td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('edit.course', $item->id) }}"
                                           class="px-2 btn btn-success"
                                           title="Modifier"
                                           aria-label="Modifier le cours">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="{{ route('delete.course', $item->id) }}"
                                           class="px-2 btn btn-danger"
                                           id="delete"
                                           title="Supprimer"
                                           aria-label="Supprimer le cours">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                        <a href="{{ route('add.course.lecture', $item->id) }}"
                                           class="px-2 text-white btn btn-warning"
                                           title="Ajouter une leçon"
                                           aria-label="Ajouter une leçon au cours">
                                            <i class="bx bx-list-plus"></i>
                                        </a>
                                        <a href="{{ route('course.quizzes', $item->id) }}"
                                           class="px-2 text-white btn btn-info"
                                           title="Gérer les quiz"
                                           aria-label="Gérer les quiz du cours">
                                            <i class="bx bx-question-mark"></i>
                                        </a>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
            }
        });
    });
</script>

@endsection