@extends('frontend.master')

@section('title')
{{ $blogCat->category_name }} | EduPlatform
@endsection

@section('home')
<!-- Fil d'Ariane -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">{{ $blogCat->category_name }}</h2>
            </div>
            <nav aria-label="Fil d'Ariane">
                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="{{ route('index') }}" aria-label="Retour à l'accueil">Accueil</a></li>
                    <li><a href="{{ url('view/all/posts') }}">Blog</a></li>
                    <li>{{ $blogCat->category_name }}</li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- Zone des articles de blog -->
<section class="blog-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5">
                <div class="row">
                    @forelse ($blog as $item)
                        @php
                            $commentCount = $item->comments()->where('status', 1)->count();
                            $likeCount = $item->likes()->where('status', 1)->count();
                        @endphp
                        <div class="col-lg-6">
                            <div class="card card-item shadow-sm">
                                <div class="card-image">
                                    <a href="{{ url('blog/details/' . $item->post_slug) }}" class="d-block">
                                        <img class="card-img-top lazy" src="{{ asset($item->post_image) }}" alt="Image de l'article {{ $item->post_title }}">
                                    </a>
                                    <div class="course-badge-labels">
                                        <div class="course-badge">{{ $item->created_at->format('d M Y') }}</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><a href="{{ url('blog/details/' . $item->post_slug) }}">{{ $item->post_title }}</a></h5>
                                    <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                                        <li class="d-flex align-items-center">Par <a href="{{ route('instructor.details', $item->user_id) }}">{{ $item->user->name ?? 'Admin' }}</a></li>
                                        <li class="d-flex align-items-center"><a href="{{ url('blog/details/' . $item->post_slug) . '#comments' }}">{{ $commentCount }} commentaire{{ $commentCount > 1 ? 's' : '' }}</a></li>
                                        <li class="d-flex align-items-center"><a href="#">{{ $likeCount }} J'aime</a></li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center pt-3">
                                        <a href="{{ url('blog/details/' . $item->post_slug) }}" class="btn theme-btn theme-btn-sm theme-btn-white" aria-label="Lire l'article">Lire l'article <i class="la la-arrow-right icon ml-1"></i></a>
                                        <div class="share-wrap">
                                            <ul class="social-icons social-icons-styled">
                                                <li class="mr-0"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url('blog/details/' . $item->post_slug) }}" class="facebook-bg" target="_blank" aria-label="Partager sur Facebook"><i class="la la-facebook"></i></a></li>
                                                <li class="mr-0"><a href="https://twitter.com/intent/tweet?url={{ url('blog/details/' . $item->post_slug) }}&text={{ $item->post_title }}" class="twitter-bg" target="_blank" aria-label="Partager sur Twitter"><i class="la la-twitter"></i></a></li>
                                                <li class="mr-0"><a href="https://www.instagram.com/" class="instagram-bg" target="_blank" aria-label="Partager sur Instagram"><i class="la la-instagram"></i></a></li>
                                            </ul>
                                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Afficher les options de partage" aria-label="Afficher les options de partage"><i class="la la-share-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12">
                            <p class="text-center">Aucun article disponible dans cette catégorie pour le moment.</p>
                        </div>
                    @endforelse
                </div>
                <div class="text-center pt-3">
                    <nav aria-label="Navigation de la pagination">
                        {{ $blog->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            </div>

            <!-- Barre latérale -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Recherche -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Rechercher</h3>
                            <div class="divider"><span></span></div>
                            <form method="GET" action="{{ url('blog/category/list/' . $blogCat->id) }}">
                                <div class="form-group mb-0">
                                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Rechercher des articles" aria-label="Rechercher des articles">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Catégories de blog -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Catégories de blog</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                                @forelse ($blogCategory as $item)
                                    <li><a href="{{ url('blog/category/list/' . $item->id) }}">{{ $item->category_name }}</a></li>
                                @empty
                                    <li>Aucune catégorie disponible.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Articles récents -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Articles récents</h3>
                            <div class="divider"><span></span></div>
                            @forelse ($postblog as $detailsPost)
                                <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                    <a href="{{ url('blog/details/' . $detailsPost->post_slug) }}" class="media-img">
                                        <img class="mr-3" src="{{ asset($detailsPost->post_image) }}" alt="Image de l'article {{ $detailsPost->post_title }}">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="fs-15"><a href="{{ url('blog/details/' . $detailsPost->post_slug) }}">{{ $detailsPost->post_title }}</a></h5>
                                        <span class="d-block lh-18 py-1 fs-14">{{ $detailsPost->user->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                            @empty
                                <p>Aucun article récent disponible.</p>
                            @endforelse
                            <div class="view-all-course-btn-box">
                                <a href="{{ url('view/all/posts') }}" class="btn theme-btn w-100" aria-label="Voir tous les articles">Voir tous les articles <i class="la la-arrow-right icon ml-1"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de contact -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Formulaire de contact</h3>
                            <div class="divider"><span></span></div>
                            <form method="POST" action="{{ route('contact.author') }}">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control form--control" type="text" name="name" placeholder="Nom" required aria-label="Votre nom">
                                    <span class="la la-user input-icon"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control form--control" type="email" name="email" placeholder="Email" required aria-label="Votre email">
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control form--control pl-3" name="message" rows="4" placeholder="Écrire un message" required aria-label="Votre message"></textarea>
                                </div>
                                <div class="btn-box">
                                    <button type="submit" class="btn theme-btn w-100" aria-label="Contacter l'auteur">Contacter l'auteur <i class="la la-arrow-right icon ml-1"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Réseaux sociaux -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Connectez-vous & Suivez-nous</h3>
                            <div class="divider"><span></span></div>
                            <ul class="social-icons social-icons-styled social--icons-styled">
                                <li><a href="https://facebook.com" target="_blank" aria-label="Suivre sur Facebook"><i class="la la-facebook"></i></a></li>
                                <li><a href="https://twitter.com" target="_blank" aria-label="Suivre sur Twitter"><i class="la la-twitter"></i></a></li>
                                <li><a href="https://instagram.com" target="_blank" aria-label="Suivre sur Instagram"><i class="la la-instagram"></i></a></li>
                                <li><a href="https://youtube.com" target="_blank" aria-label="Suivre sur YouTube"><i class="la la-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection