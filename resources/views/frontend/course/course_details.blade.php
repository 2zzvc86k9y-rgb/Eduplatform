@extends('frontend.master')
@section('home')

@section('title')
{{ $course->course_name }} | EduPlatform
@endsection

{{-- php blog pour changer le symbole de la devise.... --}}
@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<!-- ================================
    DÉBUT DE LA ZONE DE FIL D'ARIANE
================================= -->
<section class="bg-white breadcrumb-area pt-50px pb-50px pattern-bg">
    <div class="container">
        <div class="mr-auto col-lg-8">
            <div class="breadcrumb-content">
                <ul class="flex-wrap generic-list-item generic-list-item-arrow d-flex align-items-center">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li><a href="">{{ $course['category']['category_name'] }}</a></li>
                    <li><a href="">{{ $course['subcategory']['subcategory_name'] }}</a></li>
                </ul>
                <div class="section-heading">
                    <h2 class="section__title">{{ $course->course_name }}</h2>
                    <p class="pt-2 section__desc lh-30">{{ $course->course_title }}</p>
                </div><!-- fin section-heading -->
                <div class="flex-wrap pt-3 d-flex align-items-center">
                    @if ($course->bestseller == 1)
                    <h6 class="mr-2 text-white ribbon ribbon-lg bg-3">Meilleure vente</h6>
                        @else
                    @endif

                    @php
                        $reviewCount = App\Models\Review::where('course_id', $course->id)->where('status', 1)->latest()->get();
                        $avarage = App\Models\Review::where('course_id', $course->id)->where('status', 1)->avg('rating');
                    @endphp
                    <div class="flex-wrap rating-wrap d-flex align-items-center">


                        <div class="review-stars">
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


                        <span class="pl-1 rating-total">({{ count( $reviewCount) }} évaluations)</span>
                        @php
                            $enrollmentCount = App\Models\Order::where('course_id', $course->id)->count();
                        @endphp
                        <span class="pl-2 student-total">{{  number_format($enrollmentCount) }} étudiants</span>
                    </div>
                </div><!-- fin d-flex -->


                <p class="pt-2 pb-1">Créé par <a href="teacher-detail.html" class="text-color hover-underline">{{ $course['user']['name'] }}</a></p>



                <div class="flex-wrap d-flex align-items-center">
                    <p class="pr-3 d-flex align-items-center">
                        <svg class="mr-1 svg-icon-color-gray" width="16px" viewBox="0 0 24 24"><path d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
                        Dernière mise à jour {{ $course->created_at->format('M D Y') }}
                    </p>
                    <p class="pr-3 d-flex align-items-center">
                        <svg class="mr-1 svg-icon-color-gray" width="16px" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95a15.65 15.65 0 00-1.38-3.56A8.03 8.03 0 0118.92 8zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2s.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56A7.987 7.987 0 015.08 16zm2.95-8H5.08a7.987 7.987 0 014.33-3.56A15.65 15.65 0 008.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2s.07-1.35.16-2h4.68c.09.65.16 1.32.16 2s-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95a8.03 8.03 0 01-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2s-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"></path></svg>
                        Français
                    </p>
                </div><!-- fin d-flex -->
                <div class="pt-3 bread-btn-box">
                    <button class="mb-2 mr-2 btn theme-btn theme-btn-sm theme-btn-transparent lh-28">
                        <i class="mr-1 la la-heart-o"></i>
                        <span class="swapping-btn" data-text-swap="Ajouté aux favoris" data-text-original="Liste de souhaits" id="{{$course->id}}" onclick="addToWishList(this.id)">Liste de souhaits</span>
                    </button>
                    <button class="mb-2 mr-2 btn theme-btn theme-btn-sm theme-btn-transparent lh-28" data-toggle="modal" data-target="#shareModal">
                        <i class="mr-1 la la-share"></i>Partager
                    </button>
                    <button class="mb-2 btn theme-btn theme-btn-sm theme-btn-transparent lh-28" data-toggle="modal" data-target="#reportModal">
                        <i class="mr-1 la la-flag"></i>Signaler un abus
                    </button>
                </div>
            </div><!-- fin breadcrumb-content -->
        </div><!-- fin col-lg-8 -->
    </div><!-- fin container -->
</section><!-- fin breadcrumb-area -->
<!-- ================================
    FIN DE LA ZONE DE FIL D'ARIANE
================================= -->

<!--======================================
        DÉBUT DE LA ZONE DE DÉTAILS DU COURS
