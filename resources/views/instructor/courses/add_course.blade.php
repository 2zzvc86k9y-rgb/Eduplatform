@extends('./instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un cours</li>
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
                    <h5 class="mb-4">Ajouter un cours</h5>
                    <form id="myForm" action="{{ route('store.course') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Nom du cours</label>
                            <input type="text" class="form-control" id="input1" name="course_name" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Titre du cours</label>
                            <input type="text" class="form-control" id="input1" name="course_title" >
                        </div>


                        <div class="form-group col-md-6">
                            <label for="image" class="form-label">Image du cours</label>
                            <input class="form-control" type="file" id="image"  name="course_image">
                        </div>

                       <div class="col-md-6">
                        <img id="showImage" src="{{ url('upload/noimage.jpg') }}"
                                                alt="Admin" class="p-1 mt-2 rounded-circle bg-primary" width="60">
                       </div>


                       <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Vidéo d'introduction</label>
                        <input type="file" class="form-control" id="input1" name="video" accept="video/mp4,video/webm,video/ogg,video/avi,video/quicktime,video/x-ms-wmv">
                    </div>

                    <div class="form-group col-md-6">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Catégorie</label>
                        <select class="mb-3 form-select col-md-6" aria-label="Default select example" name="category_id">
                            <option selected="" disabled>Sélectionnez une catégorie</option>
                            @foreach ($categories as $cat )
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Sous-catégorie</label>
                        <select class="mb-3 form-select col-md-6" aria-label="Default select example" name="subcategory_id">
                            <option></option>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input1" class="form-label">Certificat</label>
                        <select class="mb-3 form-select col-md-6" aria-label="Default select example" name="certificate">
                            <option selected="" disabled>Sélectionnez une option</option>
                            <option value="Yes">Oui</option>
                            <option value="No">Non</option>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input1" class="form-label">Niveau du cours</label>
                        <select class="mb-3 form-select col-md-6" aria-label="Default select example" name="label">
                            <option selected="" disabled>Sélectionnez un niveau</option>
                            <option value="Begginer">Débutant</option>
                            <option value="Middle">Intermédiaire</option>
                            <option value="Advance">Avancé</option>

                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="input1" class="form-label">Prix du cours</label>
                        <input type="text" class="form-control" id="input1" name="selling_price" >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input1" class="form-label">Prix promotionnel</label>
                        <input type="text" class="form-control" id="input1" name="discount_price" >
                    </div>

                    <div class="form-group col-md-4">
                        <label for="input1" class="form-label">Durée</label>
                        <input type="text" class="form-control" id="input1" name="duration" >
                    </div>

                    <div class="form-group col-md-4">
                        <label for="input1" class="form-label">Ressources</label>
                        <input type="text" class="form-control" id="input1" name="resources" >
                    </div>


                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Prérequis</label>
                        <textarea name="prerequisites" class="form-control" id="input11" placeholder="Prérequis..." rows="3"></textarea>
                    </div>
{{-- id="myeditorinstance"  --}}
                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Description</label>
                        <textarea name="description" class="form-control" placeholder="Description..." rows="3"></textarea>
                    </div>


                    <p>Objectifs du cours</p>

                     <div class="row add_item">
        <div class="col-md-6">
              <div class="mb-3">
                                <label for="goals" class="form-label">Objectif</label>
                                <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Entrez un objectif">
              </div>
        </div>
        <div class="form-group col-md-6" style="padding-top: 30px;">
                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Ajouter un objectif</a>
                        </div>
        </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bestseller" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Meilleure vente
                                </label>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    En vedette
                                </label>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="highestrated" value="1" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Mieux noté
                                </label>
                              </div>
                        </div>
                    </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                            <button type="submit" class="px-4 btn btn-primary">Enregistrer le cours</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>




        </div>
    </div>



</div>
<!--========== Start of add multiple class with ajax ==============-->
<div style="visibility: hidden">
   <div class="whole_extra_item_add" id="whole_extra_item_add">
      <div class="whole_extra_item_delete" id="whole_extra_item_delete">
         <div class="container mt-2">
            <div class="row">


               <div class="form-group col-md-6">
                  <label for="goals">Objectifs</label>
                  <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Objectifs">
               </div>
               <div class="form-group col-md-6" style="padding-top: 20px">
                  <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Ajouter</i></span>
                  <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Supprimer</i></span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<!----For Section-------->
<script type="text/javascript">
   $(document).ready(function(){
      var counter = 0;
      $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
      });
      $(document).on("click",".removeeventmore",function(event){
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
      });
   });
</script>
<!--========== End of add multiple class with ajax ==============-->


<script type="text/javascript">

    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="subcategory_id"]').html('');
                        var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },

                });
            } else {
                alert('danger');
            }
        });
    });

</script>


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



<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                course_name: {
                    required : true,
                },
                course_title: {
                    required : true,
                },
                course_image: {
                    required : true,
                },
                video: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
                subcategory_id: {
                    required : true,
                },
                certificate: {
                    required : true,
                },
                label: {
                    required : true,
                },
                selling_price: {
                    required : true,
                },
                discount_price: {
                    required : true,
                },
                duration: {
                    required : true,
                },
                resources: {
                    required : true,
                },
                prerequisites: {
                    required : true,
                },
                description: {
                    required : true,
                },
            },
            messages :{
                course_name: {
                    required : 'Le nom du cours est requis',
                },
                course_title: {
                    required : 'Le titre du cours est requis',
                },
                course_image: {
                    required : 'Une image du cours est requise',
                },
                video: {
                    required : 'Une vidéo d\'introduction est requise',
                },
                category_id: {
                    required : 'La catégorie est requise',
                },
                subcategory_id: {
                    required : 'La sous-catégorie est requise',
                },
                certificate: {
                    required : 'Veuillez spécifier si un certificat est disponible',
                },
                label: {
                    required : 'Le niveau du cours est requis',
                },
                selling_price: {
                    required : 'Le prix du cours est requis',
                },
                discount_price: {
                    required : 'Le prix promotionnel est requis',
                },
                duration: {
                    required : 'La durée du cours est requise',
                },
                resources: {
                    required : 'Les ressources sont requises',
                },
                prerequisites: {
                    required : 'Les prérequis sont requis',
                },
                description: {
                    required : 'La description est requise',
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