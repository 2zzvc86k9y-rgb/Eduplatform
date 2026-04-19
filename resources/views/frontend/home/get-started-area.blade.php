<!-- Section incitant les utilisateurs à s'inscrire ou à explorer les rôles -->
<section class="get-started-area pt-30px pb-90px position-relative">
    <!-- Formes décoratives en arrière-plan -->
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <!-- Conteneur principal pour les cartes -->
    <div class="container">
        <div class="row">
            <!-- Carte pour devenir enseignant -->
            <div class="col-lg-4 responsive-column-half">
                <div class="text-center card card-item hover-s">
                    <div class="card-body">
                        <!-- Image circulaire illustrative -->
                        <img src="{{ asset('frontend/images/small-img-2.jpg') }}" data-src="images/small-img-2.jpg" alt="Image enseignant"
                            class="rounded-full img-fluid lazy">
                        <!-- Titre de la carte -->
                        <h5 class="pt-4 pb-2 card-title">Devenir enseignant</h5>
                        <!-- Description du rôle -->
                        <p class="card-text">Partagez votre passion. EduPlatform vous fournit les outils pour créer vos cours.</p>
                        <!-- Bouton d'action -->
                        <div class="btn-box mt-20px">
                            <a href="{{ route('become.instructor') }}" class="btn theme-btn theme-btn-sm theme-btn-white lh-30"><i
                                    class="mr-1 la la-user"></i>Commencer à enseigner</a>
                        </div><!-- Fin du conteneur du bouton -->
                    </div><!-- Fin du corps de la carte -->
                </div><!-- Fin de la carte -->
            </div><!-- Fin de la colonne -->
            <!-- Carte pour devenir apprenant -->
            <div class="col-lg-4 responsive-column-half">
                <div class="text-center card card-item hover-s">
                    <div class="card-body">
                        <!-- Image circulaire illustrative -->
                        <img src="{{ asset('frontend/images/small-img-3.jpg') }}" data-src="images/small-img-3.jpg" alt="Image apprenant"
                            class="rounded-full img-fluid lazy">
                        <!-- Titre de la carte -->
                        <h5 class="pt-4 pb-2 card-title">Devenir apprenant</h5>
                        <!-- Description du rôle -->
                        <p class="card-text">Apprenez ce que vous aimez ! Transformez votre vie grâce à l'éducation.</p>
                        <!-- Bouton d'action -->
                        <div class="btn-box mt-20px">
                            <a href="{{ route('login') }}" class="btn theme-btn theme-btn-sm theme-btn-white lh-30"><i
                                    class="mr-1 la la-file-text-o"></i>Commencer à apprendre</a>
                        </div><!-- Fin du conteneur du bouton -->
                    </div><!-- Fin du corps de la carte -->
                </div><!-- Fin de la carte -->
            </div><!-- Fin de la colonne -->
            <!-- Carte pour les entreprises -->
            <div class="col-lg-4 responsive-column-half">
                <div class="text-center card card-item hover-s">
                    <div class="card-body">
                        <!-- Image circulaire illustrative -->
                        <img src="{{ asset('frontend/images/small-img-4.jpg') }}" data-src="images/small-img-4.jpg" alt="Image entreprise"
                            class="rounded-full img-fluid lazy">
                        <!-- Titre de la carte -->
                        <h5 class="pt-4 pb-2 card-title">EduPlatform pour entreprises</h5>
                        <!-- Description du rôle -->
                        <p class="card-text">Offrez à votre équipe un accès illimité à plus de 5 000 cours de qualité, n'ayez pas de limites.</p>
                        <!-- Bouton d'action -->
                        <div class="btn-box mt-20px">
                            <a href="{{ route('login') }}" class="btn theme-btn theme-btn-sm theme-btn-white lh-30"><i
                                    class="mr-1 la la-briefcase"></i>EduPlatform pour entreprises</a>
                        </div><!-- Fin du conteneur du bouton -->
                    </div><!-- Fin du corps de la carte -->
                </div><!-- Fin de la carte -->
            </div><!-- Fin de la colonne -->
        </div><!-- Fin de la grille -->
    </div><!-- Fin du conteneur -->
</section><!-- Fin de la section -->

<style>
.get-started-area {
    background: #fdf1e3;
    padding: 48px 0 90px 0;
}
.card.card-item.hover-s {
    border-radius: 18px;
    box-shadow: 0 4px 24px #3578e51a;
    background: #fff;
    border: none;
    transition: box-shadow 0.2s, transform 0.2s;
    margin-bottom: 32px;
    padding: 0;
}
.card.card-item.hover-s:hover {
    box-shadow: 0 8px 32px #3578e533;
    transform: translateY(-4px) scale(1.02);
}
.card.card-item .card-body {
    padding: 32px 18px 24px 18px;
}
.card.card-item img.rounded-full {
    width: 72px;
    height: 72px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0 2px 8px #3578e522;
    border: 3px solid #fff;
    background: #fdf1e3;
    margin-bottom: 18px;
}
.card.card-item .card-title {
    font-weight: 700;
    font-size: 1.2rem;
    color: #233d63;
    margin-bottom: 8px;
}
.card.card-item .card-text {
    color: #233d63;
    font-size: 1.05em;
    margin-bottom: 16px;
}
.theme-btn.theme-btn-white {
    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 10px !important;
    font-weight: 600;
    box-shadow: 0 2px 8px #43e97b22;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
}
.theme-btn.theme-btn-white:hover {
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%) !important;
    color: #fff !important;
    box-shadow: 0 4px 16px #3578e533;
}
</style>