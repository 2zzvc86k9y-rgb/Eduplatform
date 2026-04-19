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
                    <li class="breadcrumb-item active" aria-current="page">Modifier le cours</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier le cours</h5>
                    <form id="myForm" action="{{ route('update.course') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Nom du cours</label>
                            <input type="text" class="form-control" id="input1" name="course_name" value="{{ $course->course_name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Titre du cours</label>
                            <input type="text" class="form-control" id="input1" name="course_title" value="{{ $course->course_title }}">
                        </div>

                    <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Catégorie</label>
                            <select class="mb-3 form-select col-md-6" aria-label="Default select example" name="category_id">
                                <option selected="" disabled>Sélectionnez une catégorie</option>
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $course->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                            <label for="input1" class="form-label">Sous-catégorie</label>
                        <select class="mb-3 form-select col-md-6" aria-label="Default select example" name="subcategory_id">
                                <option selected="" disabled>Sélectionnez une sous-catégorie</option>
                                @foreach ($subcategories as $subcat)
                                <option value="{{ $subcat->id }}" {{ $subcat->id == $course->subcategory_id ? 'selected' : '' }}>{{ $subcat->subcategory_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                            <label for="input1" class="form-label">Certificat</label>
                        <select class="mb-3 form-select col-md-6" aria-label="Default select example" name="certificate">
                                <option selected="" disabled>Sélectionnez une option</option>
                                <option value="Yes" {{ $course->certificate == 'Yes' ? 'selected' : '' }}>Oui</option>
                                <option value="No" {{ $course->certificate == 'No' ? 'selected' : '' }}>Non</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                            <label for="input1" class="form-label">Niveau du cours</label>
                            <select class="mb-3 form-select col-md-6" aria-label="Default select example" name="label">
                                <option selected="" disabled>Sélectionnez un niveau</option>
                                <option value="Begginer" {{ $course->label == 'Begginer' ? 'selected' : '' }}>Débutant</option>
                                <option value="Middle" {{ $course->label == 'Middle' ? 'selected' : '' }}>Intermédiaire</option>
                                <option value="Advance" {{ $course->label == 'Advance' ? 'selected' : '' }}>Avancé</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                            <label for="input1" class="form-label">Prix du cours</label>
                            <input type="text" class="form-control" id="input1" name="selling_price" value="{{ $course->selling_price }}">
                    </div>

                    <div class="form-group col-md-4">
                            <label for="input1" class="form-label">Prix promotionnel</label>
                            <input type="text" class="form-control" id="input1" name="discount_price" value="{{ $course->discount_price }}">
                    </div>

                    <div class="form-group col-md-4">
                            <label for="input1" class="form-label">Durée</label>
                            <input type="text" class="form-control" id="input1" name="duration" value="{{ $course->duration }}">
                    </div>

                    <div class="form-group col-md-4">
                            <label for="input1" class="form-label">Ressources</label>
                        <input type="text" class="form-control" id="input1" name="resources" value="{{ $course->resources }}">
                    </div>

                    <div class="form-group col-md-12">
                            <label for="input1" class="form-label">Prérequis</label>
                            <textarea name="prerequisites" class="form-control" id="input11" placeholder="Prérequis..." rows="3">{{ $course->prerequisites }}</textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Description</label>
                            <textarea name="description" class="form-control" placeholder="Description..." rows="3">{{ $course->description }}</textarea>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bestseller" value="1" id="flexCheckDefault" {{ $course->bestseller == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                        Meilleure vente
                                </label>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="featured" value="1" id="flexCheckDefault" {{ $course->featured == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                        En vedette
                                </label>
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="highestrated" value="1" id="flexCheckDefault" {{ $course->highestrated == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                        Mieux noté
                                </label>
                              </div>
                        </div>
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

{{-- ================== Course Image update ======================== --}}
<div class="page-content">
    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Modifier l'image</h5>
                    <div class="row">
                        <form action="{{ route('update.course.image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="old_image" value="{{ $course->course_image}}">
                            
                                <div class="col-md-6">
                                    <img id="showImage" src="{{ asset($course->course_image) }}"
                                                        alt="Admin" class="p-1 mt-2 rounded bg-primary" width="220" height="220">
                            </div>

                                <div class="mt-3 form-group col-md-12">
                                <label for="image" class="form-label">Image du cours</label>
                                <input class="form-control" type="file" id="image" name="course_image">
                            </div>
                            
                            <br><br>
                            <div class="col-md-12">
                                <div class="gap-3 d-md-flex d-grid align-items-center">
                                    <button type="submit" class="px-4 btn btn-primary">Mettre à jour l'image</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================== Course Video update ======================== --}}
<div class="page-content">
    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Modifier la vidéo</h5>
                    <div class="row">
                        <form action="{{ route('update.course.video') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="video_id" value="{{ $course->id }}">
                            <input type="hidden" name="old_video" value="{{ $course->video}}">
                            
                                <div class="col-md-6">
                                    <video id="videoshow" width="300" height="130" controls>
                                        <source src="{{ asset($course->video) }}" type="video/mp4">
                                    </video>
                                 </div>
                               
                                <div class="mt-3 form-group col-md-12">
                                <label for="video" class="form-label">Vidéo du cours</label>
                                    <input type="file" class="form-control" id="video" name="video" accept="video/mp4, video/webm">
                            </div>

                            <br><br>
                            <div class="col-md-12">
                                <div class="gap-3 d-md-flex d-grid align-items-center">
                                    <button type="submit" class="px-4 btn btn-primary">Mettre à jour la vidéo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================== Course Goals update ======================== --}}
<div class="page-content">
    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Modifier les objectifs</h5>
                    <div class="row">
                        <form action="{{ route('update.course.goals') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $course->id }}">
                        @foreach ($goals as $item) 
                            <div class="row add_item">
                                <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                    <div class="container mt-2">
                                       <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="goals" class="form-label">Objectif</label>
                                                        <input type="text" name="course_goals[]" id="goals" class="form-control" value="{{ $item->goal_name }}">
                                            </div>
                                            </div>
                                            <div class="form-group col-md-6" style="padding-top: 30px;">
                                                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Ajouter</a>
                                                <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Supprimer</i></span>
                                            </div>
                                         </div>
                                     </div>
                                </div>
                            </div> 
                         @endforeach
                            
                            <br><br>
                            <div class="col-md-12">
                                <div class="gap-3 d-md-flex d-grid align-items-center">
                                    <button type="submit" class="px-4 btn btn-primary">Mettre à jour les objectifs</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
                  <label for="goals">Objectif</label>
                  <input type="text" name="course_goals[]" id="goals" class="form-control" placeholder="Entrez un objectif">
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

{{-- changeimage by jqury --}}
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

{{--  change video by jqury --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#video').change(function(e) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#videoshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>

@endsection