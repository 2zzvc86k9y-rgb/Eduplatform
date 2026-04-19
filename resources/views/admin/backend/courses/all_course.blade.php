@extends('./admin.admin_dashboard')

@section('admin')
<div class="page-content">
    <!-- Fil d'Ariane -->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="Fil d'Ariane">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tous les cours</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Tableau des cours</h6>
    <hr/>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%" aria-label="Liste des cours">
                    <thead>
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nom du cours</th>
                            <th scope="col">Instructeur</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Détails</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $key => $course)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ !empty($course->course_image) ? asset($course->course_image) : url('upload/noimage.jpg') }}"
                                        alt="Image du cours {{ $course->course_name ?? 'inconnu' }}" class="img-fluid rounded" width="40">
                                </td>
                                <td>{{ $course->course_name ?? 'N/A' }}</td>
                                <td>{{ $course['user']['name'] ?? 'N/A' }}</td>
                                <td>{{ $course['category']['category_name'] ?? 'N/A' }}</td>
                                <td>
                                    @if ($course->discount_price == null)
                                        {{ $course->selling_price ?? 'N/A' }}
                                    @else
                                        {{ $course->discount_price ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    @if($course->status == 1)
                                        <span class="badge bg-success">Actif</span>
                                    @elseif($course->status == 0)
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.course.details', $course->id) }}" class="btn btn-success" aria-label="Voir les détails du cours {{ $course->course_name ?? 'inconnu' }}">
                                        <i class="lni lni-eye"></i>
                                    </a>
                                </td>
                                <td>
                                    <form id="statusForm{{ $course->id }}" action="{{ route('update.coursestatus') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                                        <input type="hidden" name="is_checked" value="{{ $course->status }}">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input status-toggle" type="checkbox" id="statusToggle{{ $course->id }}"
                                                {{ $course->status == 1 ? 'checked' : '' }} onchange="updateStatus({{ $course->id }}, this)"
                                                aria-label="Changer le statut du cours {{ $course->course_name ?? 'inconnu' }}">
                                            <label class="form-check-label" for="statusToggle{{ $course->id }}">
                                                {{ $course->status == 1 ? 'Actif' : 'Inactif' }}
                                            </label>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Aucun cours trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function updateStatus(courseId, element) {
        const form = document.getElementById('statusForm' + courseId);
        const isCheckedInput = form.querySelector('input[name="is_checked"]');
        isCheckedInput.value = element.checked ? 1 : 0;
        form.submit();
    }
</script>
@endsection