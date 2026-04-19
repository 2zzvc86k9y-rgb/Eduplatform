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
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un Coupon</li>
                </ol>
            </nav>
        </div>
      
    </div>
    <!--end breadcrumb-->
    

    <div class="row">
        <div class="mx-auto col-xl-10">
            
            <div class="card">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Ajouter un Coupon</h5>
                    <form id="myForm" action="{{ route('instructor.store.cupon') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Nom du Coupon</label>
                            <input type="text" class="form-control" id="input1" name="cupon_name" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Réduction</label>
                            <input type="text" class="form-control" id="input1" name="cupon_discount" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Liste des Cours</label>
                            
                            
                            <select name="course_id" class="mb-3 form-select" aria-label="Default select example">
                                <option selected="">Sélectionnez un cours</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                
                                @endforeach
                            </select>
                        </div>
       
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Validité du Coupon</label>
                            <input type="date" class="form-control" min="{{ Carbon\Carbon::now()->format('Y m d') }}"  name="cupon_validity" >
                        </div>


                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary">Soumettre</button>
                                
                            </div>
                        </div>
       
                    </form>
                </div>
            </div>

      


        </div>
    </div>


   
</div>








<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                cupon_name: {
                    required : true,
                }, 
                cupon_discount: {
                    required : true,
                }, 
                
            },
            messages :{
                cupon_name: {
                    required : 'Veuillez entrer le nom du coupon',
                }, 
                cupon_discount: {
                    required : 'Veuillez sélectionner la réduction',
                }, 
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection