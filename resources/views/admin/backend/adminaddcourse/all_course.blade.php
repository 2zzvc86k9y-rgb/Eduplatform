@extends('instructor.instructor_dashboard')

@section('instructor')
<div class="page-content">
    <!-- Fil d'Ariane -->
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

    <h6 class="mb-0 text-uppercase">Tableau des cours</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Image</th>
                            <th>Nom du cours</th>
                            <th>Catégorie</th>
                            <th>Prix ($)</th>
                            <th>Remise ($)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->course_image) }}" alt="Image du cours {{ $item->course_name }}"
                                        class="img-fluid" width="50" height="50">
                                </td>
                                <td>{{ $item->course_name }}</td>
                                <td>{{ $item['category']['category_name'] }}</td>
                                <td>{{ $item->selling_price }} $</td>
                                <td>{{ $item->discount_price ? $item->discount_price . ' $' : 'Aucune remise' }}</td>
                                <td>
                                    <div class="gap-2 btn-group">
                                        <a href="{{ route('edit.course', $item->id) }}" class="px-2 btn btn-success" title="Modifier" aria-label="Modifier le cours">
                                            <i class="lni lni-eraser"></i>
                                        </a>
                                        <a href="{{ route('delete.course', $item->id) }}" class="px-2 btn btn-danger" id="delete" title="Supprimer" aria-label="Supprimer le cours">
                                            <i class="lni lni-trash"></i>
                                        </a>
                                        <a href="{{ route('add.course.lecture', $item->id) }}" class="px-2 text-white btn btn-warning" title="Leçons" aria-label="Gérer les leçons du cours">
                                            <i class="lni lni-list"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucun cours disponible pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection