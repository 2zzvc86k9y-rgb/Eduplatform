@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="page-content">
    <div class="row">
        <div class="col-12 ">
            <h6 class="mb-0 text-uppercase">Course Info</h6>
            <hr>
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($course->course_image) }}" class="p-1 border rounded" width="220" height="120" alt="...">
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mt-0">{{ $course->course_name }}</h5>
                            <p class="mb-0">{{ $course->course_title }}</p>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Section</button>
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
                             
                                <a class="btn btn-primary" onclick="addLectureDiv({{ $course->id }},{{ $item->id }},'lectureContainer{{ $key }}')" id="addLectureBtn{{ $key }}">Add Lecture</a> &nbsp;
                                <form action="{{ route('delete.section', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" >Delete</button> 
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
                                        <a href="{{ route('edit.lecture',['id'=>$lecture->id]) }}" class="btn btn-sm btn-primary">Edit</a> &nbsp;
                                        <a href="{{ route('delete.lecture',['id'=>$lecture->id]) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.course.section') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $course->id }}">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="input1" name="section_title">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
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
                <h6>Lecture Title</h6>
                <input type="text" class="mb-3 form-control" placeholder="Enter The Lecture Title">
                <h6>Lecture Content</h6>
                <textarea class="mb-3 form-control" placeholder="Enter the Lecture Content"></textarea>
                <h6>Video</h6>
                <input type="text" name="url" class="form-control" placeholder="Enter the video url">
                <button class="mt-3 btn btn-primary" onclick="saveLecture(${courseId}, ${sectionId}, '${containerId}')">Save Change</button>
                <button class="mt-3 btn btn-secondary" onclick="hideLectureContainer('${containerId}')">Cancel</button>
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
        const lectureUrl = lectureContainer.querySelector('input[name=url]').value;

        fetch('{{ route('save-lecture') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                course_id: courseId,
                section_id: sectionId,
                lecture_title: lectureTitle,
                content: lectureContent,
                lecture_url: lectureUrl
            })
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
                title: 'Error',
                text: 'An error occurred while saving the lecture'
            });
        });
    }
</script>
@endsection
