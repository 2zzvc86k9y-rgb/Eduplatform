@extends('frontend.master')
@section('home')
@section('title')
{{ $category->category_name }} | EduPlatform
@endsection
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="flex-wrap breadcrumb-content d-flex align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="text-white section__title">{{ $category->category_name }}</h2>
            </div>
            <ul class="flex-wrap generic-list-item generic-list-item-white generic-list-item-arrow d-flex align-items-center">
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li>{{ $category->category_name }}</li>
            </ul>
        </div><!-- end breadcrumb-content -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE AREA
======================================-->
<section class="course-area section--padding">
    <div class="container">
        <div class="mb-4 filter-bar">
            <div class="flex-wrap filter-bar-inner d-flex align-items-center justify-content-between">
                <p class="fs-14">Nous avons trouvé <span class="text-black">{{ count($courses) }}</span> cours disponibles pour vous</p>
                <div class="flex-wrap d-flex align-items-center">
                    <ul class="mr-3 filter-nav">
                        <li><a href="course-grid.html" data-toggle="tooltip" data-placement="top" title="Vue en grille" class="active"><span class="la la-th-large"></span></a></li>
                        <li><a href="course-list.html" data-toggle="tooltip" data-placement="top" title="Vue en liste"><span class="la la-list"></span></a></li>
                    </ul>
                    <div class="select-container select--container">
                        <select class="select-container-select">
                            <option value="all-category">Toutes les catégories</option>
                            <option value="newest">Cours les plus récents</option>
                            <option value="oldest">Cours les plus anciens</option>
                            <option value="high-rated">Meilleures notes</option>
                            <option value="popular-courses">Cours populaires</option>
                            <option value="high-to-low">Prix : du plus élevé au plus bas</option>
                            <option value="low-to-high">Prix : du plus bas au plus élevé</option>
                        </select>
                    </div>
                </div>
            </div><!-- end filter-bar-inner -->
        </div><!-- end filter-bar -->
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-5 sidebar">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Rechercher</h3>
                            <div class="divider"><span></span></div>
                            <form method="post">
                                <div class="mb-0 form-group">
                                    <input class="pl-3 form-control form--control" type="text" name="search" placeholder="Rechercher des cours">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Catégories de cours</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                                @foreach ($categories as $category)
                                <li><a href="{{ url('category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Notes</h3>
                            <div class="divider"><span></span></div>
                            <div class="mb-1 custom-control custom-radio fs-15">
                                <input type="radio" class="custom-control-input" id="fiveStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="fiveStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                         <span class="review-stars">
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                         </span>
                                       <span class="pl-1 rating-total"><span class="mr-1 text-black">5.0</span>(20,230)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-radio fs-15">
                                <input type="radio" class="custom-control-input" id="fourStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="fourStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                         <span class="review-stars">
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                             <span class="la la-star"></span>
                                         </span>
                                       <span class="pl-1 rating-total"><span class="mr-1 text-black">4.5 et plus</span>(10,230)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-radio fs-15">
                                <input type="radio" class="custom-control-input" id="threeStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="threeStarRating">
                                    <span class="rating-wrap d-flex align-items-center">
                                        <span class="review-stars">
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                        </span>
                                        <span class="pl-1 rating-total"><span class="mr-1 text-black">3.0 et plus</span>(7,230)</span>
                                    </span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-radio fs-15">
                                <input type="radio" class="custom-control-input" id="twoStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="twoStarRating">
                                   <span class="rating-wrap d-flex align-items-center">
                                       <span class="review-stars">
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                           <span class="la la-star"></span>
                                       </span>
                                       <span class="pl-1 rating-total"><span class="mr-1 text-black">2.0 et plus</span>(5,230)</span>
                                   </span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-radio fs-15">
                                <input type="radio" class="custom-control-input" id="oneStarRating" name="radio-stacked" required>
                                <label class="custom-control-label custom--control-label" for="oneStarRating">
                                    <span class="rating-wrap d-flex align-items-center">
                                        <span class="review-stars">
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                        </span>
                                        <span class="pl-1 rating-total"><span class="mr-1 text-black">1.0 et plus</span>(3,230)</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Catégories</h3>
                            <div class="divider"><span></span></div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="catCheckbox" required>
                                <label class="text-black custom-control-label custom--control-label" for="catCheckbox">
                                    Business<span class="ml-1 text-gray">(12,300)</span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="catCheckbox2" required>
                                <label class="text-black custom-control-label custom--control-label" for="catCheckbox2">
                                    UI & UX<span class="ml-1 text-gray">(12,300)</span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="catCheckbox3" required>
                                <label class="text-black custom-control-label custom--control-label" for="catCheckbox3">
                                    Animation<span class="ml-1 text-gray">(12,300)</span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="catCheckbox4" required>
                                <label class="text-black custom-control-label custom--control-label" for="catCheckbox4">
                                    Game Design<span class="ml-1 text-gray">(12,300)</span>
                                </label>
                            </div>
                            <div class="collapse" id="collapseMore">
                                <div class="mb-1 custom-control custom-checkbox fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox5" required>
                                    <label class="text-black custom-control-label custom--control-label" for="catCheckbox5">
                                        Design Graphique<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div>
                                <div class="mb-1 custom-control custom-checkbox fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox6" required>
                                    <label class="text-black custom-control-label custom--control-label" for="catCheckbox6">
                                        Typographie<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div>
                                <div class="mb-1 custom-control custom-checkbox fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox7" required>
                                    <label class="text-black custom-control-label custom--control-label" for="catCheckbox7">
                                        Développement Web<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div>
                                <div class="mb-1 custom-control custom-checkbox fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox8" required>
                                    <label class="text-black custom-control-label custom--control-label" for="catCheckbox8">
                                        Photographie<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div>
                                <div class="mb-1 custom-control custom-checkbox fs-15">
                                    <input type="checkbox" class="custom-control-input" id="catCheckbox9" required>
                                    <label class="text-black custom-control-label custom--control-label" for="catCheckbox9">
                                        Finance<span class="ml-1 text-gray">(12,300)</span>
                                    </label>
                                </div>
                            </div>
                            <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMore" role="button" aria-expanded="false" aria-controls="collapseMore">
                                <span class="collapse-btn-hide">Afficher plus<i class="ml-1 la la-angle-down fs-14"></i></span>
                                <span class="collapse-btn-show">Afficher moins<i class="ml-1 la la-angle-up fs-14"></i></span>
                            </a>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Niveau</h3>
                            <div class="divider"><span></span></div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="levelCheckbox" required>
                                <label class="text-black custom-control-label custom--control-label" for="levelCheckbox">
                                    Tous niveaux<span class="ml-1 text-gray">(20,300)</span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="levelCheckbox2" required>
                                <label class="text-black custom-control-label custom--control-label" for="levelCheckbox2">
                                    Débutant<span class="ml-1 text-gray">(5,300)</span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="levelCheckbox3" required>
                                <label class="text-black custom-control-label custom--control-label" for="levelCheckbox3">
                                    Intermédiaire<span class="ml-1 text-gray">(3,300)</span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="levelCheckbox4" required>
                                <label class="text-black custom-control-label custom--control-label" for="levelCheckbox4">
                                    Expert<span class="ml-1 text-gray">(1,300)</span>
                                </label>
                            </div>
                        </div>
                    </div><!-- end card -->

                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Prix</h3>
                            <div class="divider"><span></span></div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="priceCheckbox" required>
                                <label class="text-black custom-control-label custom--control-label" for="priceCheckbox">
                                    Payant<span class="ml-1 text-gray">(19,300)</span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="priceCheckbox2" required>
                                <label class="text-black custom-control-label custom--control-label" for="priceCheckbox2">
                                    Gratuit<span class="ml-1 text-gray">(1,300)</span>
                                </label>
                            </div>
                            <div class="mb-1 custom-control custom-checkbox fs-15">
                                <input type="checkbox" class="custom-control-input" id="priceCheckbox3" required>
                                <label class="text-black custom-control-label custom--control-label" for="priceCheckbox3">
                                    Tous<span class="ml-1 text-gray">(20,300)</span>
                                </label>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-8">
                <div class="row">
                    @foreach ($courses as $course)
                    <div class="col-lg-6 responsive-column-half">
                        <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1">
                            <div class="card-image">
                                <a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}" class="d-block">
                                    <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
                                </a>
                                <div class="course-badge-labels">
                                    @if ($course->bestseller == 1)
                                        <div class="course-badge">Meilleure vente</div>
                                    @endif
                                    @if ($course->highestrated == 1)
                                        <div class="course-badge sky-blue">Mieux noté</div>
                                    @endif
                                    @if ($course->featured == 1)
                                        <div class="course-badge">Mis en avant</div>
                                    @endif

                                    @php
                                        $discount = $course->selling_price - $course->discount_price;
                                        $discount_per = round($discount / $course->selling_price * 100);
                                    @endphp
                                    @if ($course->discount_price == NULL)
                                        <div class="course-badge blue">Nouveau</div>
                                    @else
                                        <div class="course-badge blue">-{{ $discount_per }}%</div>
                                    @endif
                                </div>
                            </div><!-- end card-image -->
                            <div class="card-body">
                                <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">{{ $course->label }}</h6>
                                <h5 class="card-title"><a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}">{{ $course->course_name }}</a></h5>
                                <p class="card-text"><a href="teacher-detail.html">{{ $course['user']['name'] }}</a></p>
                                <div class="py-2 rating-wrap d-flex align-items-center">
                                    <div class="review-stars">
                                        <span class="rating-number">4.4</span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                    </div>
                                    <span class="pl-1 rating-total">(20,230)</span>
                                </div><!-- end rating-wrap -->
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($course->discount_price == NULL)
                                        <p class="text-black card-price font-weight-bold">{{ $course->selling_price }}€</p>
                                    @else
                                        <p class="text-black card-price font-weight-bold">{{ $course->discount_price }}€ <span class="before-price font-weight-medium">{{ $course->selling_price }}€</span></p>
                                    @endif
                                    <div class="shadow-sm cursor-pointer icon-element icon-element-sm" title="Ajouter aux favoris" id="{{$course->id}}" onclick="addToWishList(this.id)"><i class="la la-heart-o"></i></div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-6 -->
                    @endforeach
                </div><!-- end row -->
                <div class="pt-3 text-center">
                    <nav aria-label="Navigation des pages" class="pagination-box">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Précédent">
                                    <span aria-hidden="true"><i class="la la-arrow-left"></i></span>
                                    <span class="sr-only">Précédent</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Suivant">
                                    <span aria-hidden="true"><i class="la la-arrow-right"></i></span>
                                    <span class="sr-only">Suivant</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="pt-2 fs-14">Affichage de 1-10 sur 56 résultats</p>
                </div>
            </div><!-- end col-lg-8 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->
@endsection
