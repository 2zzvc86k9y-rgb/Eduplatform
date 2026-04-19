@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un cours</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Ajouter un cours</h5>
                    <form id="myForm" action="{{ route('admin.store.course') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="course_name" class="form-label">Nom du cours</label>
                            <input type="text" class="form-control @error('course_name') is-invalid @enderror" id="course_name" name="course_name"
                                value="{{ old('course_name') }}" required aria-describedby="course_name_error">
                            @error('course_name')
                                <span id="course_name_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="course_title" class="form-label">Titre du cours</label>
                            <input type="text" class="form-control @error('course_title') is-invalid @enderror" id="course_title" name="course_title"
                                value="{{ old('course_title') }}" required aria-describedby="course_title_error">
                            @error('course_title')
                                <span id="course_title_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="course_image" class="form-label">Image du cours</label>
                            <input class="form-control @error('course_image') is-invalid @enderror" type="file" id="course_image" name="course_image"
                                accept="image/*" required aria-describedby="course_image_error">
                            @error('course_image')
                                <span id="course_image_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <img id="showImage" src="{{ url('upload/noimage.jpg') }}"
                                alt="Aperçu de l'image du cours" class="p-1 mt-2 rounded-circle bg-primary" width="60">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="video" class="form-label">Vidéo d'introduction</label>
                            <input type="file" class="form-control @error('video') is-invalid @enderror" id="video" name="video"
                                accept="video/mp4,video/webm,video/ogg,video/avi,video/quicktime,video/x-ms-wmv" required aria-describedby="video_error">
                            @error('video')
                                <span id="video_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select class="mb-3 form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id"
                                aria-label="Sélectionner une catégorie" required>
                                <option value="" disabled selected>Sélectionnez une catégorie</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="subcategory_id" class="form-label">Sous-catégorie</label>
                            <select class="mb-3 form-select @error('subcategory_id') is-invalid @enderror" id="subcategory_id" name="subcategory_id"
                                aria-label="Sélectionner une sous-catégorie" required>
                                <option value="" disabled selected>Sélectionnez d'abord une catégorie</option>
                            </select>
                            @error('subcategory_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="certificate" class="form-label">Certificat</label>
                            <select class="mb-3 form-select @error('certificate') is-invalid @enderror" id="certificate" name="certificate"
                                aria-label="Sélectionner une option de certificat" required>
                                <option value="" disabled selected>Sélectionnez une option</option>
                                <option value="Yes">Oui</option>
                                <option value="No">Non</option>
                            </select>
                            @error('certificate')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="label" class="form-label">Niveau du cours</label>
                            <select class="mb-3 form-select @error('label') is-invalid @enderror" id="label" name="label"
                                aria-label="Sélectionner un niveau" required>
                                <option value="" disabled selected>Sélectionnez un niveau</option>
                                <option value="Beginner">Débutant</option>
                                <option value="Intermediate">Intermédiaire</option>
                                <option value="Advanced">Avancé</option>
                            </select>
                            @error('label')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="selling_price" class="form-label">Prix du cours ($)</label>
                            <input type="number" class="form-control @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price"
                                value="{{ old('selling_price') }}" min="0" step="0.01" required aria-describedby="selling_price_error">
                            @error('selling_price')
                                <span id="selling_price_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="discount_price" class="form-label">Prix réduit ($) (optionnel)</label>
                            <input type="number" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price"
                                value="{{ old('discount_price') }}" min="0" step="0.01" aria-describedby="discount_price_error">
                            @error('discount_price')
                                <span id="discount_price_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="duration" class="form-label">Durée (heures)</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration"
                                value="{{ old('duration') }}" min="0" step="0.1" required aria-describedby="duration_error">
                            @error('duration')
                                <span id="duration_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="resources" class="form-label">Ressources</label>
                            <input type="text" class="form-control @error('resources') is-invalid @enderror" id="resources" name="resources"
                                value="{{ old('resources') }}" required aria-describedby="resources_error">
                            @error('resources')
                                <span id="resources_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="prerequisites" class="form-label">Prérequis</label>
                            <textarea name="prerequisites" class="form-control @error('prerequisites') is-invalid @enderror" id="prerequisites"
                                placeholder="Entrez les prérequis..." rows="3" required aria-describedby="prerequisites_error">{{ old('prerequisites') }}</textarea>
                            @error('prerequisites')
                                <span id="prerequisites_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                placeholder="Entrez la description..." rows="3" required aria-describedby="description_error">{{ old('description') }}</textarea>
                            @error('description')
                                <span id="description_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <p>Objectifs du cours</p>
                        <div class="row add_item">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="course_goals_0" class="form-label">Objectifs</label>
                                    <input type="text" name="course_goals[]" id="course_goals_0" class="form-control course-goal"
                                        placeholder="Entrez un objectif..." required aria-describedby="course_goals_error">
                                    <span id="course_goals_error" class="invalid-feedback d-none">Veuillez entrer au moins un objectif.</span>
                                </div>
                            </div>
                            <div class="form-group col-md-6" style="padding-top: 30px;">
                                <a class="btn btn-success addeventmore" aria-label="Ajouter un autre objectif">
                                    <i class="fas fa-plus-circle"></i> Ajouter un autre objectif
                                </a>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="bestseller" value="1" id="bestseller"
                                        aria-label="Marquer comme best-seller">
                                    <label class="form-check-label" for="bestseller">Plus vendu</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="featured" value="1" id="featured"
                                        aria-label="Marquer comme mis en avant">
                                    <label class="form-check-label" for="featured">Mis en avant</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="highestrated" value="1" id="highestrated"
                                        aria-label="Marquer comme mieux noté">
                                    <label class="form-check-label" for="highestrated">Mieux noté</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Ajouter le cours">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template pour les champs dynamiques -->
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="whole_extra_item_delete" id="whole_extra_item_delete">
            <div class="container mt-2">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="course_goals_new" class="form-label">Objectifs</label>
                        <input type="text" name="course_goals[]" id="course_goals_new" class="form-control course-goal"
                            placeholder="Entrez un objectif..." required>
                    </div>
                    <div class="form-group col-md-6" style="padding-top: 20px">
                        <span class="btn btn-success btn-sm addeventmore" aria-label="Ajouter un autre objectif">
                            <i class="fas fa-plus-circle"></i> Ajouter
                        </span>
                        <span class="btn btn-danger btn-sm removeeventmore" aria-label="Supprimer cet objectif">
                            <i class="fas fa-minus-circle"></i> Supprimer
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script type="text/javascript">
    $(document).ready(function() {
        // Gestion des champs dynamiques pour les objectifs
        let counter = 0;
        $(document).on("click", ".addeventmore", function() {
            let whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
            $("#whole_extra_item_delete").find("input.course-goal").attr("id", "course_goals_" + counter);
        });

        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest("#whole_extra_item_delete").remove();
            counter--;
        });

        // Chargement des sous-catégories via AJAX
        $('select[name="category_id"]').on('change', function() {
            const category_id = $(this).val();
            const subcategorySelect = $('select[name="subcategory_id"]');
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        subcategorySelect.html('<option value="" disabled selected>Sélectionnez une sous-catégorie</option>');
                        $.each(data, function(key, value) {
                            subcategorySelect.append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });
                    },
                    error: function() {
                        subcategorySelect.html('<option value="" disabled selected>Erreur lors du chargement des sous-catégories</option>');
                    }
                });
            } else {
                subcategorySelect.html('<option value="" disabled selected>Sélectionnez d'abord une catégorie</option>');
            }
        });

        // Aperçu de l'image
        $('#course_image').change(function(e) {
            const reader = new FileReader();
            reader.onload = (e) => {
                $('#showImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });

        // Validation du formulaire
        $('#myForm').validate({
            ignore: [], // Pour valider les champs dynamiques
            rules: {
                course_name: {
                    required: true,
                },
                course_title: {
                    required: true,
                },
                course_image: {
                    required: true,
                    extension: "jpg|jpeg|png|gif",
                },
                video: {
                    required: true,
                    extension: "mp4|webm|ogg|avi|quicktime|x-ms-wmv",
                },
                category_id: {
                    required: true,
                },
                subcategory_id: {
                    required: true,
                },
                certificate: {
                    required: true,
                },
                label: {
                    required: true,
                },
                selling_price: {
                    required: true,
                    number: true,
                    min: 0,
                },
                discount_price: {
                    number: true,
                    min: 0,
                },
                duration: {
                    required: true,
                    number: true,
                    min: 0,
                },
                resources: {
                    required: true,
                },
                prerequisites: {
                    required: true,
                },
                description: {
                    required: true,
                },
                'course_goals[]': {
                    required: true,
                },
            },
            messages: {
                course_name: {
                    required: "Veuillez entrer le nom du cours",
                },
                course_title: {
                    required: "Veuillez entrer le titre du cours",
                },
                course_image: {
                    required: "Veuillez sélectionner une image",
                    extension: "Veuillez sélectionner une image au format JPG, JPEG, PNG ou GIF",
                },
                video: {
                    required: "Veuillez sélectionner une vidéo",
                    extension: "Veuillez sélectionner une vidéo au format MP4, WEBM, OGG, AVI, QuickTime ou WMV",
                },
                category_id: {
                    required: "Veuillez sélectionner une catégorie",
                },
                subcategory_id: {
                    required: "Veuillez sélectionner une sous-catégorie",
                },
                certificate: {
                    required: "Veuillez sélectionner une option pour le certificat",
                },
                label: {
                    required: "Veuillez sélectionner un niveau",
                },
                selling_price: {
                    required: "Veuillez entrer le prix du cours",
                    number: "Le prix doit être un nombre",
                    min: "Le prix doit être supérieur ou égal à 0",
                },
                discount_price: {
                    number: "Le prix réduit doit être un nombre",
                    min: "Le prix réduit doit être supérieur ou égal à 0",
                },
                duration: {
                    required: "Veuillez entrer la durée du cours",
                    number: "La durée doit être un nombre",
                    min: "La durée doit être supérieure ou égale à 0",
                },
                resources: {
                    required: "Veuillez entrer les ressources",
                },
                prerequisites: {
                    required: "Veuillez entrer les prérequis",
                },
                description: {
                    required: "Veuillez entrer une description",
                },
                'course_goals[]': {
                    required: "Veuillez entrer au moins un objectif",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.attr('name') === 'course_goals[]') {
                    error.insertAfter(element.closest('.add_item').find('#course_goals_error'));
                    $('#course_goals_error').removeClass('d-none');
                } else {
                    element.closest('.form-group').append(error);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection