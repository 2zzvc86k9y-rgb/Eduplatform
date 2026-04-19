@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<!-- Section du pied de page avec informations et liens -->
<section class="footer-area pt-100px">
    <!-- Conteneur principal pour les colonnes -->
    <div class="container">
        <div class="row">
            <!-- Colonne avec logo et coordonnées -->
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <!-- Logo cliquable -->
                    <a href="{{ url('/') }}">
                        <img src="{{ asset($setting->logo) ?? '' }}" alt="Logo EduPlatform" class="footer__logo">
                    </a>
                    <!-- Liste des coordonnées -->
                    <ul class="pt-4 generic-list-item">
                        <li><a href="tel:{{ $setting->phone ?? '' }}"> {{ $setting->phone ?? '' }}</a></li>
                        <li><a href="mailto:{{ $setting->email ?? '' }}">{{ $setting->email ?? '' }}</a></li>
                        <li>{{ $setting->address ?? '' }}</li>
                    </ul>
                    <!-- Titre pour les réseaux sociaux -->
                    <h3 class="pt-4 pb-2 fs-20 font-weight-semi-bold">Suivez-nous</h3>
                    <!-- Icônes des réseaux sociaux -->
                    <ul class="social-icons social-icons-styled">
                        <li class="mr-1"><a href="{{ $setting->facebook }}" class="facebook-bg"><i
                                    class="la la-facebook"></i></a></li>
                        <li class="mr-1"><a href="{{ $setting->twitter }}" class="twitter-bg"><i
                                    class="la la-twitter"></i></a></li>
                        <li class="mr-1"><a href="{{ $setting->instagram }}" class="instagram-bg"><i
                                    class="la la-instagram"></i></a></li>
                        <li class="mr-1"><a href="{{ $setting->linkedin }}" class="linkedin-bg"><i
                                    class="la la-linkedin"></i></a></li>
                    </ul>
                </div><!-- Fin de l'élément -->
            </div><!-- Fin de la colonne -->
            <!-- Colonne avec liens de l'entreprise -->
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <!-- Titre de la section -->
                    <h3 class="fs-20 font-weight-semi-bold">Entreprise</h3>
                    <!-- Séparateur visuel -->
                    <span class="section-divider section--divider"></span>
                    <!-- Liste des liens -->
                    <ul class="generic-list-item">
                        <li><a href="{{ url('/about') }}">À propos</a></li>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                        <li><a href="{{ route('become.instructor') }}">Devenir enseignant</a></li>
                        <li><a href="{{ url('/support') }}">Support</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ</a></li>
                        <li><a href="{{ url('/view/all/posts') }}">Blog</a></li>
                    </ul>
                </div><!-- Fin de l'élément -->
            </div><!-- Fin de la colonne -->
            @php
                $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
            @endphp
            <!-- Colonne avec catégories de cours -->
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <!-- Titre de la section -->
                    <h3 class="fs-20 font-weight-semi-bold">Catégories</h3>
                    <!-- Séparateur visuel -->
                    <span class="section-divider section--divider"></span>
                    <!-- Liste des catégories dynamiques -->
                    <ul class="generic-list-item">
                        @foreach ($categories as $category)
                        <li><a href="{{ url('category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div><!-- Fin de l'élément -->
            </div><!-- Fin de la colonne -->
            <!-- Colonne pour télécharger l'application -->
            <div class="col-lg-3 responsive-column-half">
                <div class="footer-item">
                    <!-- Titre de la section -->
                    <h3 class="fs-20 font-weight-semi-bold">Télécharger l'application</h3>
                    <!-- Séparateur visuel -->
                    <span class="section-divider section--divider"></span>
                    <!-- Contenu promotionnel pour l'application -->
                    <div class="mobile-app">
                        <p class="pb-3 lh-24">Téléchargez notre application mobile pour apprendre en déplacement.</p>
                        <!-- Lien vers l'App Store -->
                        <a href="#" class="mb-2 d-block hover-s"><img src="{{ asset('frontend/images/appstore.png') }}"
                                alt="App Store" class="img-fluid"></a>
                        <!-- Lien vers Google Play -->
                        <a href="#" class="d-block hover-s"><img src="{{ asset('frontend/images/googleplay.png') }}"
                                alt="Google Play Store" class="img-fluid"></a>
                    </div>
                </div><!-- Fin de l'élément -->
            </div><!-- Fin de la colonne -->
        </div><!-- Fin de la grille -->
    </div><!-- Fin du conteneur -->
    <!-- Séparateur horizontal -->
    <div class="section-block"></div>
    <!-- Section des droits d'auteur -->
    <div class="py-4 copyright-content">
        <div class="container">
            <div class="row align-items-center">
                <!-- Texte des droits d'auteur -->
                <div class="col-lg-6">
                    <p class="copy-desc">{{ $setting->copyright }}</p>
                </div><!-- Fin de la colonne -->
                <!-- Liens légaux -->
                <div class="col-lg-6">
                    <div class="flex-wrap d-flex align-items-center justify-content-end">
                        <ul class="flex-wrap generic-list-item d-flex align-items-center fs-14">
                            <li class="mr-3"><a href="{{ url('/terms') }}">Conditions générales</a></li>
                            <li class="mr-3"><a href="{{ url('/privacy') }}">Politique de confidentialité</a></li>
                        </ul>
                    </div>
                </div><!-- Fin de la colonne -->
            </div><!-- Fin de la grille -->
        </div><!-- Fin du conteneur -->
    </div><!-- Fin de la section des droits -->
</section><!-- Fin du pied de page -->