======================================-->
<section class="course-details-area pb-20px">
    <div class="container">
        <div class="row">
           <div class="pb-5 col-lg-8">
               <div class="course-details-content-wrap pt-90px">
                   <div class="p-4 rounded course-overview-card bg-gray">
                       <h3 class="pb-3 fs-24 font-weight-semi-bold">Qu'allez-vous apprendre ?</h3>
                       <ul class="generic-list-item overview-list-item">
                        @foreach ($goals as $goal)
                        <li><i class="mr-1 text-black la la-check"></i>{{ $goal->goal_name }}</li>
                        @endforeach
                       </ul>
                   </div><!-- fin course-overview-card -->
                   <div class="p-4 rounded course-overview-card bg-gray">
                       <h3 class="fs-16 font-weight-semi-bold">Sélectionné pour la collection <a href="for-business.html" class="text-color hover-underline">EduPlatform pour les Entreprises</a></h3>
                   </div><!-- fin course-overview-card -->
                   <div class="course-overview-card">
                       <h3 class="pb-3 fs-24 font-weight-semi-bold">Prérequis</h3>
                       <ul class="generic-list-item generic-list-item-bullet fs-15">
                           <li>{{ $course->prerequisites }}</li>
                       </ul>
                   </div><!-- fin course-overview-card -->
                    <div class="p-4 border rounded course-overview-card border-gray">
                       <h3 class="fs-20 font-weight-semi-bold">Les meilleures entreprises font confiance à EduPlatform</h3>
                       <p class="pb-1 fs-15">Donnez à votre équipe l'accès aux meilleurs 5 000+ cours d'EduPlatform</p>
                        <div class="pb-3">
                            <img width="85" class="mr-3" src="{{ asset('frontend/images/sponsor-img.png') }}" alt="logo entreprise">
                            <img width="80" class="mr-3" src="{{ asset('frontend/images/sponsor-img2.png') }}" alt="logo entreprise">
                            <img width="80" class="mr-3" src="{{ asset('frontend/images/sponsor-img3.png') }}" alt="logo entreprise">
                            <img width="70" class="mr-3" src="{{ asset('frontend/images/sponsor-img4.png') }}" alt="logo entreprise">
                        </div>
                        <a href="for-business.html" class="btn theme-btn theme-btn-sm">Essayer EduPlatform pour les Entreprises</a>
                   </div><!-- fin course-overview-card -->
                   <div class="course-overview-card">
                       <h3 class="pb-3 fs-24 font-weight-semi-bold">Description</h3>
                       <p class="pb-2 fs-15">{{ $course->description }}</p>
                   </div><!-- fin course-overview-card -->

@php
    $lecture = App\Models\CourseLecture::where('course_id', $course->id)->get();
@endphp

                   <div class="course-overview-card">
                       <div class="pb-4 curriculum-header d-flex align-items-center justify-content-between">
                           <h3 class="fs-24 font-weight-semi-bold">Contenu du cours</h3>
                           <div class="curriculum-duration fs-15">
                               <span class="mr-2 curriculum-total__text"><strong class="text-black font-weight-semi-bold">Total :</strong> {{ count($lecture) }} leçons</span>
                               <span class="curriculum-total__hours"><strong class="text-black font-weight-semi-bold">Durée totale :</strong> {{ $course->duration }}</span>
                           </div>
                       </div>

                       @php
                           $sections = App\Models\CourseSection::where('course_id', $course->id)->orderBy('id','asc')->get();
                       @endphp

                       <div class="curriculum-content">
                           <div id="accordion" class="generic-accordion">
                            @foreach ($sections as $section)

                            @php
                                $lectures = App\Models\CourseLecture::where('section_id', $section->id)->get();
                            @endphp
                               <div class="card">
                                   <div class="card-header" id="heading{{ $section->id }}">
                                       <button class="btn btn-link d-flex align-items-center justify-content-between" data-toggle="collapse" data-target="#collapse{{ $section->id }}" aria-expanded="true" aria-controls="collapse{{ $section->id }}">
                                           <i class="la la-plus"></i>
                                           <i class="la la-minus"></i>
                                           {{ $section->section_title }}
                                           <span class="fs-15 text-gray font-weight-medium">{{ count($lectures) }} leçons</span>
                                       </button>
                                   </div><!-- fin card-header -->

                                   <div id="collapse{{ $section->id }}" class="collapse " aria-labelledby="heading{{ $section->id }}" data-parent="#accordion">
                                       <div class="card-body">
                                           <ul class="generic-list-item">

                                            @foreach ($lectures as $lecture)

                                            <li>
                                                <a href="#" class="d-flex align-items-center justify-content-between text-color" data-toggle="modal" data-target="#previewModal">
                                                    <span>
                                                        <i class="mr-1 la la-play-circle"></i>
                                                        {{ $lecture->lecture_title }}

                                                    </span>
                                                    <span>02:27</span>
                                                </a>
                                            </li>
                                            @endforeach

                                           </ul>
                                       </div><!-- fin card-body -->
                                   </div><!-- fin collapse -->
                               </div><!-- fin card -->
                             @endforeach
                           </div><!-- fin generic-accordion -->
                       </div><!-- fin curriculum-content -->
                   </div><!-- fin course-overview-card -->

                   @php
                       $quizzes = App\Models\Quiz::where('course_id', $course->id)->where('is_active', true)->get();
                   @endphp

                   <div class="course-overview-card">
                       <div class="pb-4 curriculum-header d-flex align-items-center justify-content-between">
                           <h3 class="fs-24 font-weight-semi-bold">Quiz du cours</h3>
                           <div class="curriculum-duration fs-15">
                               <span class="mr-2 curriculum-total__text"><strong class="text-black font-weight-semi-bold">Total :</strong> {{ count($quizzes) }} quiz</span>
                           </div>
                       </div>

                       <div class="curriculum-content">
                           @if(count($quizzes) > 0)
                               <div class="table-responsive">
                                   <table class="table">
                                       <thead>
                                           <tr>
                                               <th>Titre</th>
                                               <th>Questions</th>
                                               <th>Durée</th>
                                               <th>Score minimum</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           @foreach($quizzes as $quiz)
                                               <tr>
                                                   <td>{{ $quiz->title }}</td>
                                                   <td>{{ $quiz->questions->count() }}</td>
                                                   <td>{{ $quiz->duration }} minutes</td>
                                                   <td>{{ $quiz->passing_score }}%</td>
                                                   <td>
                                                       @auth
                                                           @if(auth()->user()->hasEnrolled($course->id))
                                                               <a href="{{ route('start.quiz', [$course->id, $quiz->id]) }}" class="btn btn-sm btn-primary">Commencer</a>
                                                           @else
                                                               <span class="text-muted">Inscrivez-vous pour accéder</span>
                                                           @endif
                                                       @else
                                                           <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Connectez-vous</a>
                                                       @endauth
                                                   </td>
                                               </tr>
                                           @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           @else
                               <p class="text-muted">Aucun quiz disponible pour ce cours.</p>
                           @endif
                       </div>
                   </div><!-- fin course-overview-card -->

                   <div class="pt-4 course-overview-card">
                       <h3 class="pb-4 fs-24 font-weight-semi-bold">À propos de l'instructeur</h3>
                       <div class="instructor-wrap">
                           <div class="media media-card">
                               <div class="instructor-img">
                                   <a href="teacher-detail.html" class="media-img d-block">
                                       <img class="lazy" src="{{ !empty($course->user->photo) ? url('upload/instructor_image/' . $course->user->photo) : url('upload/noimage.jpg') }}" data-src="images/small-avatar-1.jpg" alt="Image avatar">
                                   </a>
                                   <ul class="pt-3 generic-list-item">
                                       <li><i class="mr-2 la la-star text-color-3"></i> 4.6 Note de l'instructeur</li>
                                       <li><i class="mr-2 la la-user text-color-3"></i> 45,786 Étudiants</li>
                                       <li><i class="mr-2 la la-comment-o text-color-3"></i> 2,533 Avis</li>
                                       <li><i class="mr-2 la la-play-circle-o text-color-3"></i> {{ count($instructorAllCourses) }} Cours</li>
                                       <li><a href="teacher-detail.html">Voir tous les cours</a></li>
                                   </ul>
                               </div><!-- fin instructor-img -->
                               <div class="media-body">
                                   <h5><a href="teacher-detail.html">{{ $course['user']['name'] }}</a></h5>
                                   <span class="pt-2 pb-3 d-block lh-18">Inscrit {{Carbon\Carbon::parse($course->user->created_at)->diffForHumans()  }} </span>
                                   <p class="pb-3 text-black lh-18">{{ $course['user']['email'] }}</p>
                                   <p class="pb-3">{{ $course['user']['shortdescription'] }}</p>
                                   <div class="collapse" id="collapseMoreTwo">
                                       <p class="pb-3">{{ $course['user']['longdescription'] }}</p>
                                       <p class="pb-3"><strong class="text-black font-weight-semi-bold">Les cours de {{ $course['user']['name'] }} sont parfaits pour commencer</strong>.</p>
                                   </div>
                                   <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMoreTwo" role="button" aria-expanded="false" aria-controls="collapseMoreTwo">
                                       <span class="collapse-btn-hide">Voir plus<i class="ml-1 la la-angle-down fs-14"></i></span>
                                       <span class="collapse-btn-show">Voir moins<i class="ml-1 la la-angle-up fs-14"></i></span>
                                   </a>
                               </div>
                           </div>
                       </div><!-- fin instructor-wrap -->
                   </div><!-- fin course-overview-card -->
                   <div class="pt-4 course-overview-card">
                       <h3 class="fs-24 font-weight-semi-bold pb-40px">Avis des étudiants</h3>
                       <div class="feedback-wrap">
                           <div class="media media-card align-items-center">
                               <div class="review-rating-summary">
                                    <span class="stats-average__count">{{ round($avarage,1) }}</span>
                                   <div class="pt-1 rating-wrap">
                                       <div class="review-stars">
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
                                       <span class="rating-total d-block">({{ count($reviewCount) }})</span>
                                       <span>Note du cours</span>
                                   </div><!-- fin rating-wrap -->
                               </div><!-- fin review-rating-summary -->

                    <div class="media-body">
                        @php
                            $reviewCount = App\Models\Review::where('course_id', $course->id)->where('status',1)->select('rating', DB::raw('count(*) as count'))->groupBy('rating')->orderBy('rating', 'desc')->get();

                            $totalReviews = $reviewCount->sum('count');

                            $percentage = [];

                            for ($i=5; $i >=1 ; $i--) {
                                $ratingCount = $reviewCount->where('rating',$i)->first();
                                $count = $ratingCount ? $ratingCount->count : 0;
                                $percent = $totalReviews > 0 ? ( $count / $totalReviews ) * 100 : 0;

                                $percentage[] = [
                                    'rating' => $i,
                                    'percent' => $percent,
                                    'count' => $count,
                            ];
                            }
                        @endphp

                        @if (count($percentage) > 0)
                            @foreach ($percentage as $ratingInfo)
                                <div class="mb-2 review-bars d-flex align-items-center">
                                    <div class="review-bars__text">{{ $ratingInfo['rating'] }} étoiles</div>
                                    <div class="review-bars__fill">
                                        <div class="skillbar-box">
                                            <div class="skillbar" data-percent="{{ $ratingInfo['percent'] }}%">
                                                <div class="skillbar-bar bg-3" style="width: {{ $ratingInfo['percent'] }}%;"></div>
                                            </div> <!-- Fin Skill Bar -->
                                        </div>
                                    </div><!-- fin review-bars__fill -->
                                    <div class="review-bars__percent">{{ number_Format($ratingInfo['percent'],2) }}%</div>
                                </div><!-- fin review-bars -->
                            @endforeach
                            @else
                            <p>Aucune évaluation disponible</p>
                        @endif

                    </div><!-- fin media-body -->
                           </div>
                       </div><!-- fin feedback-wrap -->
                   </div><!-- fin course-overview-card -->
                   <div class="pt-4 course-overview-card">
                       <h3 class="pb-4 fs-24 font-weight-semi-bold">Avis</h3>
                       <div class="review-wrap">
                           <div class="flex-wrap pb-4 d-flex align-items-center">
                               <form method="post" class="mr-3 flex-grow-1">
                                   <div class="form-group">
                                       <input class="pl-3 form-control form--control" type="text" name="search" placeholder="Rechercher des avis">
                                       <span class="la la-search search-icon"></span>
                                   </div>
                               </form>
                               <div class="mb-3 select-container">
                                   <select class="select-container-select">
                                       <option value="all-rating">Toutes les notes</option>
                                       <option value="five-star">Cinq étoiles</option>
                                       <option value="four-star">Quatre étoiles</option>
                                       <option value="three-star">Trois étoiles</option>
                                       <option value="two-star">Deux étoiles</option>
                                       <option value="one-star">Une étoile</option>
                                   </select>
                               </div>
                           </div>

                           @php
                               $reviews = App\Models\Review::where('course_id', $course->id)->where('status', 1)->latest()->limit(5)->get();
                           @endphp
                        @foreach ($reviews as $item)

                           <div class="pb-4 mb-4 media media-card border-bottom border-bottom-gray">
                               <div class="mr-4 rounded-full media-img">
                                   <img class="rounded-full lazy" src="{{ !empty($item->user->photo) ? url('upload/user_image/' . $item->user->photo) : url('upload/noimage.jpg') }}" data-src="images/small-avatar-1.jpg" alt="Image utilisateur">
                               </div>

                               <div class="media-body">
                                   <div class="flex-wrap pb-1 d-flex align-items-center justify-content-between">
                                       <h5>{{ $item->user->name }}</h5>
                                       <div class="review-stars">
                                        @if ($item->rating == null)
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 1)
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 2)
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 3)
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 4)
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                        @elseif ($item->rating == 5)
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        @endif
                                       </div>
                                   </div>
                                   <span class="pb-2 d-block lh-18">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                   <p class="pb-2">{{ $item->comment }}</p>
                                   <div class="helpful-action">
                                       <span class="d-block fs-13">Cette évaluation vous a-t-elle été utile ?</span>
                                       <button class="btn">Oui</button>
                                       <button class="btn">Non</button>
                                       <span class="pl-1 cursor-pointer btn-text fs-14" data-toggle="modal" data-target="#reportModal">Signaler</span>
                                   </div>
                               </div>
                           </div><!-- end media -->
                           @endforeach

                       </div><!-- end review-wrap -->
                       <div class="text-center see-more-review-btn">
                           <button type="button" class="btn theme-btn theme-btn-transparent">Voir plus d'avis</button>
                       </div>
                   </div><!-- end course-overview-card -->

{{-- ========================Partie d'ajout d'avis - uniquement les utilisateurs authentifiés peuvent soumettre un avis =============== --}}

                @guest
                    <div class="px-2 py-4 text-center" style="background:#e6e6e6;">
                        <h2>Souhaitez-vous donner votre avis sur le cours...</h2>
                        <p><b> <br> Vous devez d'abord vous connecter. <a href="{{route('login')}}">Cliquez ici</a>
                        </b></p>
                    </div>
                @else
                     <div class="pt-4 course-overview-card">
                       <h3 class="pb-4 fs-24 font-weight-semi-bold">Ajouter un avis</h3>
                       <form method="POST" action="{{route('store.review')}}" class="row">
                        @csrf
                            <div class="pb-4 leave-rating-wrap">
                                <div class="leave-rating leave--rating">
                                    <input type="radio" name='rate' id="star5" value="5" />
                                    <label for="star5"></label>
                                    <input type="radio" name='rate' id="star4" value="4" />
                                    <label for="star4"></label>
                                    <input type="radio" name='rate' id="star3" value="3" />
                                    <label for="star3"></label>
                                    <input type="radio" name='rate' id="star2" value="2" />
                                    <label for="star2"></label>
                                    <input type="radio" name='rate' id="star1" value="1" />
                                    <label for="star1"></label>
                                </div><!-- end leave-rating -->
                            </div>

                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="instructor_id" value="{{ $course->instructor_id }}">

                           <div class="input-box col-lg-12">
                               <label class="label-text">Message</label>
                               <div class="form-group">
                                   <textarea class="pl-3 form-control form--control" name="comment" placeholder="Écrivez votre message" rows="5"></textarea>
                               </div>
                           </div><!-- end input-box -->
                           <div class="btn-box col-lg-12">
                               <button class="btn theme-btn" type="submit">Soumettre l'avis</button>
                           </div><!-- end btn-box -->
                       </form>
                   </div><!-- end course-overview-card -->
                @endguest

               </div><!-- end course-details-content-wrap -->
           </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar sidebar-negative">
                    <div class="card card-item">
                        <div class="card-body">
                            <div class="preview-course-video">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal">
                                    <img src="{{ asset($course->course_image) }}" data-src="{{ asset($course->course_image) }}" alt="course-img" class="rounded w-100 lazy">
                                    <div class="preview-course-video-content">
                                        <div class="overlay"></div>
                                        <div class="play-button">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-307.4 338.8 91.8 91.8" style=" enable-background:new -307.4 338.8 91.8 91.8;" xml:space="preserve">
                                              <style type="text/css">
                                                  .st0{fill:#ffffff; border-radius: 100px;}
                                                  .st1{fill:#000000;}
                                              </style>
                                                <g>
                                                 <circle class="st0" cx="-261.5" cy="384.7" r="45.9"></circle><path class="st1" d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"></path>
                                             </g>
                                         </svg>
                                        </div>
                                        <p class="pt-3 text-white fs-15 font-weight-bold">Aperçu de ce cours</p>
                                    </div>
                                </a>
                            </div><!-- end preview-course-video -->

                            @php
                            $discount = $course->selling_price - $course->discount_price;
                            $discount_per = round($discount / $course->selling_price * 100);
                            @endphp

                            <div class="preview-course-feature-content pt-40px">
                                <p class="pb-2 d-flex align-items-center">
                                    @if ($course->discount_price == NULL)
                                    <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</p>
                                    <span class="mx-1 before-price">{{ $setting->currency }}{{ $course->selling_price }}</span>
                                    @else
                                    <span class="text-black fs-35 font-weight-semi-bold">{{ $setting->currency }}{{ $course->discount_price }}</span>
                                    <span class="mx-1 before-price">{{ $setting->currency }}{{ $course->selling_price }}</span>
                                    @endif

                                    @if ($course->discount_price == NULL)
                                    <div class="course-badge blue">Nouveau</div>
                                    @else
                                    <span class="price-discount">{{ $discount_per }}% de réduction</span>
                                    @endif
                                </p>
                                <p class="preview-price-discount-text pb-35px">
                                    <span class="text-color-3">4 jours</span> restants à ce prix !
                                </p>
                                <div class="buy-course-btn-box">
 {{-- Code d'ajout au panier  --}}
                                    <button type="submit" class="mb-2 btn theme-btn w-100" onclick="addToCart({{$course->id}},'{{$course->course_name}}','{{$course->instructor_id}}','{{$course->course_name_slug}}')"><i class="mr-1 la la-shopping-cart fs-18"></i> Ajouter au panier</button>
 {{-- Code d'achat de ce cours   --}}
                                    <button type="submit" class="mb-2 btn theme-btn w-100 theme-btn-white" onclick="buyThisCourse({{$course->id}},'{{$course->course_name}}','{{$course->instructor_id}}','{{$course->course_name_slug}}')"><i class="mr-1 la la-shopping-bag"></i> Acheter ce cours</button>

                                </div>

                                <p class="pb-4 text-center fs-14">Garantie de remboursement sous 30 jours</p>
                                <div class="preview-course-incentives">
                                    <h3 class="pb-2 card-title fs-18">Ce cours comprend</h3>
                                    <ul class="pb-3 generic-list-item">
                                        <li><i class="mr-2 la la-play-circle-o text-color"></i>{{ $course->duration }} heures de vidéo à la demande</li>
                                        <li><i class="mr-2 la la-file text-color"></i>{{ $course->resources }} articles</li>
                                        <li><i class="mr-2 la la-file-text text-color"></i>{{ $course->resources }} ressources téléchargeables</li>
                                        <li><i class="mr-2 la la-code text-color"></i>51 exercices de codage</li>
                                        <li><i class="mr-2 la la-key text-color"></i>Accès à vie complet</li>
                                        <li><i class="mr-2 la la-television text-color"></i>Accès sur mobile et TV</li>
                                        <li><i class="mr-2 la la-certificate text-color"></i>Certificat de réalisation</li>
                                    </ul>
                                    <div class="section-block"></div>
                                </div><!-- end preview-course-incentives -->
                            </div>
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Caractéristiques du cours</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-flash">
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-clock text-color"></i>Durée</span> {{ $course->duration }} heures</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-play-circle-o text-color"></i>Leçons</span> </li>
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-file-text-o text-color"></i>Ressources</span> {{ $course->resources }}</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-bolt text-color"></i>Quiz</span> 26</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-eye text-color"></i>Leçons en aperçu</span> 4</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-language text-color"></i>Langue</span> Anglais</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-lightbulb text-color"></i>Niveau de compétence</span> {{ $course->label }}</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-users text-color"></i>Étudiants</span> 30,506</li>
                                <li class="d-flex align-items-center justify-content-between"><span><i class="mr-2 la la-certificate text-color"></i>Certificat</span> {{ $course->certificate }}</li>
                            </ul>
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
                            <h3 class="pb-2 card-title fs-18">Cours similaires</h3>
                            <div class="divider"><span></span></div>
                            @foreach ($relatedCourses as $course)
                            @endforeach
                            <div class="pb-4 mb-4 media media-card border-bottom border-bottom-gray">
                                <a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}" class="media-img">
                                    <img class="mr-3 lazy" src="{{ asset($course->course_image) }}" data-src="{{ asset($course->course_image) }}" alt="Image du cours similaire">
                                </a>
                                <div class="media-body">
                                    <h5 class="fs-15"><a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}">{{ $course->course_name }}</a></h5>
                                    <span class="py-1 d-block lh-18 fs-14">{{ $course['user']['name'] }}</span>
                                    @if ($course->discount_price == NULL)
                                    <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</p>
                                    @else
                                    <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->discount_price }} <span
                                     class="before-price font-weight-medium">{{ $setting->currency }}{{ $course->selling_price }}</span></p>
                                    @endif
                                </div>
                            </div><!-- end media -->

                            <div class="view-all-course-btn-box">
                                <a href="course-grid.html" class="btn theme-btn w-100">Voir tous les cours <i class="ml-1 la la-arrow-right icon"></i></a>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div><!-- end sidebar -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end course-details-area -->
<!--======================================
        FIN DE LA ZONE DE DÉTAILS DU COURS
======================================-->

<!--======================================
        DÉBUT DE LA ZONE DES COURS SIMILAIRES
======================================-->
<section class="related-course-area bg-gray pt-60px pb-60px">
    <div class="container">
        <div class="related-course-wrap">
            <h3 class="fs-28 font-weight-semi-bold pb-35px">Plus de cours par <a href="{{ route('instructor.details',$course->instructor_id) }}" class="text-color hover-underline">{{ $course['user']['name'] }}</a></h3>
            <div class="view-more-carousel-2 owl-action-styled">
                @foreach ($instructorAllCourses as $course)
                <div class="card card-item">
                    <div class="card-image">
                        <a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}" class="d-block">
                            <img class="card-img-top" src="{{asset($course->course_image)}}" alt="Image du cours">
                        </a>
                        <div class="course-badge-labels">
                            @if ($course->bestseller == 1)
                            <div class="course-badge">Meilleure vente</div>
                                @else
                            @endif
                            @if ($course->featured == 1)
                            <div class="course-badge sky-blue">En vedette</div>
                                @else
                            @endif
                            @if ($course->highestrated == 1)
                            <div class="course-badge blue">Note la plus élevée</div>
                                @else
                            @endif

                            @php
                            $discount = $course->selling_price - $course->discount_price;
                            $discount_per = round($discount / $course->selling_price * 100);
                        @endphp
                            <div class="course-badge blue">-{{ $discount_per }}%</div>
                        </div>
                    </div><!-- end card-image -->
                    <div class="card-body">
                        <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">{{ $course->label }}</h6>
                        <h5 class="card-title"><a href="{{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}">{{ $course->course_name }}</a></h5>
                        <p class="card-text"><a href="teacher-detail.html">{{ $course['user']['name'] }}</a></p>
                        <div class="py-2 rating-wrap d-flex align-items-center">

                                    @php
                                        $reviewCount = App\Models\Review::where('course_id', $course->id)->where('status', 1)->latest()->get();
                                        $avarage = App\Models\Review::where('course_id', $course->id)->where('status', 1)->avg('rating');
                                    @endphp

                            <div class="review-stars">
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
                                            @elseif ($avarage == 2 || $avarage < 3)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star-o"></span>
                                            <span class="la la-star-o"></span>
                                            @elseif ($avarage == 3 || $avarage < 4)
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
                                            <span class="la la-star"></span>
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

                            <span class="pl-1 rating-total">({{ count( $reviewCount) }} notes)</span>
                        </div><!-- end rating-wrap -->
                        <div class="d-flex justify-content-between align-items-center">
                            @if ($course->discount_price == NULL)
                            <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</p>
                            @else
                            <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->discount_price }} <span
                             class="before-price font-weight-medium">{{ $setting->currency }}{{ $course->selling_price }}</span></p>
                            @endif
                            <div class="shadow-sm cursor-pointer icon-element icon-element-sm" title="Ajouter à la liste de souhaits"><i class="la la-heart-o"></i></div>
                        </div>
                    </div><!-- end card-body -->
                </div><!-- end card -->

                @endforeach

            </div><!-- end view-more-carousel -->
        </div><!-- end related-course-wrap -->
    </div><!-- end container -->
</section><!-- end related-course-area -->
<!--======================================
        FIN DE LA ZONE DES COURS SIMILAIRES
======================================-->

<!--======================================
        DÉBUT DE LA ZONE CTA
======================================-->
<section class="overflow-hidden cta-area pt-60px pb-60px position-relative">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="flex-wrap py-4 cta-content-wrap d-flex align-items-center">
                    <svg class="flex-shrink-0 mr-4" width="70" viewBox="0 -48 496 496" xmlns="http://www.w3.org/2000/svg"><path d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0"></path><path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"></path><path d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0"></path><path d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0"></path><path d="m152 288h16v80h-16zm0 0"></path><path d="m120 288h16v80h-16zm0 0"></path><path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"></path></svg>
                    <div class="section-heading">
                        <h2 class="mb-1 section__title fs-22">Devenez Enseignant, Partagez votre savoir</h2>
                        <p class="section__desc">Créez un cours vidéo en ligne, atteignez des étudiants du monde entier et gagnez de l'argent</p>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="text-right cta-btn-box">
                    <a href="{{ route('become.instructor') }}" class="btn theme-btn">Postuler pour devenir enseignant <i class="ml-1 la la-arrow-right icon"></i> </a>
                </div>
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end cta-area -->
<!--======================================
        FIN DE LA ZONE CTA
======================================-->

<!-- Modal -->
<div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">Partager ce cours</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <div class="copy-to-clipboard">
                    <span class="success-message">Copié !</span>
                    <div class="input-group">
                        <input type="text" class="pl-3 form-control form--control copy-input" value="http://127.0.0.1:8000/{{ Request::path() }}">
                        <div class="input-group-append">
                            <button class="shadow-none btn theme-btn theme-btn-sm copy-btn"><i class="mr-1 la la-copy"></i> Copier</button>
                        </div>
                    </div>
                </div><!-- end copy-to-clipboard -->
            </div><!-- end modal-body -->
            <div class="modal-footer justify-content-center border-top-gray">
                <ul class="social-icons social-icons-styled">
                    <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                    <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                    <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                </ul>
            </div><!-- end modal-footer -->
        </div><!-- end modal-content-->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<!-- Modal -->
<div class="modal fade modal-container" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <p class="pb-2 font-weight-semi-bold">Aperçu du cours</p>
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="previewModalTitle">{{ $course->course_name }}</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <video controls crossorigin playsinline poster="{{ asset($course->course_image) }}" id="player" style="width: 100%;">
                    <source src="{{ asset($course->video) }}" type="video/mp4">
                    <source src="{{ asset($course->video) }}" type="video/webm">
                    <source src="{{ asset($course->video) }}" type="video/ogg">
                    <p class="text-danger">Votre navigateur ne prend pas en charge la lecture de vidéos. Veuillez utiliser un navigateur moderne comme Chrome, Firefox ou Edge.</p>
                </video>
                <div id="videoError" class="alert alert-danger d-none">
                    Une erreur est survenue lors de la lecture de la vidéo. Veuillez vérifier que le fichier est valide et réessayer.
                </div>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('player');
    const errorDiv = document.getElementById('videoError');
    
    video.addEventListener('error', function(e) {
        errorDiv.classList.remove('d-none');
        console.error('Erreur de lecture vidéo:', video.error);
    });
    
    video.addEventListener('loadeddata', function() {
        errorDiv.classList.add('d-none');
    });
});
</script>

