@extends('frontend.master')
@section('home')
<style>
body {
    background: linear-gradient(135deg, #fdf1e3 0%, #f7e9d7 100%);
    font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
}

/* Cartes modernes */
.card, .card-item, .card-preview, .category-card, .testimonial-card {
    border-radius: 18px !important;
    box-shadow: 0 4px 24px #3578e51a !important;
    background: #fff !important;
    transition: box-shadow 0.2s, transform 0.2s;
    border: none !important;
}
.card:hover, .card-item:hover, .card-preview:hover, .category-card:hover, .testimonial-card:hover {
    box-shadow: 0 8px 32px #3578e533 !important;
    transform: translateY(-4px) scale(1.02);
}

/* Boutons modernes */
.btn, .theme-btn {
    border-radius: 10px !important;
    font-weight: 600;
    box-shadow: 0 2px 8px #3578e522;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}
.btn-primary, .theme-btn {
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%) !important;
    color: #fff !important;
    border: none !important;
}
.btn-primary:hover, .theme-btn:hover {
    background: linear-gradient(90deg, #38f9d7 0%, #3578e5 100%) !important;
    color: #fff !important;
    box-shadow: 0 4px 16px #3578e533;
}
.btn-outline-light {
    border: 2px solid #fff !important;
    color: #3578e5 !important;
    background: transparent !important;
}
.btn-outline-light:hover {
    background: #fff !important;
    color: #3578e5 !important;
}

/* Badges et rubans */
.ribbon, .course-badge, .badge {
    border-radius: 8px !important;
    font-weight: 700;
    padding: 4px 14px;
    font-size: 1em;
    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
    color: #fff !important;
    box-shadow: 0 2px 8px #43e97b22;
}
.ribbon-blue-bg, .course-badge.blue {
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%) !important;
}

/* Avatars ronds */
.avatar, .avatar-lg, .avatar-md, .avatar-sm {
    border-radius: 50% !important;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px #3578e522;
}

/* Section titres */
.section__title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #222;
    margin-bottom: 12px;
    letter-spacing: -1px;
}
.section-heading h5.ribbon {
    font-size: 1.1rem;
    background: linear-gradient(90deg, #ff9800 0%, #43e97b 100%);
    color: #fff;
    margin-bottom: 8px;
}
.section-divider {
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%);
    border-radius: 2px;
    margin: 0 auto 18px auto;
}

/* Hover sur les images de cours */
.card-image img, .card-img-top {
    border-radius: 14px !important;
    transition: transform 0.2s, box-shadow 0.2s;
}
.card-image img:hover, .card-img-top:hover {
    transform: scale(1.04) rotate(-1deg);
    box-shadow: 0 8px 32px #3578e533;
}

/* Catégories avec icônes SVG */
.category-card {
    background: #f7e9d7 !important;
    border-radius: 16px !important;
    box-shadow: 0 2px 12px #ff98001a !important;
    padding: 24px 18px;
    text-align: center;
    transition: box-shadow 0.2s, transform 0.2s;
}
.category-card:hover {
    box-shadow: 0 8px 32px #3578e533 !important;
    transform: translateY(-4px) scale(1.04);
}
.category-card svg {
    width: 48px;
    height: 48px;
    margin-bottom: 12px;
    fill: #3578e5;
}

/* Témoignages */
.testimonial-card {
    background: #fffbe6 !important;
    border-left: 6px solid #43e97b;
    border-radius: 14px !important;
    box-shadow: 0 2px 12px #ff98001a !important;
    padding: 32px 24px;
    margin-bottom: 24px;
}

