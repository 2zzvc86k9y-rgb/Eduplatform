@php
    $courses = App\Models\Course::where('status',1)->where('featured',1)->orderBy('id','ASC')->limit(6)->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
    $setting = App\Models\SiteSetting::find(1);
@endphp

<!-- Section "Cours" de la page, traduite directement en français avec commentaires -->
<section class="course-area pb-90px">
    <!-- Conteneur principal des cours -->
    <div class="course-wrapper">
        <div class="container">
            <!-- En-tête centré de la section -->
            <div class="text-center section-heading">
                <!-- Ruban/titre secondaire, traduit de "Learn on your schedule" à "Apprenez à votre rythme" -->
                <!-- Le style "ribbon ribbon-lg" applique un design de ruban -->
                <h5 class="mb-2 ribbon ribbon-lg">Apprenez à votre rythme</h5>
                <!-- Titre principal, traduit de "Students are viewing" à "Cours populaires sur EduPlatform" -->
                <!-- Intègre EduPlatform pour personnaliser -->
                <h2 class="section__title">Cours populaires sur EduPlatform</h2>
                <!-- Séparateur visuel, inchangé -->
                <span class="section-divider"></span>
            </div><!-- Fin de l'en-tête de section -->
            <!-- Carrousel des cours, utilisant Owl Carousel -->
            <div class="course-carousel owl-action-styled owl--action-styled mt-30px">
                @foreach ($courses as $course)
                <!-- Carte pour chaque cours avec infobulle -->
                <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_3">
                    <div class="card-image">
                        <!-- Lien vers les détails du cours, image dynamique -->
                        <!-- Texte alternatif traduit de "Card image cap" à "Image du cours" -->
                        <a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}" class="d-block">
                            <img class="card-img-top" src="{{ asset($course->course_image) }}" alt="Image du cours">
                        </a>
                        <div class="course-badge-labels">
                            @if ($course->bestseller == 1)
                            <!-- Badge traduit de "Bestseller" à "Meilleure vente" -->
                            <div class="course-badge">Meilleure vente</div>
                            @else
                            @endif
                            @if ($course->highestrated == 1)
                            <!-- Badge traduit de "Highestrated" à "Mieux noté" -->
                            <div class="course-badge sky-blue">Mieux noté</div>
                            @else
                            @endif
                            @if ($course->featured == 1)
                            <!-- Badge traduit de "Featured" à "En vedette" -->
                            <div class="course-badge">En vedette</div>
                            @else
                            @endif
                            @php
                                $discount = $course->selling_price - $course->discount_price;
                                $discount_per = round($discount / $course->selling_price * 100);
                            @endphp
                            @if ($course->discount_price == NULL)
                            <!-- Badge traduit de "New" à "Nouveau" -->
                            <div class="course-badge blue">Nouveau</div>
                            @else
                            <!-- Pourcentage de réduction, inchangé mais contextualisé -->
                            <div class="course-badge blue">-{{ $discount_per }}%</div>
                            @endif
                        </div>
                    </div><!-- Fin de l'image de la carte -->
                    <div class="card-body">
                        <!-- Étiquette du cours, dynamique, inchangée car gérée par la base -->
                        <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">{{ $course->label }}</h6>
                        <!-- Titre du cours, dynamique, inchangé car géré par la base -->
                        <h5 class="card-title"><a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}">{{ $course->course_name }}</a></h5>
                        <!-- Nom de l'instructeur, dynamique, inchangé -->
                        <p class="card-text"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
                        <!-- Conteneur pour la note et les avis -->
                        <div class="py-2 rating-wrap d-flex align-items-center">
                            @php
                            $reviewCount = App\Models\Review::where('course_id', $course->id)->where('status', 1)->latest()->get();
                            $avarage = App\Models\Review::where('course_id', $course->id)->where('status', 1)->avg('rating');
                            @endphp
                            <div class="review-stars">
                                <!-- Note moyenne arrondie -->
                                <span class="rating-number">{{ round($avarage,1) }}</span>
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
                                @elseif ($avarage == 5 || $avarage < 5)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                @endif
                            </div>
                            <!-- Nombre d'évaluations, traduit de "ratings" à "évaluations" -->
                            <span class="pl-1 rating-total">({{ count($reviewCount) }} évaluations)</span>
                        </div><!-- Fin du conteneur des notes -->
                        <!-- Conteneur pour le prix et la liste de souhaits -->
                        <div class="d-flex justify-content-between align-items-center">
                            @if ($course->discount_price == NULL)
                            <!-- Prix sans réduction -->
                            <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</p>
                            @else
                            <!-- Prix avec réduction, "before-price" inchangé car c'est une classe CSS -->
                            <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->discount_price }} <span
                             class="before-price font-weight-medium">{{ $setting->currency }}{{ $course->selling_price }}</span></p>
                            @endif
                            <!-- Bouton pour ajouter à la liste de souhaits -->
                            <!-- Titre traduit de "Add to Wishlist" à "Ajouter à la liste de souhaits" -->
                            <div class="shadow-sm cursor-pointer icon-element icon-element-sm"
                                 title="Ajouter à la liste de souhaits" id="{{$course->id}}" onclick="addToWishList(this.id)"><i class="la la-heart-o"></i>
                            </div>
                        </div>
                    </div><!-- Fin du corps de la carte -->
                </div><!-- Fin de la carte -->
                @endforeach
            </div><!-- Fin du carrousel des cours -->
        </div><!-- Fin du conteneur -->
    </div><!-- Fin du conteneur principal -->
</section><!-- Fin de la section "Cours" -->