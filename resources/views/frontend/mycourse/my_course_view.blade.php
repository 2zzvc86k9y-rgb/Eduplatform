@include('frontend.mycourse.body.header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<body>

    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->

    <!--======================================
        START HEADER AREA
    ======================================-->
    <section class="header-menu-area">
        <div class="header-menu-content bg-dark">
            <div class="container-fluid">
                <div class="main-menu-content d-flex align-items-center">
                    @php
                        $setting = App\Models\SiteSetting::first();
                    @endphp
                    <div class="logo-box logo--box d-flex align-items-center">
                        <a href="{{ route('index') }}" class="logo mr-3">
                            <img src="{{ asset($setting->logo) }}" alt="Logo EduPlatform" style="height:90px;max-width:174px;object-fit:contain;">
                        </a>
                        <div class="theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Mode sombre">
                                <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Mode clair">
                                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                    </div><!-- end logo-box -->
                    <div class="pl-4 course-dashboard-header-title">
                        <a href="#" class="text-white fs-15">{{ $course->course->course_name }}</a>
                    </div><!-- end course-dashboard-header-title -->
                    <div class="ml-auto menu-wrapper">
                        <div class="mr-3 theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Mode sombre">
                                <svg class="svg-icon-color-white" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Mode clair">
                                <svg viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="nav-right-button d-flex align-items-center">
                            <a href="{{ route('dashboard') }}" class="mr-2 text-white btn theme-btn theme-btn-sm theme-btn-transparent lh-26">
                                <i class="mr-1 la la-dashboard"></i> Tableau de bord
                            </a>
                            <a href="#"
                                class="mr-2 text-white btn theme-btn theme-btn-sm theme-btn-transparent lh-26"
                                data-toggle="modal" data-target="#ratingModal"><i class="mr-1 la la-star"></i> Laisser une note</a>
                            <a href="#"
                                class="mr-2 text-white btn theme-btn theme-btn-sm theme-btn-transparent lh-26"
                                data-toggle="modal" data-target="#shareModal"><i class="mr-1 la la-share"></i>
                                Partager</a>
                            <div class="generic-action-wrap generic--action-wrap">
                                <div class="dropdown">
                                    <a class="action-btn" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Ajouter ce cours aux favoris</a>
                                        <a class="dropdown-item" href="#">Archiver ce cours</a>
                                        <a class="dropdown-item" href="#">Offrir ce cours</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end nav-right-button -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
    </section><!-- end header-menu-area -->
    <!--======================================
        END HEADER AREA
======================================-->

    <!--======================================
        START COURSE-DASHBOARD
======================================-->
    <section class="container-fluid course-dashboard">
        <div class="course-dashboard-wrap">
            <div class="course-dashboard-container d-flex">
                <div class="course-dashboard-column">



                    <div class="lecture-viewer-container">
                        <div class="lecture-video-item">
                            <iframe width="100%" height="500" id="videoContainer" src=""

                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                            <div id="textLesson" class="pb-2 mt-4 text-center fs-24 font-weight-semi-bold">
                                <h3></h3>
                            </div>
                            <div id="mark-complete-btn-container"></div>
                            <div id="lesson-status-message"></div>
                        </div>
                    </div><!-- end lecture-viewer-container -->






                    <div class="lecture-video-detail">
                        <div class="p-4 lecture-tab-body bg-gray">
                            <ul class="nav nav-tabs generic-tab" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="search-tab" data-toggle="tab" href="#search"
                                        role="tab" aria-controls="search" aria-selected="false">
                                        <i class="la la-search"></i>
                                    </a>
                                </li>
                                <li class="nav-item mobile-menu-nav-item">
                                    <a class="nav-link" id="course-content-tab" data-toggle="tab"
                                        href="#course-content" role="tab" aria-controls="course-content"
                                        aria-selected="false">
                                        Contenu du cours
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview"
                                        role="tab" aria-controls="overview" aria-selected="true">
                                        Aperçu
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="question-and-ans-tab" data-toggle="tab"
                                        href="#question-and-ans" role="tab" aria-controls="question-and-ans"
                                        aria-selected="false">
                                        Questions & Réponses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="announcements-tab" data-toggle="tab"
                                        href="#announcements" role="tab" aria-controls="announcements"
                                        aria-selected="false">
                                        Annonces
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="lecture-video-detail-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade" id="search" role="tabpanel"
                                    aria-labelledby="search-tab">
                                    <div class="search-course-wrap pt-40px">
                                        <form action="#" class="pb-5">
                                            <div class="input-group">
                                                <input class="pl-3 form-control form--control form--control-gray"
                                                    type="text" name="search"
                                                    placeholder="Rechercher dans le contenu du cours">
                                                <div class="input-group-append">
                                                    <button class="btn theme-btn"><span
                                                            class="la la-search"></span></button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="text-center search-results-message">
                                            <h3 class="pb-1 fs-24 font-weight-semi-bold">Lancer une nouvelle recherche</h3>
                                            <p>Pour trouver des sous-titres, des leçons ou des ressources</p>
                                        </div>
                                    </div><!-- end search-course-wrap -->
                                </div><!-- end tab-pane -->
                                <div class="tab-pane fade" id="course-content" role="tabpanel"
                                    aria-labelledby="course-content-tab">
                                    <div class="pt-4 mobile-course-menu">
                                        <div class="accordion generic-accordion generic--accordion"
                                            id="mobileCourseAccordionCourseExample">
                                            <div class="card">
                                                <div class="card-header" id="mobileCourseHeadingOne">
                                                    <button class="btn btn-link" type="button"
                                                        data-toggle="collapse" data-target="#mobileCourseCollapseOne"
                                                        aria-expanded="true" aria-controls="mobileCourseCollapseOne">
                                                        <i class="la la-angle-down"></i>
                                                        <i class="la la-angle-up"></i>
                                                        <span class="fs-15"> Section 1 : Plongez dans After Effects et découvrez-le</span>
                                                        <span class="course-duration">
                                                            <span>1/5</span>
                                                            <span>21min</span>
                                                        </span>
                                                    </button>
                                                </div><!-- end card-header -->


                                            </div><!-- end card -->





                                        </div><!-- end accordion-->
                                    </div><!-- end mobile-course-menu -->
                                </div><!-- end tab-pane -->




                                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                    aria-labelledby="overview-tab">
                                    <div class="lecture-overview-wrap">
                                        <div class="lecture-overview-item">
                                            <h3 class="pb-2 fs-24 font-weight-semi-bold">À propos de ce cours</h3>
                                            <p>{{ $course->course->course_title }}</p>
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="pb-2 fs-16 font-weight-semi-bold">En chiffres</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div class="lecture-overview-stats-item">
                                                    <ul class="generic-list-item">
                                                        <li><span>Niveau de compétence :</span>{{ $course->course->label }}</li>
                                                        <li><span>Étudiants :</span>83950</li>
                                                        <li><span>Langues :</span>Français</li>
                                                        <li><span>Sous-titres :</span>Oui</li>
                                                    </ul>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div class="lecture-overview-stats-item">
                                                    <ul class="generic-list-item">
                                                        <li><span>Ressources :</span>{{ $course->course->resources }}</li>
                                                        <li><span>Durée des vidéos :</span>{{ $course->course->duration }}
                                                            heures au total</li>
                                                        <li><span>Certificat :</span>{{ $course->course->certificate }}
                                                        </li>
                                                    </ul>
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="pb-2 fs-16 font-weight-semi-bold">Certificats</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div
                                                    class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                    <p class="pb-3">Obtenez un certificat EduPlatform en terminant l'ensemble du cours
                                                    </p>
                                                    <a href="#"
                                                        class="btn theme-btn theme-btn-transparent">Certificat EduPlatform</a>
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="pb-2 fs-16 font-weight-semi-bold">Fonctionnalités</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div class="lecture-overview-stats-item">
                                                    <p>Disponible sur <a href="#"
                                                            class="text-color hover-underline">iOS</a> et <a
                                                            href="#"
                                                            class="text-color hover-underline">Android</a></p>
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="pb-2 fs-16 font-weight-semi-bold">Description</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div
                                                    class="lecture-overview-stats-item lecture-overview-stats-wide-item lecture-description">
                                                    <h3 class="pb-2 fs-16 font-weight-semi-bold">Par l'auteur du cours complet After Effects CC 2020 le plus vendu</h3>
                                                    <p>{{ $course->course->description }}</p>



                                                    <div class="collapse" id="collapseMore">
                                                        <p>Ce cours complet vous permettra de maîtriser After Effects CC 2020 de A à Z. Que vous soyez débutant ou que vous ayez déjà quelques bases, vous apprendrez à créer des animations professionnelles et des effets visuels impressionnants.</p>
                                                        <ul class="generic-list-item generic-list-item-bullet">
                                                            <li>Vous découvrirez l'interface et les outils essentiels du logiciel</li>
                                                            <li>Vous apprendrez les techniques d'animation avancées</li>
                                                            <li>Vous maîtriserez les effets visuels et les transitions</li>
                                                            <li>Vous saurez créer des compositions complexes</li>
                                                            <li>Vous pourrez réaliser des projets professionnels</li>
                                                        </ul>
                                                        <p>Le cours est structuré de manière progressive, avec des exercices pratiques à chaque étape. Vous aurez accès à tous les fichiers sources et pourrez suivre pas à pas la création de projets concrets. J'ai mis l'accent sur les techniques les plus demandées dans l'industrie, pour vous permettre de répondre aux besoins du marché.</p>
                                                        <p>En plus des vidéos de formation, vous bénéficierez d'un support personnalisé. Je répondrai à toutes vos questions et vous accompagnerai tout au long de votre apprentissage. Mon objectif est que vous deveniez autonome et que vous puissiez créer vos propres animations professionnelles.</p>
                                                        <p>À très bientôt dans le cours !</p>
                                                        <p>Alexandre</p>

                                                        <h3 class="pb-2 fs-16 font-weight-semi-bold">Ce que vous apprendrez
                                                        </h3>

                                                        @foreach ($course->course->coursegoals as $item)
                                                            <ul class="generic-list-item generic-list-item-bullet">
                                                                <li>{{ $item->goal_name }}</li>
                                                            </ul>
                                                        @endforeach




                                                    </div>


                                                    <div class="show-more-btn-box">
                                                        <a class="collapse-btn collapse--btn fs-15"
                                                            data-toggle="collapse" href="#collapseMore"
                                                            role="button" aria-expanded="false"
                                                            aria-controls="collapseMore">
                                                            <span class="collapse-btn-hide">Lire plus<i
                                                                    class="ml-1 la la-angle-down fs-14"></i></span>
                                                            <span class="collapse-btn-show">Lire moins<i
                                                                    class="ml-1 la la-angle-up fs-14"></i></span>
                                                        </a>
                                                    </div><!-- end show-more-btn-box -->
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex ">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="pb-2 fs-16 font-weight-semi-bold">Instructeur</h3>
                                                </div><!-- end lecture-overview-stats-item -->
                                                <div
                                                    class="lecture-overview-stats-item lecture-overview-stats-wide-item">


                                                    {{-- image is not show here try to fix but can't --}}


                                                    <div class="media media-card align-items-center">
                                                        <a href="teacher-detail.html"
                                                            class="rounded-full media-img d-block avatar-md">
                                                            <img src="{{ !empty($course->course->instructor->photo) ? url('upload/instructor_image/' . $course->course->instructor->photo) : url('upload/noimage.jpg') }}"
                                                                alt="Avatar de l'instructeur" class="rounded-full">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5><a
                                                                    href="teacher-detail.html">{{ $course->course->instructor->name }}</a>
                                                            </h5>
                                                            <span
                                                                class="pt-2 d-block lh-18">{{ $course->course->instructor->email }}</span>
                                                        </div>
                                                    </div>


                                                    <div class="pt-4 lecture-owner-profile">
                                                        <ul class="social-icons social-icons-styled">
                                                            <li><a href="{{ $course->course->instructor->facebook }}"
                                                                    class="facebook-bg"><i
                                                                        class="la la-facebook"></i></a></li>
                                                            <li><a href="{{ $course->course->instructor->twitter }}"
                                                                    class="twitter-bg"><i
                                                                        class="la la-twitter"></i></a></li>
                                                            <li><a href="{{ $course->course->instructor->instagram }}"
                                                                    class="instagram-bg"><i
                                                                        class="la la-instagram"></i></a></li>
                                                            <li><a href="{{ $course->course->instructor->linkedin }}"
                                                                    class="linkedin-bg"><i
                                                                        class="la la-linkedin"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="pt-4 lecture-owner-decription">
                                                        <p>{{ $course->course->instructor->shortdescription }}</p>
                                                        <p>{{ $course->course->instructor->longdescription }}</p>
                                                    </div>
                                                </div><!-- end lecture-overview-stats-item -->
                                            </div><!-- end lecture-overview-stats-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                    </div><!-- end lecture-overview-wrap -->
                                </div><!-- end tab-pane -->





                                <div class="tab-pane fade" id="question-and-ans" role="tabpanel"
                                    aria-labelledby="question-and-ans-tab">
                                    <div class="lecture-overview-wrap lecture-quest-wrap">
                                        <div class="new-question-wrap">
                                            <button class="btn theme-btn theme-btn-transparent back-to-question-btn"><i
                                                    class="mr-1 la la-reply"></i>Retour à toutes les questions</button>
                                            <div class="new-question-body pt-40px">
                                                <h3 class="fs-20 font-weight-semi-bold">Ma question concerne</h3>








                                                <form method="POST" action="{{ route('user.question') }}" class="pt-4">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{$course->course_id}}">
                                                    <input type="hidden" name="instructor_id" value="{{$course->instructor_id}}">

                                                    <div class="custom-control-wrap">
                                                        <div class="pl-0 mb-3 custom-control custom-radio">
                                                           <input type="text" name="subject" class="pl-3 form-control form--control " placeholder="Écrivez le sujet de votre question...">
                                                        </div>
                                                        <div class="pl-0 mb-3 custom-control custom-radio">
                                                            <textarea class="pl-3 form-control form--control"  name="question" rows="4" placeholder="Écrivez votre réponse..."></textarea>
                                                        </div>




                                                    </div>
                                                    <div class="text-center btn-box">
                                                        <button type="submit" class="btn theme-btn w-100">Soumettre la question <i
                                                                class="ml-1 la la-arrow-right icon"></i></button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div><!-- end new-question-wrap -->









                                        <div class="question-overview-result-wrap">

                                            <div class="lecture-overview-item">
                                                <div
                                                    class="question-overview-result-header d-flex align-items-center justify-content-between">
                                                    <h3 class="fs-17 font-weight-semi-bold">
                                                        {{ count($allQuestion) }} questions dans ce cours
                                                    </h3>
                                                    <button
                                                        class="btn theme-btn theme-btn-sm theme-btn-transparent ask-new-question-btn">Poser une nouvelle question</button>
                                                </div>
                                            </div><!-- end lecture-overview-item -->










                                            <div class="section-block"></div>
                                            <div class="mt-0 lecture-overview-item">
                                                <div class="question-list-item">


@php
    $id = Auth::user()->id;
    $questions = App\Models\Question::where('user_id', $id)->where('course_id',$course->course->id)->where('parent',null)->orderBy('id','asc')->get();
@endphp

                                                    @foreach ( $questions as  $question)
                                                        <div
                                                            class="px-3 py-4 media media-card border-bottom border-bottom-gray">
                                                            <div class="flex-shrink-0 rounded-full media-img avatar-sm">
                                                                <img class="rounded-full" src="{{ !empty($question->user->photo) ? url('upload/user_image/' . $question->user->photo) : url('upload/noimage.jpg') }}"
                                                                    alt="Image utilisateur">
                                                            </div>
                                                            <div class="media-body">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <div class="question-meta-content">
                                                                        <a href="javascript:void(0)" class="d-block">
                                                                            <h5 class="pb-1 fs-16">{{$question->subject}}</h5>
                                                                            <p class="text-truncate fs-15 text-gray">
                                                                               {{$question->question}}
                                                                            </p>
                                                                        </a>
                                                                    </div><!-- end question-meta-content -->
                                                                    
                                                                </div>
                                                                <p class="pt-1 meta-tags fs-13">
                                                                    <span>{{ Carbon\Carbon::parse($question->created_at)->diffForHumans() }}</span>
                                                                </p>
                                                            </div><!-- end media-body -->
                                                        </div><!-- end media -->


                                                        {{-- replay this media  --}}
                                                        @php
                                                            $replys = App\Models\Question::where('parent',$question->id)->orderBy('id','asc')->get();
                                                        @endphp


                                                        @foreach ($replys as $reply)
                                                        <div
                                                            class="px-3 py-4 media media-card border-bottom border-bottom-gray" style="background: #e6e6e6">
                                                            <div class="flex-shrink-0 rounded-full media-img avatar-sm">
                                                                <img class="rounded-full" src="{{ !empty($reply->instructor->photo) ? url('upload/instructor_image/' . $reply->instructor->photo) : url('upload/noimage.jpg') }}"
                                                                    alt="Image utilisateur">
                                                            </div>
                                                            <div class="media-body">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <div class="question-meta-content">
                                                                        <a href="javascript:void(0)" class="d-block">
                                                                            <h5 class="pb-1 fs-16">{{$reply->instructor->name}}</h5>
                                                                            <p class="text-truncate fs-15 text-gray">
                                                                               {{$reply->question}}
                                                                            </p>
                                                                        </a>
                                                                    </div><!-- end question-meta-content -->
                                                                  
                                                                </div>
                                                                <p class="pt-1 meta-tags fs-13">
                                                                    <span>{{ Carbon\Carbon::parse($question->created_at)->diffForHumans() }}</span>
                                                                </p>
                                                            </div><!-- end media-body -->
                                                        </div><!-- end media -->
                                                        @endforeach

                                                    @endforeach


                                                </div>













                                                <div class="text-center question-btn-box pt-35px">
                                                    <button class="btn theme-btn theme-btn-transparent w-100"
                                                        type="button">Voir plus</button>
                                                </div>
                                            </div><!-- end lecture-overview-item -->
                                        </div>
                                    </div>
                                </div><!-- end tab-pane -->
                                <div class="tab-pane fade" id="announcements" role="tabpanel"
                                    aria-labelledby="announcements-tab">
                                    <div class="lecture-overview-wrap lecture-announcement-wrap">
                                        <div class="lecture-overview-item">
                                            <div class="media media-card align-items-center">
                                                <a href="teacher-detail.html"
                                                    class="rounded-full media-img d-block avatar-md">
                                                    <img src="{{ asset('frontend/images/small-avatar-1.jpg') }}" alt="Avatar de l'instructeur"
                                                        class="rounded-full">
                                                </a>
                                                <div class="media-body">
                                                    <h5 class="pb-1"><a href="teacher-detail.html">Alex Smith</a>
                                                    </h5>
                                                    <div class="announcement-meta fs-15">
                                                        <span>A publié une annonce</span>
                                                        <span> · Il y a 3 ans ·</span>
                                                        <a href="#" class="btn-text" data-toggle="modal"
                                                            data-target="#reportModal" title="Signaler un abus"><i
                                                                class="la la-flag"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-4 lecture-owner-decription ">
                                                <h3 class="pb-3 fs-19 font-weight-semi-bold">Support important pour les questions et réponses</h3>
                                                <p>Joyeuse année 2019 à tous, merci d'être étudiant et pour tout votre
                                                    soutien.</p>
                                                <p><strong>Excellent travail pour votre inscription et vos progrès actuels dans le cours. Je
                                                        vous encourage à continuer à poursuivre vos rêves :)</strong></p>
                                                <p>Tout le contenu. Dans mon cours After Effects Complete Course, rempli
                                                    de toutes les techniques et méthodes (pas de trucs ni gadgets).</p>
                                                <p class="font-italic"><strong>Malheureusement, cela entraînera des
                                                        réponses tardives de ma part dans la section Questions & Réponses et aux messages
                                                        directs. Ceci est valable uniquement pour la semaine prochaine et une fois de retour, je serai
                                                        de nouveau à 100% .</strong></p>
                                                <p>Je continuerai à faire de mon mieux pour répondre à autant de questions que
                                                    possible, mais étant seul, je passe régulièrement 4 à 5 heures par jour sur
                                                    cela et avec plus de 440 000 étudiants, vous pouvez imaginer que c'est beaucoup
                                                    de travail.</p>
                                                <p class="font-italic">Merci encore pour votre compréhension et
                                                    pour tous les merveilleux étudiants avec lesquels j'ai eu l'occasion de
                                                    communiquer régulièrement et pour tous vos encouragements.</p>
                                                <p>Passez une excellente journée</p>
                                                <p>Alex</p>
                                            </div>
                                            <div class="pt-4 lecture-announcement-comment-wrap">
                                                <div class="media media-card align-items-center">
                                                    <div class="flex-shrink-0 rounded-full media-img avatar-sm">
                                                        <img src="{{ asset('frontend/images/small-avatar-1.jpg') }}" alt="Avatar de l'instructeur"
                                                            class="rounded-full">
                                                    </div><!-- end media-img -->
                                                    <div class="media-body">
                                                        <form action="#">
                                                            <div class="input-group">
                                                                <input
                                                                    class="pl-3 form-control form--control form--control-gray"
                                                                    type="text" name="search"
                                                                    placeholder="Entrez votre commentaire">
                                                                <div class="input-group-append">
                                                                    <button class="btn theme-btn" type="button"><i
                                                                            class="la la-arrow-right"></i></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div><!-- end media-body -->
                                                </div><!-- end media -->
                                                <div class="comments pt-40px">
                                                    <div
                                                        class="pb-3 mb-3 media media-card border-bottom border-bottom-gray">
                                                        <div class="flex-shrink-0 rounded-full media-img avatar-sm">
                                                            <img src="{{ asset('frontend/images/small-avatar-2.jpg') }}"
                                                                alt="Avatar de l'instructeur" class="rounded-full">
                                                        </div><!-- end media-img -->
                                                        <div class="media-body">
                                                            <div class="announcement-meta fs-15 lh-20">
                                                                <a href="#" class="text-color">Tony Olsson</a>
                                                                <span> · Il y a 3 ans ·</span>
                                                                <a href="#" class="btn-text"
                                                                    data-toggle="modal" data-target="#reportModal"
                                                                    title="Signaler un abus"><i
                                                                        class="la la-flag"></i></a>
                                                            </div>
                                                            <p class="pt-1">Occaecati cupiditate non provident,
                                                                similique sunt in culpa fuga.</p>
                                                        </div><!-- end media-body -->
                                                    </div><!-- end media -->
                                                    <div
                                                        class="pb-3 mb-3 media media-card border-bottom border-bottom-gray">
                                                        <div class="flex-shrink-0 rounded-full media-img avatar-sm">
                                                            <img src="{{ asset('frontend/images/small-avatar-3.jpg') }}"
                                                                alt="Avatar de l'instructeur" class="rounded-full">
                                                        </div><!-- end media-img -->
                                                        <div class="media-body">
                                                            <div class="announcement-meta fs-15 lh-20">
                                                                <a href="#" class="text-color">Eduard-Dan</a>
                                                                <span> · Il y a 2 ans ·</span>
                                                                <a href="#" class="btn-text"
                                                                    data-toggle="modal" data-target="#reportModal"
                                                                    title="Signaler un abus"><i
                                                                        class="la la-flag"></i></a>
                                                            </div>
                                                            <p class="pt-1">Occaecati cupiditate non provident,
                                                                similique sunt in culpa fuga.</p>
                                                        </div><!-- end media-body -->
                                                    </div><!-- end media -->
                                                </div><!-- end comments -->
                                            </div><!-- end lecture-announcement-comment-wrap -->
                                        </div><!-- end lecture-overview-item -->
                                    </div>
                                </div><!-- end tab-pane -->
                            </div><!-- end tab-content -->
                        </div><!-- end lecture-video-detail-body -->
                    </div><!-- end lecture-video-detail -->






                    <div class="py-4 cta-area bg-gray">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="cta-content-wrap">
                                        <h3 class="fs-18 font-weight-semi-bold">Les grandes entreprises choisissent <a
                                                href="for-business.html" class="text-color hover-underline">EduPlatform pour Entreprises</a> pour développer des compétences professionnelles recherchées.</h3>
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="text-right client-logo-wrap">
                                        <a href="#" class="pr-3 client-logo-item client--logo-item-2"><img
                                                src="{{ asset('frontend/images/sponsor-img.png') }}"
                                                alt="Image de marque"></a>
                                        <a href="#" class="pr-3 client-logo-item client--logo-item-2"><img
                                                src="{{ asset('frontend/images/sponsor-img2.png') }}"
                                                alt="Image de marque"></a>
                                        <a href="#" class="pr-3 client-logo-item client--logo-item-2"><img
                                                src="{{ asset('frontend/images/sponsor-img3.png') }}"
                                                alt="Image de marque"></a>
                                    </div><!-- end client-logo-wrap -->
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                        </div><!-- end container-fluid -->
                    </div><!-- end cta-area -->
                    <div class="footer-area pt-50px">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 responsive-column-half">
                                    <div class="footer-item">
                                        <a href="#">
                                            <img src="{{ asset('frontend/images/logo-edu0.png') }}" alt="Logo du footer"
                                                class="footer__logo">
                                        </a>
                                        <ul class="pt-4 generic-list-item">
                                            <li><a href="tel:+1631237884">+163 123 7884</a></li>
                                            <li><a href="mailto:support@wbsite.com">support@eduplatform.com</a></li>
                                            <li>Melbourne, Australie, 105 South Park Avenue</li>
                                        </ul>
                                    </div><!-- end footer-item -->
                                </div><!-- end col-lg-3 -->
                                <div class="col-lg-3 responsive-column-half">
                                    <div class="footer-item">
                                        <h3 class="pb-3 fs-20 font-weight-semi-bold">Entreprise</h3>
                                        <ul class="generic-list-item">
                                            <li><a href="#">À propos de nous</a></li>
                                            <li><a href="#">Nous contacter</a></li>
                                            <li><a href="#">Devenir enseignant</a></li>
                                            <li><a href="#">Support</a></li>
                                            <li><a href="#">FAQ</a></li>
                                            <li><a href="#">Blog</a></li>
                                        </ul>
                                    </div><!-- end footer-item -->
                                </div><!-- end col-lg-3 -->
                                <div class="col-lg-3 responsive-column-half">
                                    <div class="footer-item">
                                        <h3 class="pb-3 fs-20 font-weight-semi-bold">Cours</h3>
                                        <ul class="generic-list-item">
                                            <li><a href="#">Développement web</a></li>
                                            <li><a href="#">Cybersécurité</a></li>
                                            <li><a href="#">Apprentissage PHP</a></li>
                                            <li><a href="#">Anglais parlé</a></li>
                                            <li><a href="#">Voiture autonome</a></li>
                                            <li><a href="#">Collecteurs de déchets</a></li>
                                        </ul>
                                    </div><!-- end footer-item -->
                                </div><!-- end col-lg-3 -->
                                <div class="col-lg-3 responsive-column-half">
                                    <div class="footer-item">
                                        <h3 class="pb-3 fs-20 font-weight-semi-bold">
                                            <i class='bx bx-download'></i> Télécharger l'application
                                        </h3>
                                        <div class="mobile-app">
                                            <p class="pb-3 lh-24">
                                                <i class='bx bx-smartphone'></i> Téléchargez notre application mobile et apprenez où que vous soyez.
                                            </p>
                                            <a href="#" class="mb-2 d-block hover-s btn-app-download">
                                                <i class='bx bxl-apple'></i> App Store
                                            </a>
                                            <a href="#" class="d-block hover-s btn-app-download">
                                                <i class='bx bxl-play-store'></i> Google Play
                                            </a>
                                        </div>
                                    </div><!-- end footer-item -->
                                </div><!-- end col-lg-3 -->
                            </div><!-- end row -->
                        </div><!-- end container-fluid -->
                        <div class="section-block"></div>
                        <div class="py-4 copyright-content">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <p class="copy-desc">© 2025EduPlatform. Tous droits réservés. par <a
                                                href="https://techydevs.com/">TechyDevs</a></p>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="flex-wrap d-flex align-items-center justify-content-end">
                                            <ul class="flex-wrap generic-list-item d-flex align-items-center fs-14">
                                                <li class="mr-3"><a href="terms-and-conditions.html">Conditions générales</a></li>
                                                <li class="mr-3"><a href="privacy-policy.html">Politique de confidentialité</a>
                                                </li>
                                            </ul>
                                            <div class="select-container select-container-sm">
                                                <select class="select-container-select">
                                                    <option value="1">Français</option>
                                                    <option value="2">Deutsch</option>
                                                    <option value="3">Español</option>
                                                    <option value="4">English</option>
                                                    <option value="5">Bahasa Indonesia</option>
                                                    <option value="6">Bangla</option>
                                                    <option value="7">日本語</option>
                                                    <option value="8">한국어</option>
                                                    <option value="9">Nederlands</option>
                                                    <option value="10">Polski</option>
                                                    <option value="11">Português</option>
                                                    <option value="12">Română</option>
                                                    <option value="13">Русский</option>
                                                    <option value="14">ภาษาไทย</option>
                                                    <option value="15">Türkçe</option>
                                                    <option value="16">中文(简体)</option>
                                                    <option value="17">中文(繁體)</option>
                                                    <option value="17">Hindi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                </div><!-- end row -->
                            </div><!-- end container-fluid -->
                        </div><!-- end copyright-content -->
                    </div><!-- end footer-area -->
                </div><!-- end course-dashboard-column -->








                {{-- =================course show on the course view page code    ================== --}}


                <div class="course-dashboard-sidebar-column">
                    <button class="sidebar-open" type="button"><i class="la la-angle-left"></i> Contenu du cours</button>
                    <div class="course-dashboard-sidebar-wrap custom-scrollbar-styled">
                        <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                            <h3 class="fs-18 font-weight-semi-bold">Contenu du cours</h3>
                            <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
                        </div><!-- end course-dashboard-side-heading -->
                        <div class="course-dashboard-side-content">
                            <div class="accordion generic-accordion generic--accordion" id="accordionCourseExample">


                                @foreach ($section as $key => $sec)
                                    @php

                                        $lectures = App\Models\CourseLecture::where('section_id', $sec->id)->get();
                                    @endphp
                                    <div class="card">
                                        <div class="card-header" id="headingOne{{ $sec->id }}">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne{{ $sec->id }}" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <i class="la la-angle-down"></i>
                                                <i class="la la-angle-up"></i>
                                                <span class="fs-15">Section : {{ $loop->iteration }}
                                                    {{ $sec->section_title }}</span>
                                                <span class="course-duration">
                                                    {{-- <span>1/5</span> --}}
                                                    <span>{{ count($lectures) }}</span>
                                                </span>
                                            </button>
                                        </div><!-- end card-header -->


                                        <div id="collapseOne{{ $sec->id }}" class="collapse"
                                            aria-labelledby="headingOne{{ $sec->id }}"
                                            data-parent="#accordionCourseExample">

                                            <div class="p-0 card-body">


                                                @php
                                                    $userId = Auth::id();
                                                    $progressLectures = App\Models\UserCourseProgress::where('user_id', $userId)
                                                        ->where('course_id', $course->course->id)
                                                        ->pluck('lecture_id')
                                                        ->toArray();
                                                @endphp
                                                <ul class="curriculum-sidebar-list">
                                                    @foreach ($lectures as $lecture)
                                                        <li class="course-item-link @if(in_array($lecture->id, $progressLectures)) completed @endif" data-lecture-id="{{ $lecture->id }}">
                                                            <div class="course-item-content-wrap d-flex align-items-center">
                                                                <div class="course-item-content flex-grow-1">
                                                                    <h4 class="lecture-title fs-15"
                                                                        data-video-url="{{ $lecture->video ? asset($lecture->video) : $lecture->url }}"
                                                                        data-content="{!! htmlspecialchars($lecture->content) !!}">
                                                                        {{ $lecture->lecture_title }}
                                                                    </h4>
                                                                </div>
                                                                @if(in_array($lecture->id, $progressLectures))
                                                                    <span class="badge badge-success ml-2" title="Leçon terminée">
                                                                        <svg width="18" height="18" fill="#4caf50" viewBox="0 0 24 24"><path d="M9 16.2l-3.5-3.5 1.4-1.4L9 13.4l7.1-7.1 1.4 1.4z"/></svg>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            </div><!-- end card-body -->
                                        </div><!-- end collapse -->
                                    </div><!-- end card -->
                                @endforeach

                                @if(isset($quizzes) && $quizzes->count())
                                    <div class="card mt-3">
                                        <div class="card-body text-center">
                                            <h4 class="mb-3">Quiz du cours</h4>
                                            @foreach($quizzes as $quiz)
                                                <a href="{{ route('start.quiz', [$course->course->id, $quiz->id]) }}" class="btn btn-primary mb-2">
                                                    Démarrer le quiz : {{ $quiz->title }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif



                            </div><!-- end accordion-->
                        </div><!-- end course-dashboard-side-content -->
                    </div><!-- end course-dashboard-sidebar-wrap -->
                </div><!-- end course-dashboard-sidebar-column -->
            </div><!-- end course-dashboard-container -->
        </div><!-- end course-dashboard-wrap -->
    </section><!-- end course-dashboard -->
    <!--======================================
        END COURSE-DASHBOARD
======================================-->

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Retour en haut"></i>
    </div>
    <!-- end scroll top -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="ratingModal" tabindex="-1" role="dialog"
        aria-labelledby="ratingModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <div class="pr-2">
                        <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="ratingModalTitle">
                            Comment évalueriez-vous ce cours ?
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="py-5 text-center modal-body">
                    <div class="mt-5 leave-rating">
                        <input type="radio" name='rate' id="star5" />
                        <label for="star5" class="fs-45"></label>
                        <input type="radio" name='rate' id="star4" />
                        <label for="star4" class="fs-45"></label>
                        <input type="radio" name='rate' id="star3" />
                        <label for="star3" class="fs-45"></label>
                        <input type="radio" name='rate' id="star2" />
                        <label for="star2" class="fs-45"></label>
                        <input type="radio" name='rate' id="star1" />
                        <label for="star1" class="fs-45"></label>
                        <div class="pb-4 rating-result-text fs-20"></div>
                    </div><!-- end leave-rating -->
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog"
        aria-labelledby="shareModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">Partager ce cours</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="modal-body">
                    <div class="copy-to-clipboard">
                        <span class="success-message">Copié !</span>
                        <div class="input-group">
                            <input type="text" class="pl-3 form-control form--control copy-input"
                                value="https://www.eduplatform.com/share/101WxMB0oac1hVQQ==/">
                            <div class="input-group-append">
                                <button class="shadow-none btn theme-btn theme-btn-sm copy-btn"><i
                                        class="mr-1 la la-copy"></i> Copier</button>
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
    <div class="modal fade modal-container" id="reportModal" tabindex="-1" role="dialog"
        aria-labelledby="reportModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <div class="pr-2">
                        <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="reportModalTitle">Signaler un abus
                        </h5>
                        <p class="pt-1 fs-14 lh-24">Le contenu signalé est examiné par le personnel d'EduPlatform pour déterminer s'il
                            viole les conditions d'utilisation ou les directives communautaires. Si vous avez une question ou un problème
                            technique, veuillez contacter notre
                            <a href="contact.html" class="text-color hover-underline">équipe de support ici</a>.
                        </p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="modal-body">
                    <form method="post">
                        <div class="input-box">
                            <label class="label-text">Sélectionner le type de signalement</label>
                            <div class="form-group">
                                <div class="w-auto select-container">
                                    <select class="select-container-select">
                                        <option value>-- Sélectionner une option --</option>
                                        <option value="1">Contenu de cours inapproprié</option>
                                        <option value="2">Comportement inapproprié</option>
                                        <option value="3">Violation de la politique d'EduPlatform</option>
                                        <option value="4">Contenu indésirable</option>
                                        <option value="5">Autre</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="input-box">
                            <label class="label-text">Écrire un message</label>
                            <div class="form-group">
                                <textarea class="pl-3 form-control form--control" name="message" placeholder="Fournissez des détails supplémentaires ici..."
                                    rows="5"></textarea>
                            </div>
                        </div>
                        <div class="pt-2 text-right btn-box">
                            <button type="button" class="mr-3 btn font-weight-medium"
                                data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Soumettre <i
                                    class="ml-1 la la-arrow-right icon"></i></button>
                        </div>
                    </form>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="insertLinkModal" tabindex="-1" role="dialog"
        aria-labelledby="insertLinkModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <div class="pr-2">
                        <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="insertLinkModalTitle">Insérer un lien
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="modal-body">
                    <form action="#">
                        <div class="input-box">
                            <label class="label-text">URL</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="text"
                                    placeholder="URL">
                                <i class="la la-link input-icon"></i>
                            </div>
                        </div>
                        <div class="input-box">
                            <label class="label-text">Texte</label>
                            <div class="form-group">
                                <input class="form-control form--control" type="text" name="text"
                                    placeholder="Texte">
                                <i class="la la-pencil input-icon"></i>
                            </div>
                        </div>
                        <div class="pt-2 text-right btn-box">
                            <button type="button" class="mr-3 btn font-weight-medium"
                                data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Insérer <i
                                    class="ml-1 la la-arrow-right icon"></i></button>
                        </div>
                    </form>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->

    <!-- Modal -->
    <div class="modal fade modal-container" id="uploadPhotoModal" tabindex="-1" role="dialog"
        aria-labelledby="uploadPhotoModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <div class="pr-2">
                        <h5 class="modal-title fs-19 font-weight-semi-bold lh-24" id="uploadPhotoModalTitle">Télécharger une image
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div><!-- end modal-header -->
                <div class="modal-body">
                    <div class="file-upload-wrap">
                        <input type="file" name="files[]" class="multi file-upload-input" multiple>
                        <span class="file-upload-text"><i class="mr-2 la la-upload"></i>Déposez les fichiers ici ou cliquez pour télécharger</span>
                    </div><!-- file-upload-wrap -->
                    <div class="pt-2 text-right btn-box">
                        <button type="button" class="mr-3 btn font-weight-medium"
                            data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn theme-btn theme-btn-sm lh-30">Soumettre <i
                                class="ml-1 la la-arrow-right icon"></i></button>
                    </div>
                </div><!-- end modal-body -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->



    {{-- script for the showing video on view page  --}}


    <script type="text/javascript">
        // Function to open the first lecture when the page loads
        function openFirstLecture() {
            const firstLecture = document.querySelector('.lecture-title'); // Get the first lecture element
            if (firstLecture) {
                firstLecture.click(); // Trigger the click event on the first lecture
            }
        }

        // Function to handle lecture clicks and load content
        function viewLesson(videoUrl, vimeoUrl, textContent, lectureId = null) {
            const video = document.getElementById("videoContainer");
            const text = document.getElementById("textLesson");
            text.innerHTML = "";

            // Affiche la vidéo si elle existe
            if (videoUrl && videoUrl.trim() !== "") {
                video.classList.remove("d-none");
                video.setAttribute("src", videoUrl);
            } else if (vimeoUrl && vimeoUrl.trim() !== "") {
                video.classList.remove("d-none");
                video.setAttribute("src", vimeoUrl);
            } else {
                video.classList.add("d-none");
                video.setAttribute("src", "");
            }

            // Affiche toujours le texte de la leçon (en HTML)
            if (textContent && textContent.trim() !== "") {
                text.classList.remove("d-none");
                const textContainer = document.createElement("div");
                textContainer.innerHTML = textContent;
                textContainer.style.fontSize = "14px";
                textContainer.style.textAlign = "left";
                textContainer.style.paddingLeft = "40px";
                textContainer.style.paddingRight = "40px";
                text.appendChild(textContainer);
            } else {
                text.classList.add("d-none");
            }

            // Ajoute le bouton si la leçon n'est pas terminée
            if (lectureId) {
                addMarkCompleteButton(lectureId);
            } else {
                var btnContainer = document.getElementById('mark-complete-btn-container');
                if (btnContainer) btnContainer.innerHTML = '';
            }
        }

        // Add a click event listener to all lecture elements
        document.querySelectorAll('.lecture-title').forEach((lectureTitle) => {
            lectureTitle.addEventListener('click', () => {
                const videoUrl = lectureTitle.getAttribute('data-video-url');
                const vimeoUrl = lectureTitle.getAttribute('data-vimeo-url');
                const textContent = lectureTitle.getAttribute('data-content');
                const lectureId = lectureTitle.closest('li').dataset.lectureId ? parseInt(lectureTitle.closest('li').dataset.lectureId) : null;
                viewLesson(videoUrl, vimeoUrl, textContent, lectureId);
            });
        });

        // Open the first lecture when the page loads
        window.addEventListener('load', () => {
            openFirstLecture();
        });
    </script>

    <script>
    // Désactiver l'autoplay sur les vidéos (aucune vidéo ne démarre sans action explicite)
    $(document).ready(function() {
        // Par défaut, ne pas lancer la vidéo
        $('#videoContainer').attr('src', '');
        // Quand une leçon est sélectionnée, charger la vidéo sans autoplay
        $('.lecture-title').on('click', function() {
            var videoUrl = $(this).data('video-url');
            if(videoUrl) {
                // On retire tout paramètre autoplay
                videoUrl = videoUrl.replace(/[?&]autoplay=1/, '');
                $('#videoContainer').attr('src', videoUrl);
            }
            var content = $(this).data('content');
            if(content) {
                $('#textLesson').html(content);
            }
        });
    });
    </script>

    <style>
    .completed .lecture-title {
        color: #4caf50;
        font-weight: bold;
    }
    .completed .badge-success {
        background: #e8f5e9;
        color: #388e3c;
        border-radius: 8px;
    }
    .btn-success.shadow-sm {
        box-shadow: 0 2px 8px #4caf5040;
        background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
        border: none;
    }
    #textLesson, #textLesson * {
        font-size: 1.08rem !important;
        text-align: left !important;
        line-height: 1.7;
    }

    #textLesson h2, #textLesson h3 {
        all: unset;
        display: block;
        font-family: inherit !important;
        font-weight: 700 !important;
        color: #3578e5 !important;
        margin-top: 32px !important;
        margin-bottom: 18px !important;
        letter-spacing: -0.5px !important;
        text-align: center !important;
        line-height: 1.2 !important;
    }

    #textLesson h2 {
        font-size: 2.1rem !important;
        margin-bottom: 24px !important;
    }

    #textLesson h3 {
        font-size: 1.35rem !important;
        margin-bottom: 16px !important;
    }

    #textLesson ul, #textLesson ol {
        list-style: disc inside;
        padding-left: 0;
        margin-bottom: 18px;
    }
    #textLesson ul li, #textLesson ol li {
        margin-bottom: 8px;
        padding-left: 0;
        color: #444;
        font-size: 1.08rem;
        position: relative;
    }
    #textLesson ul li::before, #textLesson ol li::before {
        content: none !important;
    }
    #textLesson strong {
        font-size: 1.08rem !important;
        color: #3578e5;
        font-weight: 700;
    }
    #textLesson {
        background: #fcf3e5 !important;
        border-radius: 18px;
        box-shadow: 0 4px 24px #3578e51a;
        padding: 36px 32px 32px 32px;
        margin: 32px auto 0 auto;
        max-width: 800px;
        font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
        font-size: 1.13rem;
        color: #444;
        line-height: 1.7;
        transition: box-shadow 0.2s;
    }
    #textLesson h2, #textLesson h3 {
        font-family: inherit;
        font-weight: 700;
        color: #3578e5 !important;
        margin-top: 32px;
        margin-bottom: 18px;
        letter-spacing: -0.5px;
        text-align: center;
    }
    #textLesson h2 {
        font-size: 2.1rem;
        margin-bottom: 24px;
    }
    #textLesson h3 {
        font-size: 1.35rem;
        margin-bottom: 16px;
    }
    #textLesson ul {
        padding-left: 28px;
        margin-bottom: 18px;
    }
    #textLesson ul li {
        margin-bottom: 8px;
        position: relative;
        padding-left: 18px;
        color: #444;
        font-size: 1.08rem;
    }
    #textLesson ul li::before {
        content: '';
        display: inline-block;
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #3578e5 60%, #ff9800 100%);
        border-radius: 50%;
        position: absolute;
        left: 0;
        top: 8px;
    }
    #textLesson strong {
        color: #3578e5;
        font-weight: 700;
    }
    #textLesson p {
        margin-bottom: 18px;
    }
    @media (max-width: 600px) {
        #textLesson {
            padding: 18px 8px 18px 8px;
            font-size: 1rem;
        }
        #textLesson h2 { font-size: 1.3rem; }
        #textLesson h3 { font-size: 1.1rem; }
    }

    .lecture-video-item {
        background: #fcf3e5 !important;
        border-radius: 18px;
        box-shadow: 0 4px 24px #3578e51a;
        padding: 32px 24px 24px 24px;
        margin: 32px auto 0 auto;
        max-width: 900px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }

    #videoContainer {
        border-radius: 12px;
        box-shadow: 0 2px 12px #3578e51a;
        background: #f4f6fa !important;
        background-color: #f4f6fa !important;
        border: 1px solid #e3e8ee;
        width: 100%;
        height: 100%;
        width: 520px;
        min-height: 340px;
        margin-bottom: 24px;
        display: block;
    }

    body {
        background: #fdf1e3 !important;
    }
    .course-dashboard-wrap {
        background: #fdf1e3 !important;
    }
    .animated-success-message {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e8f5e9;
        color: #388e3c;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 18px 24px;
        margin: 18px auto 0 auto;
        box-shadow: 0 2px 12px #43e97b33;
        animation: popIn 0.5s cubic-bezier(.68,-0.55,.27,1.55);
        max-width: 350px;
    }
    @keyframes popIn {
        0% { transform: scale(0.7); opacity: 0; }
        80% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); }
    }
    .curriculum-sidebar-list li.just-completed {
        background: linear-gradient(90deg, #43e97b22 0%, #38f9d722 100%);
        transition: background 0.6s, box-shadow 0.6s;
        box-shadow: 0 2px 12px #43e97b33;
    }
    </style>

    @include('frontend.mycourse.body.footer')

    <script>
    // Liste des leçons terminées pour l'utilisateur
    window.completedLectures = @json($progressLectures ?? []);

    function addMarkCompleteButton(lectureId) {
        // Vérifie si la leçon est déjà terminée
        if (window.completedLectures && window.completedLectures.includes(lectureId)) {
            document.getElementById('mark-complete-btn-container').innerHTML = '';
            return;
        }
        // Crée le formulaire
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ route('lecture.markComplete') }}";
        form.className = 'mt-4 text-center mark-complete-form';

        // Ajoute le token CSRF
        var csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = "{{ csrf_token() }}";
        form.appendChild(csrf);

        // Ajoute les champs cachés
        var courseInput = document.createElement('input');
        courseInput.type = 'hidden';
        courseInput.name = 'course_id';
        courseInput.value = "{{ $course->course->id }}";
        form.appendChild(courseInput);

        var lectureInput = document.createElement('input');
        lectureInput.type = 'hidden';
        lectureInput.name = 'lecture_id';
        lectureInput.value = lectureId;
        form.appendChild(lectureInput);

        // Ajoute le bouton
        var btn = document.createElement('button');
        btn.type = 'submit';
        btn.className = 'btn btn-success shadow-sm';
        btn.innerHTML = '<svg width="20" height="20" fill="#fff" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:8px;"><path d="M9 16.2l-3.5-3.5 1.4-1.4L9 13.4l7.1-7.1 1.4 1.4z"/></svg> Marquer comme terminée';
        form.appendChild(btn);

        document.getElementById('mark-complete-btn-container').innerHTML = '';
        document.getElementById('mark-complete-btn-container').appendChild(form);
    }

    // Soumission AJAX du formulaire "Marquer comme terminée"
    document.addEventListener('submit', function(e) {
        if (e.target.classList.contains('mark-complete-form')) {
            e.preventDefault();
            var form = e.target;
            var formData = new FormData(form);
            var lectureId = parseInt(formData.get('lecture_id'));
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': formData.get('_token'),
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (!window.completedLectures.includes(lectureId)) {
                    window.completedLectures.push(lectureId);
                }
                // Animation sur la leçon terminée
                const currentLi = document.querySelector('.curriculum-sidebar-list li[data-lecture-id="'+lectureId+'"]');
                if (currentLi) {
                    currentLi.classList.add('just-completed');
                    if (!currentLi.classList.contains('completed')) {
                        currentLi.classList.add('completed');
                        if (!currentLi.querySelector('.badge-success')) {
                            const badge = document.createElement('span');
                            badge.className = 'badge badge-success ml-2';
                            badge.title = 'Leçon terminée';
                            badge.innerHTML = `<svg width="18" height="18" fill="#4caf50" viewBox="0 0 24 24"><path d="M9 16.2l-3.5-3.5 1.4-1.4L9 13.4l7.1-7.1 1.4 1.4z"/></svg>`;
                            currentLi.querySelector('.course-item-content-wrap').appendChild(badge);
                        }
                    }
                    setTimeout(() => currentLi.classList.remove('just-completed'), 1200);
                }
                // Désactive le bouton et change son texte
                const form = document.querySelector('.mark-complete-form');
                if (form) {
                    const btn = form.querySelector('button[type="submit"]');
                    if (btn) {
                        btn.disabled = true;
                        btn.innerHTML = '<svg width="20" height="20" fill="#4caf50" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:8px;"><path d="M9 16.2l-3.5-3.5 1.4-1.4L9 13.4l7.1-7.1 1.4 1.4z"/></svg> Déjà terminée';
                        btn.classList.add('btn-success');
                        btn.classList.remove('theme-btn');
                    }
                }
                // Message de succès animé dans le conteneur dédié
                const statusMsg = document.getElementById('lesson-status-message');
                statusMsg.innerHTML = `
                    <div class="animated-success-message">
                        <svg width="32" height="32" fill="#43e97b" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:8px;">
                            <path d="M9 16.2l-3.5-3.5 1.4-1.4L9 13.4l7.1-7.1 1.4 1.4z"/>
                        </svg>
                        <span>${data.message || "Leçon marquée comme terminée !"}</span>
                    </div>
                `;
                setTimeout(() => {
                    statusMsg.innerHTML = '';
                }, 2200);
                // Cherche la prochaine leçon dans la sidebar
                var nextLi = currentLi ? currentLi.nextElementSibling : null;
                if (nextLi) {
                    var nextLecture = nextLi.querySelector('.lecture-title');
                    if (nextLecture) {
                        var videoUrl = nextLecture.getAttribute('data-video-url');
                        var vimeoUrl = nextLecture.getAttribute('data-vimeo-url');
                        var textContent = nextLecture.getAttribute('data-content');
                        var nextLectureId = nextLi.dataset.lectureId ? parseInt(nextLi.dataset.lectureId) : null;
                        viewLesson(videoUrl, vimeoUrl, textContent, nextLectureId);
                    }
                } else {
                    // Affiche le message animé même à la dernière leçon
                    statusMsg.innerHTML = `
                        <div class="animated-success-message">
                            <svg width="32" height="32" fill="#43e97b" viewBox="0 0 24 24" style="vertical-align:middle;margin-right:8px;">
                                <path d="M9 16.2l-3.5-3.5 1.4-1.4L9 13.4l7.1-7.1 1.4 1.4z"/>
                            </svg>
                            <span>Félicitations, vous avez terminé toutes les leçons de cette section !</span>
                        </div>
                    `;
                    setTimeout(() => {
                        statusMsg.innerHTML = '';
                    }, 2200);
                }
            })
            .catch(() => {
                document.getElementById('mark-complete-btn-container').innerHTML = '<div class="alert alert-danger mt-4">Erreur lors de la validation. Veuillez réessayer.</div>';
            });
        }
    });

    // Désactive le bouton et change son texte
    const form = document.querySelector('.mark-complete-form');
    if (form) {
        const btn = form.querySelector('button[type=\"submit\"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<svg width=\"20\" height=\"20\" fill=\"#4caf50\" viewBox=\"0 0 24 24\" style=\"vertical-align:middle;margin-right:8px;\"><path d=\"M9 16.2l-3.5-3.5 1.4-1.4L9 13.4l7.1-7.1 1.4 1.4z\"/></svg> Déjà terminée';
            btn.classList.add('btn-success');
            btn.classList.remove('theme-btn');
        }
    }
    </script>

</body>

</html>