/* Progress bar style OpenClassrooms */
.progress-bar-oc {
    height: 10px;
    border-radius: 6px;
    background: #e3e8ee;
    overflow: hidden;
    margin-bottom: 8px;
}
.progress-bar-oc .progress {
    height: 100%;
    border-radius: 6px;
    background: linear-gradient(90deg, #3578e5 0%, #43e97b 100%);
    transition: width 0.4s;
}

/* Responsive */
@media (max-width: 700px) {
    .section__title { font-size: 1.5rem; }
    .card, .card-item, .card-preview { padding: 8px 2px; }
    .category-card { padding: 12px 4px; }
}

/* Style carte moderne pour chaque section */
.hero-area,
.feature-area,
.category-area,
.courses-area,
.courses-area-two,
.funfact-area,
.cta-area,
.testimonial-area,
.about-area,
.register-area,
.client-logo-area,
.blog-area,
.get-started-area,
.subscriber-area {
    background: #f8eedd;
    border-radius: 0;
    box-shadow: none;
    margin-bottom: 0;
    padding: 24px 0;
    border: none;
    position: relative;
    transition: none;
}
.hero-area::after,
.feature-area::after,
.category-area::after,
.courses-area::after,
.courses-area-two::after,
.funfact-area::after,
.cta-area::after,
.testimonial-area::after,
.about-area::after,
.register-area::after,
.client-logo-area::after,
.blog-area::after,
.get-started-area::after,
.subscriber-area::after {
    content: '';
    display: block;
    position: absolute;
    left: 0; right: 0; bottom: -1px;
    height: 48px;
    background: linear-gradient(to bottom, #f8eedd 60%, #fdf1e3 100%);
    z-index: 2;
    pointer-events: none;
}
/* Supprime le style carte sur les sections vides */
.section-block {
    background: transparent !important;
    box-shadow: none !important;
    border: none !important;
    margin: 0 !important;
    padding: 0 !important;
    min-height: 0 !important;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
    @section('title')
        EduPlatform | Accueil
     @endsection


    <!--======================================
    START HERO AREA
    ===============-->
    @include('frontend.home.hero-area')
    <!--================================
    END HERO AREA
    =================================-->

    <!--======================================
                                                                                                    START FEATURE AREA
                                                                                                ======================================-->
    @include('frontend.home.feature-area')
    <!--======================================
                                                                                                   END FEATURE AREA
                                                                                                ======================================-->

    <!--======================================
                                                                                                    START CATEGORY AREA
                                                                                                ======================================-->
    @include('frontend.home.category-area')
    <!--======================================
                                                                                                    END CATEGORY AREA
                                                                                                ======================================-->

    <!--======================================
                                                                                                    START COURSE AREA
                                                                                                ======================================-->
    @include('frontend.home.courses-area')
    <!--======================================
                                                                                                    END COURSE AREA
                                                                                                ======================================-->

    <!--======================================
                                                                                                    START COURSE AREA
                                                                                                ======================================-->
    @include('frontend.home.courses-area-two')
    <!--======================================
                                                                                                    END COURSE AREA
                                                                                                ======================================-->

    <!-- ================================
                                                                                                   START FUNFACT AREA
                                                                                                ================================= -->
    @include('frontend.home.funfact-area')
    <!-- ================================
                                                                                                   START FUNFACT AREA
                                                                                                ================================= -->

    <!--======================================
                                                                                                    START CTA AREA
                                                                                                ======================================-->
    @include('frontend.home.cta-area')
    <!--======================================
                                                                                                    END CTA AREA
                                                                                                ======================================-->

    <!--================================
                                                                                                     START TESTIMONIAL AREA
                                                                                                =================================-->
    @include('frontend.home.testimonial-area')
    <!--================================
                                                                                                    END TESTIMONIAL AREA
                                                                                                =================================-->

    <div class="section-block"></div>

    <!--======================================
                                                                                                    START ABOUT AREA
                                                                                                ======================================-->
    @include('frontend.home.about-area')
    <!--======================================
                                                                                                    END ABOUT AREA
                                                                                                ======================================-->

    <div class="section-block"></div>

    <!--======================================
                                                                                                    START REGISTER AREA
                                                                                                ======================================-->
    @include('frontend.home.register-area')
    <!--======================================
                                                                                                    END REGISTER AREA
                                                                                                ======================================-->

    <div class="section-block"></div>

    <!-- ================================
                                        START CLIENT-LOGO AREA
                                ================================= -->
    @include('frontend.home.client-logo-area')
    <!-- ================================
                                 START CLIENT-LOGO AREA
                                ================================= -->

    <!-- ================================
                                START BLOG AREA
                                ================================= -->
    @include('frontend.home.blog-area')
    <!-- ================================
                                                                                                   START BLOG AREA
                                                                                                ================================= -->

    <!--======================================
                START GET STARTED AREA
                ======================================-->
    @include('frontend.home.get-started-area')
    <!-- ================================
                 END GET STARTED AREA
                ================================= -->

    <!--======================================
                START SUBSCRIBER AREA
                =====================================-->
    @include('frontend.home.subscriber-area')
    <!--======================================
                                                                                                    END SUBSCRIBER AREA
                                                                                                ======================================-->
@endsection