<!-- Modal -->
<div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-gray">
                <div class="pr-2">
                    <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Signaler un abus</h5>
                    <p class="pt-1 fs-14 lh-24">Le contenu signalé est examiné par le personnel d'EduPlatform pour déterminer s'il viole les Conditions d'utilisation ou les Règles de la communauté. Si vous avez une question ou un problème technique, veuillez contacter notre
                        <a href="contact.html" class="text-color hover-underline">équipe de support ici</a>.</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-times"></span>
                </button>
            </div><!-- end modal-header -->
            <div class="modal-body">
                <form method="post">
                    <div class="input-box">
                        <label class="label-text">Sélectionnez le type de signalement</label>
                        <div class="form-group">
                            <div class="w-auto select-container">
                                <select class="select-container-select">
                                    <option value>-- Sélectionnez un --</option>
                                    <option value="1">Contenu de cours inapproprié</option>
                                    <option value="2">Comportement inapproprié</option>
                                    <option value="3">Violation de la politique d'EduPlatform</option>
                                    <option value="4">Contenu spam</option>
                                    <option value="5">Autre</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-box">
                        <label class="label-text">Écrivez votre message</label>
                        <div class="form-group">
                            <textarea class="pl-3 form-control form--control" name="message" placeholder="Fournissez des détails supplémentaires ici..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="pt-2 text-right btn-box">
                        <button type="button" class="mr-3 btn font-weight-medium" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Soumettre <i class="ml-1 la la-arrow-right icon"></i></button>
                    </div>
                </form>
            </div><!-- end modal-body -->
        </div><!-- end modal-content -->
    </div><!-- end modal-dialog -->
</div><!-- end modal -->

@endsection
