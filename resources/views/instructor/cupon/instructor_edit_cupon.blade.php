@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier le Coupon</li>
                </ol>
            </nav>
        </div>
        {{-- <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.category') }}" class="px-5 btn btn-primary">Add Category</a>

            </div>
        </div> --}}
    </div>
    <!--end breadcrumb-->


    <div class="row">
        <div class="mx-auto col-xl-10">

            <div class="card">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier le Coupon</h5>
                    <form id="myForm" action="{{ route('instructor.update.cupon') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" id="cupon_id" name="cupon_id"  value="{{ $cupon-> id}}" >

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Nom du Coupon</label>
                            <input type="text" class="form-control" id="input1" name="cupon_name" value="{{ $cupon->cupon_name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Réduction</label>
                            <input type="text" class="form-control" id="input1" name="cupon_discount" value="{{ $cupon->cupon_discount }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Liste des Cours</label>
                            
                            
                            <select name="course_id" class="mb-3 form-select" aria-label="Default select example">
                                <option selected="">Sélectionnez un cours</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == $cupon->course_id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                                
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Validité du Coupon</label>
                            <input type="date" class="form-control" min="{{ Carbon\Carbon::now()->format('Y m d') }}"  name="cupon_validity" value="{{ $cupon->cupon_validity }}">
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary">Mettre à jour</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>




        </div>
    </div>



</div>





<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>





@endsection
