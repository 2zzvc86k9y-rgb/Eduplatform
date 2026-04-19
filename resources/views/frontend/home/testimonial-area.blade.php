@php
    $reviews = App\Models\Review::where('status', 1)->latest()->limit(5)->get();
@endphp
<section class="testimonial-area section-padding">
    <div class="container">
        <div class="text-center section-heading">
            <h5 class="mb-2 ribbon ribbon-lg">Témoignages</h5>
            <h2 class="section__title">Avis des étudiants</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
    </div><!-- end container -->
    <div class="container-fluid">

        <div class="testimonial-carousel owl-action-styled">
            @foreach ($reviews as $item)
            <div class="card card-item">
                <div class="card-body">
                    <div class="pb-3 media media-card align-items-center">
                        <div class="media-img avatar-md">
                            <img src="{{ !empty($item->user->photo) ? url('upload/user_image/' . $item->user->photo) : url('upload/noimage.jpg') }}" alt="Testimonial avatar" class="rounded-full">
                        </div>
                        <div class="media-body">
                            <h5>{{ $item->user->name }}</h5>
                            <div class="pt-1 d-flex align-items-center">
                                <div class="flex-stars-badge">
                                    <span class="badge-etudiant">Étudiant</span>
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
                            </div>
                        </div>
                    </div><!-- end media -->
                    <p class="card-text">
                       {{ $item->comment }}
                    </p>
                </div><!-- end card-body -->
            </div><!-- end card -->
            @endforeach
            
        </div><!-- end testimonial-carousel -->
    </div><!-- container-fluid -->
</section><!-- end testimonial-area -->

<style>
.testimonial-area {
    background: #faecdc;
    padding: 48px 0;
}
.testimonial-carousel {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 24px;
}
.card.card-item {
    border-radius: 18px;
    box-shadow: 0 4px 24px #3578e51a;
    background: #fdefc7;
    border: none;
    transition: box-shadow 0.2s, transform 0.2s;
    margin: 0;
    padding: 0;
    min-width: 270px;
    max-width: 320px;
    min-height: 340px;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
}
.card.card-item .card-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    width: 100%;
    padding: 28px 18px 18px 18px;
}
.card.card-item:hover {
    box-shadow: 0 8px 32px #3578e533;
    transform: translateY(-4px) scale(1.02);
}
.media.media-card {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 12px;
}
.media-img.avatar-md img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0 2px 8px #3578e522;
    border: 3px solid #fff;
    background: #fdf1e3;
    margin-bottom: 10px;
}
.media-body {
    text-align: center;
    width: 100%;
}
.media-body h5 {
    font-weight: 700;
    font-size: 1.1rem;
    color: #233d63;
    margin-bottom: 8px;
    text-transform: uppercase;
}
.flex-stars-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 8px;
}
.badge-etudiant {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%);
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 0 12px;
    font-size: 0.95em;
    height: 28px;
    line-height: 28px;
    margin-right: 0;
}
.review-stars .la-star {
    color: #43e97b;
    font-size: 1.2em;
    vertical-align: middle;
}
.review-stars .la-star-o {
    color: #bfc9d8;
    font-size: 1.2em;
    vertical-align: middle;
}
.review-stars {
    display: flex;
    align-items: center;
    gap: 2px;
}
.card-text {
    font-style: italic;
    color: #233d63;
    font-size: 1.05em;
    margin-top: 18px;
    margin-bottom: 0;
    line-height: 1.6;
    text-align: center;
    width: 100%;
    flex: 1 1 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
