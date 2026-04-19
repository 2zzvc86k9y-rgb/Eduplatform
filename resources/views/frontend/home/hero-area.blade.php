<!-- Section principale avec un carrousel promotionnel -->
<section class="hero-area position-relative overflow-hidden">
    <!-- Overlay coloré avec dégradé -->
    <div class="hero-overlay"></div>
    
    <!-- Carrousel utilisant Owl Carousel -->
    <div class="hero-slider owl-action-styled">
        <!-- Premier slide -->
        <div class="hero-slider-item hero-bg-1">
            <div class="container">
                <div class="hero-content row align-items-center">
                    <div class="col-md-7">
                        <div class="section-heading">
                            <h2 class="pb-3 section__title fs-65 lh-80">
                                Apprenez ce que vous aimez sur <span class="text-primary">EduPlatform</span>
                            </h2>
                            <p class="pb-4 section__desc fs-18">
                                Découvrez des parcours interactifs, des projets concrets et une communauté d'entraide pour progresser à votre rythme.
                                <span class="badge badge-pill badge-success ml-2">+130 000 cours</span>
                            </p>
                        </div>
                        <div class="d-flex align-items-center mt-4">
                            <a href="{{route('register')}}" class="btn btn-primary btn-lg shadow-lg mr-3">
                                Commencer maintenant <i class="ml-2 las la-arrow-right"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-lg border-2">
                                <i class="las la-gem mr-2"></i>Découvrir Premium
                            </a>
                        </div>
                        <div class="d-flex align-items-center mt-5">
                            <img src="{{ asset('frontend/images/hero-bg1.jpg') }}" class="avatar-lg mr-2" alt="Étudiant" style="border:3px solid #43e97b;">
                            <div>
                                <div class="rating-stars mb-1">
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star"></i>
                                    <i class="las la-star-half-alt"></i>
                                </div>
                                <span class="d-block text-success font-weight-bold">Recommandé par 98% des apprenants</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="hero-shape shape-1"></div>
        </div>

        <!-- Deuxième slide -->
        <div class="hero-slider-item hero-bg-2">
            <div class="container">
                <div class="text-center hero-content">
                    <div class="section-heading">
                        <h2 class="pb-3 text-white section__title fs-65 lh-80">
                            Rejoignez <span class="highlight-text">EduPlatform</span> et <br> accédez à des cours gratuits !
                        </h2>
                        <p class="pb-4 text-white-80 section__desc mx-auto" style="max-width: 700px;">
                            Inscrivez-vous pour explorer des cours gratuits et commencer votre aventure d'apprentissage dès aujourd'hui.
                        </p>
                    </div>
                    <div class="flex-wrap pt-1 hero-btn-box d-flex align-items-center justify-content-center">
                        <a href="{{route('register')}}" class="mb-4 btn btn-light btn-lg text-dark shadow-sm transform-on-hover">
                            <i class="las la-rocket mr-2"></i> Commencer
                        </a>
                    </div>
                </div>
            </div>
            <div class="hero-shape shape-2"></div>
        </div>

        <!-- Troisième slide -->
        <div class="hero-slider-item hero-bg-3">
            <div class="container">
                <div class="text-right hero-content">
                    <div class="section-heading">
                        <h2 class="pb-3 text-white section__title fs-65 lh-80">
                            Apprenez tout, <br> n'importe quand sur <span class="text-primary">EduPlatform</span>
                        </h2>
                        <p class="pb-4 text-white-80 section__desc">
                            Accédez à vos cours à votre rythme, sur tous vos appareils, pour un apprentissage flexible.
                        </p>
                    </div>
                    <div class="testimonial-box mt-3 ml-auto">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('frontend/images/hero-bg4.jpg') }}" class="avatar-lg mr-3" alt="Témoignage">
                            <div class="text-left text-white">
                                <p class="font-italic mb-1">"EduPlatform m'a permis d'apprendre à mon rythme !"</p>
                                <div class="font-weight-bold">Marc D.</div>
                                <small class="text-white-60">Développeur Fullstack</small>
                            </div>
                        </div>
                    </div>
                    <div class="flex-wrap pt-3 hero-btn-box d-flex align-items-center justify-content-end">
                        <a href="{{route('register')}}" class="mb-4 btn btn-primary btn-lg shadow-lg transform-on-hover">
                            S'inscrire <i class="las la-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="hero-shape shape-3"></div>
        </div>
    </div>
    
    <!-- Scroll down indicator -->
    <div class="scroll-down">
        <a href="#next-section" class="scroll-link">
            <i class="las la-angle-double-down"></i>
        </a>
    </div>
</section>

