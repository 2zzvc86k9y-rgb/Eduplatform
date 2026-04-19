@extends('instructor.instructor_dashboard')
@section('instructor')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <!-- Breadcrumb -->
    <div class="mb-3 page-breadcrumb d-none d-sm-flex align-items-center">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="p-0 mb-0 breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('instructor.dashboard') }}" aria-label="Retour au tableau de bord">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier un cours</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Formulaire de mise à jour des informations du cours -->
    <div class="row">
        <div class="mx-auto col-xl-10">
            <div class="card shadow-sm">
                <div class="p-4 card-body">
                    <h5 class="mb-4">Modifier les informations du cours</h5>
                    <form id="myForm" action="{{ route('update.course') }}" method="POST" class="row g-3">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <input type="hidden" name="course_id" value="{{ $course->id }}">

                        <div class="form-group col-md-6">
                            <label for="course_name" class="form-label">Nom du cours</label>
                            <input type="text" class="form-control @error('course_name') is-invalid @enderror" id="course_name" name="course_name"
                                value="{{ old('course_name', $course->course_name) }}" required aria-describedby="course_name_error">
                            @error('course_name')
                                <span id="course_name_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="course_title" class="form-label">Titre du cours</label>
                            <input type="text" class="form-control @error('course_title') is-invalid @enderror" id="course_title" name="course_title"
                                value="{{ old('course_title', $course->course_title) }}" required aria-describedby="course_title_error">
                            @error('course_title')
                                <span id="course_title_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select class="mb-3 form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id"
                                aria-label="Sélectionner une catégorie" required>
                                <option value="" disabled>Sélectionnez une catégorie</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $course->category_id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
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
                                <option value="" disabled>Sélectionnez une sous-catégorie</option>
                                @foreach ($subcategories as $subcat)
                                    <option value="{{ $subcat->id }}" {{ $subcat->id == $course->subcategory_id ? 'selected' : '' }}>{{ $subcat->subcategory_name }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="certificate" class="form-label">Certificat</label>
                            <select class="mb-3 form-select @error('certificate') is-invalid @enderror" id="certificate" name="certificate"
                                aria-label="Sélectionner une option de certificat" required>
                                <option value="" disabled>Sélectionnez une option</option>
                                <option value="Yes" {{ $course->certificate == 'Yes' ? 'selected' : '' }}>Oui</option>
                                <option value="No" {{ $course->certificate == 'No' ? 'selected' : '' }}>Non</option>
                            </select>
                            @error('certificate')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="label" class="form-label">Niveau du cours</label>
                            <select class="mb-3 form-select @error('label') is-invalid @enderror" id="label" name="label"
                                aria-label="Sélectionner un niveau" required>
                                <option value="" disabled>Sélectionnez un niveau</option>
                                <option value="Beginner" {{ $course->label == 'Begginer' ? 'selected' : '' }}>Débutant</option>
                                <option value="Intermediate" {{ $course->label == 'Middle' ? 'selected' : '' }}>Intermédiaire</option>
                                <option value="Advanced" {{ $course->label == 'Advance' ? 'selected' : '' }}>Avancé</option>
                            </select>
                            @error('label')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="selling_price" class="form-label">Prix du cours (€)</label>
                            <input type="number" class="form-control @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price"
                                value="{{ old('selling_price', $course->selling_price) }}" min="0" step="0.01" required aria-describedby="selling_price_error">
                            @error('selling_price')
                                <span id="selling_price_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="discount_price" class="form-label">Prix réduit (€) (optionnel)</label>
                            <input type="number" class="form-control @error('discount_price') is-invalid @enderror" id="discount_price" name="discount_price"
                                value="{{ old('discount_price', $course->discount_price) }}" min="0" step="0.01" aria-describedby="discount_price_error">
                            @error('discount_price')
                                <span id="discount_price_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="duration" class="form-label">Durée (heures)</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration"
                                value="{{ old('duration', $course->duration) }}" min="0" step="0.1" required aria-describedby="duration_error">
                            @error('duration')
                                <span id="duration_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="resources" class="form-label">Ressources</label>
                            <input type="text" class="form-control @error('resources') is-invalid @enderror" id="resources" name="resources"
                                value="{{ old('resources', $course->resources) }}" required aria-describedby="resources_error">
                            @error('resources')
                                <span id="resources_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="prerequisites" class="form-label">Prérequis</label>
                            <textarea name="prerequisites" class="form-control @error('prerequisites') is-invalid @enderror" id="prerequisites"
                                placeholder="Entrez les prérequis..." rows="3" required aria-describedby="prerequisites_error">{{ old('prerequisites', $course->prerequisites) }}</textarea>
                            @error('prerequisites')
                                <span id="prerequisites_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                placeholder="Entrez la description..." rows="3" required aria-describedby="description_error">{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <span id="description_error" class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="bestseller" value="1" id="bestseller"
                                        {{ $course->bestseller == '1' ? 'checked' : '' }} aria-label="Marquer comme best-seller">
                                    <label class="form-check-label" for="bestseller">Best-seller</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="featured" value="1" id="featured"
                                        {{ $course->featured == '1' ? 'checked' : '' }} aria-label="Marquer comme mis en avant">
                                    <label class="form-check-label" for="featured">Mis en avant</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="highestrated" value="1" id="highestrated"
                                        {{ $course->highestrated == '1' ? 'checked' : '' }} aria-label="Marquer comme mieux noté">
                                    <label class="form-check-label" for="highestrated">Mieux noté</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="gap-3 d-md-flex d-grid align-items-center">
                                <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour les informations du cours">Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de mise à jour de l'image -->
    <div class="page-content mt-4">
        <div class="row">
            <div class="mx-auto col-xl-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-4">Modifier l'image du cours</h5>
                        <div class="row">
                            <form id="imageForm" action="{{ route('update.course.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}<br>
                                        @endforeach
                                    </div>
                                @endif

                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input type="hidden" name="old_image" value="{{ $course->course_image }}">

                                <div class="col-md-6">
                                    <img id="showImage" src="{{ asset($course->course_image) }}"
                                        alt="Image actuelle du cours" class="p-1 mt-2 rounded bg-primary" width="220" height="220">
                                </div>

                                <div class="mt-3 form-group col-md-12">
                                    <label for="course_image" class="form-label">Nouvelle image du cours</label>
                                    <input class="form-control @error('course_image') is-invalid @enderror" type="file" id="course_image" name="course_image"
                                        accept="image/*" required aria-describedby="course_image_error">
                                    @error('course_image')
                                        <span id="course_image_error" class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="gap-3 d-md-flex d-grid align-items-center">
                                        <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour l'image du cours">Mettre à jour</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de mise à jour de la vidéo -->
    <div class="page-content mt-4">
        <div class="row">
            <div class="mx-auto col-xl-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-4">Modifier la vidéo du cours</h5>
                        <div class="row">
                            <form id="videoForm" action="{{ route('update.course.video') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}<br>
                                        @endforeach
                                    </div>
                                @endif

                                <input type="hidden" name="video_id" value="{{ $course->id }}">
                                <input type="hidden" name="old_video" value="{{ $course->video }}">

                                <div class="col-md-6">
                                    <video id="videoShow" width="300" height="130" controls>
                                        <source src="{{ asset($course->video) }}" type="video/mp4">
                                        Votre navigateur ne prend pas en charge la lecture de vidéos.
                                    </video>
                                </div>

                                <div class="mt-3 form-group col-md-12">
                                    <label for="course_video" class="form-label">Nouvelle vidéo d'introduction</label>
                                    <input type="file" class="form-control @error('video') is-invalid @enderror" id="course_video" name="video"
                                        accept="video/mp4,video/webm" required aria-describedby="course_video_error">
                                    <small class="form-text text-muted">La vidéo sera mise à jour après soumission.</small>
                                    @error('video')
                                        <span id="course_video_error" class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="gap-3 d-md-flex d-grid align-items-center">
                                        <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour la vidéo du cours">Mettre à jour</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire de mise à jour des objectifs -->
    <div class="page-content mt-4">
        <div class="row">
            <div class="mx-auto col-xl-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-4">Modifier les objectifs du cours</h5>
                        <div class="row">
                            <form id="goalsForm" action="{{ route('update.course.goals') }}" method="POST">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}<br>
                                        @endforeach
                                    </div>
                                @endif

                                <input type="hidden" name="id" value="{{ $course->id }}">

                                <div class="add_item">
                                    @forelse ($goals as $index => $item)
                                        <div class="whole_extra_item_delete" id="whole_extra_item_delete_{{ $index }}">
                                            <div class="container mt-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="course_goals_{{ $index }}" class="form-label">Objectif</label>
                                                            <input type="text" name="course_goals[]" id="course_goals_{{ $index }}"
                                                                class="form-control course-goal" value="{{ $item->goal_name }}"
                                                                required aria-describedby="course_goals_error">
                                                            <span id="course_goals_error" class="invalid-feedback d-none">Veuillez entrer au moins un objectif.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6" style="padding-top: 30px;">
                                                        <a class="btn btn-success addeventmore" aria-label="Ajouter un autre objectif">
                                                            <i class="fas fa-plus-circle"></i> Ajouter
                                                        </a>
                                                        <span class="btn btn-danger btn-sm removeeventmore" aria-label="Supprimer cet objectif">
                                                            <i class="fas fa-minus-circle"></i> Supprimer
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="whole_extra_item_delete" id="whole_extra_item_delete_0">
                                            <div class="container mt-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="course_goals_0" class="form-label">Objectif</label>
                                                            <input type="text" name="course_goals[]" id="course_goals_0"
                                                                class="form-control course-goal" placeholder="Entrez un objectif..."
                                                                required aria-describedby="course_goals_error">
                                                            <span id="course_goals_error" class="invalid-feedback d-none">Veuillez entrer au moins un objectif.</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6" style="padding-top: 30px;">
                                                        <a class="btn btn-success addeventmore" aria-label="Ajouter un autre objectif">
                                                            <i class="fas fa-plus-circle"></i> Ajouter
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="gap-3 d-md-flex d-grid align-items-center">
                                        <button type="submit" class="px-4 btn btn-primary" aria-label="Mettre à jour les objectifs du cours">Mettre à jour</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
                        <label for="course_goals_new" class="form-label">Objectif</label>
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
        let counter = {{ count($goals) }};
        $(document).on("click", ".addeventmore", function() {
            let whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
            $("#whole_extra_item_delete").find("input.course-goal").attr("id", "course_goals_" + counter);
        });

        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest("[id^='whole_extra_item_delete']").remove();
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

        // Validation du formulaire principal
        $('#myForm').validate({
            rules: {
                course_name: {
                    required: true,
                },
                course_title: {
                    required: true,
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
            },
            messages: {
                course_name: {
                    required: "Veuillez entrer le nom du cours",
                },
                course_title: {
                    required: "Veuillez entrer le titre du cours",
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
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });

        // Validation du formulaire d'image
        $('#imageForm').validate({
            rules: {
                course_image: {
                    required: true,
                    extension: "jpg|jpeg|png|gif",
                },
            },
            messages: {
                course_image: {
                    required: "Veuillez sélectionner une nouvelle image",
                    extension: "Veuillez sélectionner une image au format JPG, JPEG, PNG ou GIF",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });

        // Validation du formulaire de vidéo
        $('#videoForm').validate({
            rules: {
                video: {
                    required: true,
                    extension: "mp4|webm",
                },
            },
            messages: {
                video: {
                    required: "Veuillez sélectionner une nouvelle vidéo",
                    extension: "Veuillez sélectionner une vidéo au format MP4 ou WEBM",
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });

        // Validation du formulaire des objectifs
        $('#goalsForm').validate({
            ignore: [],
            rules: {
                'course_goals[]': {
                    required: true,
                },
            },
            messages: {
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