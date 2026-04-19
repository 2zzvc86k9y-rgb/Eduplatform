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
                    <li class="breadcrumb-item active" aria-current="page">Détails du cours</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="main-body">
            <div class="card radius-10 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ !empty($course->course_image) ? asset($course->course_image) : url('upload/noimage.jpg') }}"
                            class="rounded-circle p-1 border" width="90" height="90"
                            alt="Image du cours {{ $course->course_name ?? 'inconnu' }}">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">{{ $course->course_name ?? 'N/A' }}</h5>
                            <p class="mb-0">{{ $course->course_title ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table mb-0" aria-label="Informations principales du cours">
                                <tbody>
                                    <tr>
                                        <th scope="row"><strong>Catégorie:</strong></th>
                                        <td>{{ $course['category']['category_name'] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Sous-catégorie:</strong></th>
                                        <td>{{ $course['subcategory']['subcategory_name'] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Instructeur:</strong></th>
                                        <td>{{ $course['user']['name'] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Niveau:</strong></th>
                                        <td>{{ $course->label ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Durée:</strong></th>
                                        <td>{{ $course->duration ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Vidéo:</strong></th>
                                        <td>
                                            <video height="200" width="300" controls aria-label="Vidéo de présentation du cours">
                                                <source src="{{ !empty($course->video) ? asset($course->video) : '' }}" type="video/mp4">
                                                Votre navigateur ne prend pas en charge la lecture de vidéos.
                                            </video>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table class="table mb-0" aria-label="Informations supplémentaires du cours">
                                <tbody>
                                    <tr>
                                        <th scope="row"><strong>Ressources:</strong></th>
                                        <td>{{ $course->resources ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Certificat:</strong></th>
                                        <td>{{ $course->certificate ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Prix de vente:</strong></th>
                                        <td>{{ $course->selling_price ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Prix réduit:</strong></th>
                                        <td>{{ $course->discount_price ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Statut:</strong></th>
                                        <td>
                                            @if ($course->status == 1)
                                                <span class="badge bg-success">Actif</span>
                                            @elseif($course->status == 0)
                                                <span class="badge bg-danger">Inactif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><strong>Image du cours:</strong></th>
                                        <td>
                                            <img src="{{ !empty($course->course_image) ? asset($course->course_image) : url('upload/noimage.jpg') }}"
                                                alt="Image du cours {{ $course->course_name ?? 'inconnu' }}" width="300" height="200" class="rounded">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection