@php
    $courses = App\Models\Course::where('status',1)->orderBy('id','ASC')->limit(6)->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
    $setting = App\Models\SiteSetting::find(1);
    $user = Auth::user();
@endphp

<!-- Section des cours avec onglets pour filtrer par catégorie -->
<section class="course-area pb-120px" style="background: #fdf1e3;">
    <!-- Conteneur principal pour l'en-tête et les onglets -->
    <div class="container">
        <!-- En-tête centré avec titre et séparateur -->
        <div class="text-center section-heading">
            <!-- Ruban pour le sous-titre -->
            <h5 class="mb-2 ribbon ribbon-lg">Choisissez vos cours préférés</h5>
            <!-- Titre principal de la section -->
            <h2 class="section__title">La plus grande sélection de cours sur EduPlatform</h2>
            <!-- Ligne décorative -->
            <span class="section-divider"></span>
        </div><!-- Fin de l'en-tête -->
        <!-- Onglets pour filtrer les cours par catégorie -->
        <ul class="pb-4 nav nav-tabs generic-tab justify-content-center" id="myTab" role="tablist">
            <!-- Onglet pour afficher tous les cours -->
            <li class="nav-item">
                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab"
                    aria-controls="all" aria-selected="true">Tous</a>
            </li>
            @foreach ($categories as $category)
            <!-- Onglet pour chaque catégorie -->
            <li class="nav-item">
                <a class="nav-link" id="category-tab-{{ $category->id }}" data-toggle="tab" href="#category{{ $category->id }}" role="tab"
                    aria-controls="category{{ $category->id }}" aria-selected="false">{{ $category->category_name }}</a>
            </li>
            @endforeach
        </ul>
    </div><!-- Fin du conteneur -->
    <!-- Conteneur pour les cartes de cours avec fond gris -->
    <div class="card-content-wrapper bg-gray pt-50px pb-120px" style="background: #fdf1e3;">
        <div class="container">
            <!-- Contenu des onglets -->
            <div class="tab-content" id="myTabContent">
                <!-- Onglet "Tous" affichant les cours principaux -->
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row">
                        @foreach ($courses as $course)
                        <!-- Carte de cours moderne façon OpenClassrooms -->
                        <div class="col-lg-4 responsive-column-half mb-4">
                            <div class="card card-item card-preview p-3" data-tooltip-content="#tooltip_content_1{{ $course->id }}" style="border-radius: 22px; box-shadow: 0 8px 32px #3578e522;">
                                <div class="card-image position-relative">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                                        <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" alt="Image du cours" style="border-radius: 18px; min-height:180px; object-fit:cover;">
                                    </a>
                                    <div class="course-badge-labels position-absolute" style="top:12px;left:12px;z-index:2;">
                                        @if ($course->bestseller == 1)
                                        <span class="course-badge" style="background:linear-gradient(90deg,#ff9800,#ffb347);">Meilleure vente</span>
                                        @endif
                                        @if ($course->highestrated == 1)
                                        <span class="course-badge" style="background:linear-gradient(90deg,#3578e5,#38f9d7);">Mieux noté</span>
                                        @endif
                                        @if ($course->featured == 1)
                                        <span class="course-badge" style="background:linear-gradient(90deg,#43e97b,#38f9d7);">En vedette</span>
                                        @endif
                                        @php
                                            $discount = $course->selling_price - $course->discount_price;
                                            $discount_per = round($discount / $course->selling_price * 100);
                                        @endphp
                                        @if ($course->discount_price == NULL)
                                        <span class="course-badge" style="background:linear-gradient(90deg,#3578e5,#38f9d7);">Nouveau</span>
                                        @else
                                        <span class="course-badge" style="background:linear-gradient(90deg,#e52e71,#ff8a00);">-{{ $discount_per }}%</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body pt-3 pb-2">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ !empty($course->user->photo) ? url('upload/instructor_image/' . $course->user->photo) : url('upload/noimage.jpg') }}" class="avatar mr-2" style="width:38px;height:38px;object-fit:cover;" alt="Avatar instructeur">
                                        <div>
                                            <div class="font-weight-bold text-dark small">{{ $course['user']['name'] }}</div>
                                        </div>
                                    </div>
                                    <h5 class="card-title mb-2" style="font-weight:700;font-size:1.2rem;"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="text-dark">{{ $course->course_name }}</a></h5>
                                    <div class="mb-2 text-muted small">{{ $course->label }}</div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="review-stars mr-2">
                                        @php
                                        $reviewCount = App\Models\Review::where('course_id', $course->id)->where('status', 1)->latest()->get();
                                        $avarage = App\Models\Review::where('course_id', $course->id)->where('status', 1)->avg('rating');
                                        @endphp
                                            <span class="rating-number">{{ round($avarage, 1) }}</span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($avarage >= $i)
                                            <span class="la la-star"></span>
                                                @elseif ($avarage >= $i - 0.5)
                                                    <span class="la la-star-half-alt"></span>
                                                @else
                                            <span class="la la-star-o"></span>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="text-muted small">({{ count($reviewCount) }} avis)</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-3">
                                        <div>
                                            @if ($course->discount_price == NULL)
                                            <span class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</span>
                                            @else
                                            <span class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->discount_price }}</span>
                                            <span class="before-price font-weight-medium text-muted" style="text-decoration:line-through;">{{ $setting->currency }}{{ $course->selling_price }}</span>
                                            @endif
                                        </div>
                                        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="btn btn-primary btn-sm px-3">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!-- Fin de l'onglet "Tous" -->
                @foreach ($categories as $category)
                <!-- Onglet pour chaque catégorie -->
                <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel" aria-labelledby="category-tab-{{ $category->id }}">
                    <div class="row">
                        @php
                            $categoryWiseCourse = App\Models\Course::where('category_id', $category->id)->where('status',1)->orderBy('id','DESC')->limit(3)->get();
                        @endphp
                        @forelse ($categoryWiseCourse as $course)
                        <!-- Carte pour chaque cours de la catégorie -->
                        <div class="col-lg-4 responsive-column-half">
                            <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1{{ $course->id }}">
                                <div class="card-image">
                                    <!-- Image du cours avec lien vers les détails -->
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                                        <img class="card-img-top lazy" src="{{ asset($course->course_image) }}"
                                            data-src="{{ asset($course->course_image) }}" alt="Image du cours">
                                    </a>
                                </div><!-- Fin de la zone d'image -->
                                <div class="card-body">
                                    <!-- Étiquette spécifique au cours -->
                                    <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">{{ $course->label }}</h6>
                                    <!-- Titre du cours avec lien vers les détails -->
                                    <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                                    <!-- Nom de l'instructeur avec lien vers son profil -->
                                    <p class="card-text"><a href="{{ route('instructor.details', $course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
                                    <!-- Zone pour la note moyenne (dynamique pour cohérence) -->
                                    <div class="py-2 rating-wrap d-flex align-items-center">
                                        @php
                                        $reviewCount = App\Models\Review::where('course_id', $course->id)->where('status', 1)->latest()->get();
                                        $avarage = App\Models\Review::where('course_id', $course->id)->where('status', 1)->avg('rating');
                                        @endphp
                                        <div class="review-stars">
                                            <!-- Affiche la note moyenne arrondie -->
                                            <span class="rating-number">{{ round($avarage, 1) }}</span>
                                            @if ($avarage == 0)
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 1 || $avarage < 2)
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 2 || $avarage < 3)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 3 || $avarage < 4)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 4 || $avarage < 5)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 5)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            @endif
                                        </div>
                                        <!-- Nombre total d'évaluations -->
                                        <span class="pl-1 rating-total">({{ count($reviewCount) }} évaluations)</span>
                                    </div><!-- Fin de la zone de notation -->
                                    <!-- Zone pour le prix et l'icône de liste de souhaits -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($course->discount_price == NULL)
                                        <!-- Prix standard sans réduction -->
                                        <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</p>
                                        @else
                                        <!-- Prix réduit avec prix original barré -->
                                        <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->discount_price }} <span
                                         class="before-price font-weight-medium">{{ $setting->currency }}{{ $course->selling_price }}</span></p>
                                        @endif
                                        <!-- Bouton pour ajouter à la liste de souhaits -->
                                        <div class="shadow-sm cursor-pointer icon-element icon-element-sm"
                                            title="Ajouter à la liste de souhaits"><i class="la la-heart-o"></i></div>
                                    </div>
                                </div><!-- Fin du corps de la carte -->
                            </div><!-- Fin de la carte -->
                        </div><!-- Fin de la colonne -->
                        @empty
                        <!-- Message si aucun cours n'est trouvé -->
                        <h5 class="text-danger">Aucun cours trouvé</h5>
                        @endforelse
                    </div><!-- Fin de la grille -->
                </div><!-- Fin de l'onglet de catégorie -->
                @endforeach
            </div><!-- Fin du contenu des onglets -->
            <!-- Bouton pour voir tous les cours -->
            <div class="mt-4 text-center more-btn-box">
                <a href="{{ url('/all/courses') }}" class="btn theme-btn">Voir tous les cours <i
                        class="ml-1 la la-arrow-right icon"></i></a>
            </div><!-- Fin du bouton -->
        </div><!-- Fin du conteneur -->
    </div><!-- Fin du conteneur de contenu -->
</section><!-- Fin de la section des cours -->

@php
    $categoryWiseCourse = App\Models\Course::get();
@endphp

<!-- Infobulles pour les détails des cours -->
@foreach ($categoryWiseCourse as $course)
<div class="tooltip_templates">
    <div id="tooltip_content_1{{ $course->id }}">
        <div class="card card-item">
            <div class="card-body">
                <!-- Nom de l'instructeur -->
                <p class="pb-2 card-text">Par <a href="{{ route('instructor.details', $course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
                <!-- Titre du cours -->
                <h5 class="pb-1 card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                <!-- Badges et date de mise à jour -->
                <div class="pb-1 d-flex align-items-center">
                    @if ($course->bestseller == 1)
                    <!-- Indique un cours très vendu -->
                    <h6 class="mr-2 ribbon fs-14">Meilleure vente</h6>
                    @endif
                    @if ($course->highestrated == 1)
                    <!-- Indique un cours bien noté -->
                    <h6 class="mr-2 ribbon fs-14">Mieux noté</h6>
                    @endif
                    @if ($course->featured == 1)
                    <!-- Indique un cours mis en avant -->
                    <h6 class="mr-2 ribbon fs-14">En vedette</h6>
                    @endif
                    <!-- Date de mise à jour du cours -->
                    <p class="text-success fs-14 font-weight-medium">Mis à jour <span
                            class="pl-1 font-weight-bold">{{ $course->created_at->format('M d Y') }}</span></p>
                </div>
                <!-- Informations sur la durée et l'étiquette -->
                <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                    <li>{{ $course->duration }} heures au total</li>
                    <li>{{ $course->label }}</li>
                </ul>
                <!-- Prérequis du cours -->
                <p class="pt-1 card-text fs-14 lh-22">{{ $course->prerequisites }}</p>
                @php
                    $goals = App\Models\Course_goal::where('course_id', $course->id)->orderBy('id', 'desc')->get();
                @endphp
                <!-- Liste des objectifs du cours -->
                <ul class="py-3 generic-list-item fs-14">
                    @foreach ($goals as $goal)
                    <li><i class="mr-1 text-black la la-check"></i>{{ $goal->goal_name }}</li>
                    @endforeach
                </ul>
                <!-- Boutons pour ajouter au panier et à la liste de souhaits -->
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Bouton pour ajouter au panier -->
                    @if(!$user || $user->role == 'user')
                    <button type="submit" class="mr-3 btn theme-btn flex-grow-1" onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')">
                        <i class="mr-1 la la-shopping-cart fs-18"></i>
                        Ajouter au panier
                    </button>
                    @endif
                    <!-- Bouton pour ajouter à la liste de souhaits -->
                    <div class="shadow-sm cursor-pointer icon-element icon-element-sm" title="Ajouter à la liste de souhaits" id="{{ $course->id }}" onclick="addToWishList(this.id)">
                        <i class="la la-heart-o"></i>
                    </div>
                </div>
            </div>
        </div><!-- Fin de la carte -->
    </div>
</div><!-- Fin de l'infobulle -->
@endforeach