<style>
    /* Styles de base améliorés */
    .hero-area {
        height: 100vh;
        min-height: 700px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        position: relative;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(41, 39, 116, 0.9) 0%, rgba(87, 24, 155, 0.8) 100%);
        z-index: 0;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        padding-top: 80px;
    }
    
    /* Définir explicitement les images de fond pour chaque slide */
    .hero-bg-1 {
        background-image: url('{{ asset("frontend/images/hero-bg1.jpg") }}');
        background-size: cover;
        background-position: center;
    }
    
    .hero-bg-2 {
        background-image: url('{{ asset("frontend/images/hero-bg2.jpg") }}');
        background-size: cover;
        background-position: center;
    }
    
    .hero-bg-3 {
        background-image: url('{{ asset("frontend/images/hero-bg3.jpg") }}');
        background-size: cover;
        background-position: center;
    }
    
    /* Typographie */
    .section__title {
        font-weight: 800;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .highlight-text {
        background: linear-gradient(90deg, #ff8a00, #e52e71);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: inline;
    }
    
    /* Boutons améliorés */
    .btn-lg {
        padding: 12px 30px;
        font-size: 18px;
        border-radius: 50px;
        transition: all 0.4s ease;
    }
    
    .transform-on-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
    }
    
    .btn-outline-light {
        background-color: transparent;
        transition: all 0.3s ease;
    }
    
    .btn-outline-light:hover {
        background-color: rgba(255,255,255,0.1);
    }
    
    /* Éléments décoratifs */
    .hero-shape {
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: rgba(255,255,255,0.03);
        z-index: 1;
    }
    
    .shape-1 {
        top: -250px;
        right: -250px;
    }
    
    .shape-2 {
        bottom: -300px;
        left: -300px;
        width: 600px;
        height: 600px;
    }
    
    .shape-3 {
        bottom: -200px;
        right: -200px;
        background: rgba(255,193,7,0.1);
    }
    
    /* Avatars */
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid white;
        margin-right: -15px;
    }
    
    .avatar-lg {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 3px solid white;
    }
    
    /* Badges */
    .trust-badges {
        position: relative;
        z-index: 3;
    }
    
    .rating-stars {
        color: #FFC107;
        font-size: 16px;
    }
    
    /* Animation texte */
    .typed-text {
        color: #FFC107;
        border-right: 2px solid;
        animation: blink 0.7s infinite;
    }
    
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }
    
    /* Scroll indicator */
    .scroll-down {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 5;
        animation: bounce 2s infinite;
    }
    
    .scroll-link {
        color: white;
        font-size: 30px;
        display: block;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0) translateX(-50%); }
        40% { transform: translateY(-20px) translateX(-50%); }
        60% { transform: translateY(-10px) translateX(-50%); }
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .hero-area {
            min-height: 600px;
            height: auto;
            padding: 100px 0;
        }
        
        .section__title {
            font-size: 42px !important;
            line-height: 1.3;
        }
        
        .hero-shape {
            display: none;
        }
    }
    
    @media (max-width: 768px) {
        .section__title {
            font-size: 32px !important;
        }
        
        .hero-content {
            text-align: center !important;
        }
        
        .hero-btn-box {
            justify-content: center !important;
        }
        
        .testimonial-box {
            margin-right: auto !important;
        }
    }

    .hero-area,
    .hero-slider,
    .hero-slider-item {
        background: transparent !important;
        overflow: hidden !important;
    }
    .hero-slider-item {
        width: 100vw !important;
        min-width: 100vw !important;
        max-width: 100vw !important;
    }
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        z-index: 1;
        pointer-events: none;
    }
    .hero-content, .hero-slider-item {
        position: relative;
        z-index: 2;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initCarouselWhenImagesLoaded() {
            const images = document.querySelectorAll('img');
            let loadedImages = 0;
            const totalImages = images.length;

            if (totalImages === 0) {
                initializeCarousel();
                return;
            }

            images.forEach(img => {
                if (img.complete) {
                    loadedImages++;
                    if (loadedImages === totalImages) {
                        initializeCarousel();
                    }
                } else {
                    img.addEventListener('load', () => {
                        loadedImages++;
                        if (loadedImages === totalImages) {
                            initializeCarousel();
                        }
                    });
                    img.addEventListener('error', () => {
                        loadedImages++;
                        if (loadedImages === totalImages) {
                            initializeCarousel();
                        }
                    });
                }
            });
        }

        function initializeCarousel() {
            $('.hero-slider').owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                nav: true,
                dots: true
            });
        }

        initCarouselWhenImagesLoaded();

        if(document.querySelector('.typed-text')) {
            new Typed('.typed-text', {
                strings: ['ce que vous aimez', 'votre passion', 'votre futur'],
                typeSpeed: 50,
                backSpeed: 30,
                loop: true
            });
        }
    });
</script>