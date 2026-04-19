@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="page-content">
    <div class="row">
        <div class="col-12 ">
            <h6 class="mb-0 text-uppercase">Informations du cours</h6>
            <hr>
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($course->course_image) }}" class="p-1 border rounded" width="220" height="120" alt="...">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">{{ $course->course_name }}</h5>
                            <p class="mb-0">{{ $course->course_title }}</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter une section</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($section as $key => $item)
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <h5>{{ $item->section_title }}</h5>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-primary" onclick="addLectureDiv({{ $course->id }},{{ $item->id }},'lectureContainer{{ $key }}')" id="addLectureBtn{{ $key }}">Ajouter une leçon</a> &nbsp;
                                <form action="{{ route('delete.section', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Supprimer</button> 
                                </form>
                            </div>
                        </div>
                        <div class="courseHide" id="lectureContainer{{ $key }}">
                            <div class="container">
                                @foreach ($item->lectures as $lecture)
                                <div class="mb-3 lectureDiv d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $loop->iteration }}.{{ $lecture->lecture_title }}</strong>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('edit.lecture',['id'=>$lecture->id]) }}" class="btn btn-sm btn-primary">Modifier</a> &nbsp;
                                        <a href="{{ route('delete.lecture',['id'=>$lecture->id]) }}" class="btn btn-sm btn-danger" id="delete">Supprimer</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal show part -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.course.section') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Nom de la section</label>
                            <input type="text" class="form-control" id="input1" name="section_title">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
                </form>
        </div>
    </div>
</div>

<script>
    function addLectureDiv(courseId, sectionId, containerId) {
        const lectureContainer = document.getElementById(containerId);
        const newLectureDiv = document.createElement('div');
        newLectureDiv.classList.add('lectureDiv', 'mb-3');

        newLectureDiv.innerHTML = `
            <div class="container">
                <h6>Titre de la leçon</h6>
                <input type="text" class="mb-3 form-control" placeholder="Entrez le titre de la leçon">
                <h6>Contenu de la leçon</h6>
                <textarea class="mb-3 form-control" placeholder="Entrez le contenu de la leçon"></textarea>
                <h6>Vidéo</h6>
                <input type="file" name="video" class="form-control" accept="video/*">
                <button class="mt-3 btn btn-primary" onclick="saveLecture(${courseId}, ${sectionId}, '${containerId}')">Enregistrer</button>
                <button class="mt-3 btn btn-secondary" onclick="hideLectureContainer('${containerId}')">Annuler</button>
            </div>
        `;

        lectureContainer.appendChild(newLectureDiv);
        lectureContainer.style.display = 'block';
    }

    function hideLectureContainer(containerId) {
        const lectureContainer = document.getElementById(containerId);
        lectureContainer.style.display = 'none';
    }

    function saveLecture(courseId, sectionId, containerId) {
        const lectureContainer = document.getElementById(containerId);
        const lectureTitle = lectureContainer.querySelector('input[type=text]').value;
        const lectureContent = lectureContainer.querySelector('textarea').value;
        const videoFile = lectureContainer.querySelector('input[type=file]').files[0];

        const formData = new FormData();
        formData.append('course_id', courseId);
        formData.append('section_id', sectionId);
        formData.append('lecture_title', lectureTitle);
        formData.append('content', lectureContent);
        if (videoFile) {
            formData.append('video', videoFile);
        }

        fetch('{{ route('save-lecture') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            if (data.success) {
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.error
                });
            }
            hideLectureContainer(containerId);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Une erreur est survenue lors de l\'enregistrement de la leçon'
            });
        });
    }
</script>
@endsection
