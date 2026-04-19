@extends('frontend.master')

@section('title')
Tous les articles | EduPlatform
@endsection

@section('home')
<!-- Zone des articles de blog -->
<section class="overflow-hidden blog-area section--padding bg-gray">
    <div class="container">
        <div class="text-center section-heading">
            <h2 class="section__title">Tous les articles de blog</h2>
            <span class="section-divider"></span>
        </div>
        <div class="row mt-30px">
            @forelse($blog as $item)
                @php
                    $commentCount = $item->comments()->where('status', 1)->count();
                    $likeCount = $item->likes()->where('status', 1)->count();
                @endphp
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card card-item shadow-sm">
                        <div class="card-image">
                            <a href="{{ url('blog/details/' . $item->post_slug) }}" class="d-block">
                                <img class="card-img-top" src="{{ asset($item->post_image) }}" alt="Image de l'article {{ $item->post_title }}">
                            </a>
                            <div class="course-badge-labels">
                                <div class="course-badge">{{ $item->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ url('blog/details/' . $item->post_slug) }}">{{ $item->post_title }}</a></h5>
                            <ul class="flex-wrap pt-2 generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                                <li class="d-flex align-items-center">Par <a href="{{ route('instructor.details', $item->user_id) }}">{{ $item->user->name ?? 'Admin' }}</a></li>
                                <li class="d-flex align-items-center"><a href="{{ url('blog/details/' . $item->post_slug) . '#comments' }}">{{ $commentCount }} commentaire{{ $commentCount > 1 ? 's' : '' }}</a></li>
                                <li class="d-flex align-items-center"><a href="#">{{ $likeCount }} J'aime</a></li>
                            </ul>
                            <div class="pt-3 d-flex justify-content-between align-items-center">
                                <a href="{{ url('blog/details/' . $item->post_slug) }}" class="btn theme-btn theme-btn-sm theme-btn-white" aria-label="Lire l'article">Lire l'article <i class="ml-1 la la-arrow-right icon"></i></a>
                                <div class="share-wrap">
                                    <ul class="social-icons social-icons-styled">
                                        <li class="mr-0"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url('blog/details/' . $item->post_slug) }}" class="facebook-bg" target="_blank" aria-label="Partager sur Facebook"><i class="la la-facebook"></i></a></li>
                                        <li class="mr-0"><a href="https://twitter.com/intent/tweet?url={{ url('blog/details/' . $item->post_slug) }}&text={{ $item->post_title }}" class="twitter-bg" target="_blank" aria-label="Partager sur Twitter"><i class="la la-twitter"></i></a></li>
                                        <li class="mr-0"><a href="https://www.instagram.com/" class="instagram-bg" target="_blank" aria-label="Partager sur Instagram"><i class="la la-instagram"></i></a></li>
                                    </ul>
                                    <div class="shadow-sm cursor-pointer icon-element icon-element-sm share-toggle" title="Afficher les options de partage" aria-label="Afficher les options de partage"><i class="la la-share-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Aucun article de blog disponible pour le moment.</p>
                </div>
            @endforelse
        </div>
        <div class="text-center pt-3">
            <nav aria-label="Navigation de la pagination">
                {{ $blog->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
</section>
@endsection