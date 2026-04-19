@php
    $setting = App\Models\SiteSetting::firstOrNew([]);
    $user = Auth::user();
@endphp

<!-- En-tête avec barre supérieure et menu principal -->
<header class="bg-white header-menu-area">
    <!-- Barre supérieure avec coordonnées et options utilisateur -->
    <div class="py-1 header-top pr-150px pl-150px border-bottom border-bottom-gray">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Coordonnées -->
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="flex-wrap generic-list-item d-flex align-items-center fs-14">
                            <!-- Numéro de téléphone -->
                            <li class="pr-3 mr-3 d-flex align-items-center border-right border-right-gray">
                                <i class="mr-1 la la-phone"></i>
                                <a href="tel:{{ $setting->phone ?? '0123456789' }}"> {{ $setting->phone }}</a>
                            </li>
                            <!-- Email -->
                            <li class="d-flex align-items-center">
                                <i class="mr-1 la la-envelope-o"></i>
                                <a href="mailto:{{ $setting->email ?? 'contact@eduplatform.com' }}">{{ $setting->email }}</a>
                            </li>
                        </ul>
                    </div><!-- Fin du widget -->
                </div><!-- Fin de la colonne -->
                <!-- Options utilisateur et thème -->
                <div class="col-lg-6">
                    <div class="flex-wrap header-widget d-flex align-items-center justify-content-end">
                        <!-- Sélecteur de thème -->
                        <div class="theme-picker d-flex align-items-center">
                            <!-- Mode sombre -->
                            <button class="theme-picker-btn dark-mode-btn" title="Mode sombre">
                                <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <!-- Mode clair -->
                            <button class="theme-picker-btn light-mode-btn" title="Mode clair">
                                <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
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
                        <!-- Options de connexion/inscription -->
                        <ul class="flex-wrap pl-3 ml-3 generic-list-item d-flex align-items-center fs-14 border-left border-left-gray">
                            @auth
                            <!-- Utilisateur connecté -->
                            <li class="pr-3 mr-3 d-flex align-items-center border-right border-right-gray">
                                <i class="mr-1 la la-sign-in"></i>
                                @if($user)
                                    @if($user->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}">Tableau de bord admin</a>
                                    @elseif($user->role == 'instructor')
                                        <a href="{{ route('instructor.dashboard') }}">Tableau de bord instructeur</a>
                                    @else
                                <a href="{{ route('dashboard') }}">Tableau de bord</a>
                                    @endif
                                @endif
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="mr-1 la la-user"></i>
                                <a href="{{ route('user.logout') }}">Déconnexion</a>
                            </li>
                            @else
                            <!-- Utilisateur non connecté -->
                            <li class="pr-3 mr-3 d-flex align-items-center border-right border-right-gray">
                                <i class="mr-1 la la-sign-in"></i>
                                <a href="{{ route('login') }}">Connexion</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="mr-1 la la-user"></i>
                                <a href="{{ route('register') }}">Inscription</a>
                            </li>
                            @endauth
                        </ul>
                    </div><!-- Fin du widget -->
                </div><!-- Fin de la colonne -->
            </div><!-- Fin de la grille -->
        </div><!-- Fin du conteneur -->
    </div><!-- Fin de la barre supérieure -->
    <!-- Contenu du menu principal -->
    <div class="bg-white header-menu-content pr-150px pl-150px">
        <div class="container-fluid">
            <div class="main-menu-content">
                <!-- Bouton pour menu déroulant -->
                <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{ route('index') }}" class="logo">
                                <img src="{{ asset($setting->logo) }}" alt="Logo EduPlatform">
                            </a>
                            <!-- Actions utilisateur -->
                            <div class="user-btn-action">
                                <!-- Recherche -->
                                <div class="mr-2 shadow-sm search-menu-toggle icon-element icon-element-sm"
                                    data-toggle="tooltip" data-placement="top" title="Recherche">
                                    <i class="la la-search"></i>
                                </div>
                                <!-- Menu catégories -->
                                <div class="mr-2 shadow-sm off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm"
                                    data-toggle="tooltip" data-placement="top" title="Menu catégories">
                                    <i class="la la-th-large"></i>
                                </div>
                                <!-- Menu principal -->
                                <div class="shadow-sm off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm"
                                    data-toggle="tooltip" data-placement="top" title="Menu principal">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- Fin de la colonne -->
                    @php
                        $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
                    @endphp
                    <!-- Menu et barre de recherche -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <!-- Menu des catégories -->
                            <div class="menu-category">
                                <ul>
                                    <li>
                                        <a href="#">Catégories <i class="la la-angle-down fs-12"></i></a>
                                        <ul class="cat-dropdown-menu">
                                            @foreach ($categories as $category)
                                                @php
                                                    $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name', 'ASC')->get();
                                                @endphp
                                                <li>
                                                    <a href="{{ url('category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }} <i
                                                            class="la la-angle-right"></i></a>
                                                    <ul class="sub-menu">
                                                        @foreach ($subcategories as $subcategory)
                                                        <li><a href="{{ url('subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- Fin du menu des catégories -->
                            <!-- Barre de recherche -->
                            <form method="post" action="{{ route('search') }}" class="search-form" style="position: relative;">
                                @csrf
                                <div class="mb-0 form-group">
                                    <input class="pl-3 form-control form--control" type="text" name="search"
                                        placeholder="Rechercher un cours">
                                    <button type="submit" style="background: none; border: none; position: absolute; right: 15px; top: 50%; transform: translateY(-50%);">
                                        <span class="la la-search search-icon"></span>
                                    </button>
                                </div>
                            </form>
                            <!-- Menu principal -->
                            <nav class="main-menu">
                                <ul>
                                    <li><a href="{{ url('/') }}">Accueil</a></li>
                                    <li><a href="{{ url('/all/courses') }}">Cours</a></li>
                                    <li><a href="{{ url('view/all/post') }}">Blog</a></li>
                                </ul><!-- Fin du menu -->
                            </nav><!-- Fin du menu principal -->
                            <!-- Mini-panier -->
                            <div class="mr-4 shop-cart">
                                <ul>
                                    <li>
                                        <!-- Bouton du panier -->
                                        <p class="shop-cart-btn d-flex align-items-center">
                                            <i class="la la-shopping-cart"></i>
                                            <span class="product-count" id="cartquantity">0</span>
                                        </p>
                                        <!-- Contenu du panier déroulant -->
                                        <ul class="cart-dropdown-menu">
                                            <div id="minicart"></div>
                                            <hr>
                                            <!-- Total du panier -->
                                            <li class="media media-card">
                                                <div class="media-body fs-16">
                                                    <p class="text-black font-weight-semi-bold lh-18">Total : {{ $setting->currency ?? '€' }}<span
                                                            class="cart-total" id="cartsubtotal"></span></p>
                                                </div>
                                            </li>
                                            <!-- Lien vers le panier -->
                                            <li>
                                                <a href="{{ route('mycart') }}" class="btn theme-btn w-100">Voir le panier <i
                                                        class="ml-1 la la-arrow-right icon"></i></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- Fin du mini-panier -->
                            <!-- Bouton d'inscription -->
                            <div class="nav-right-button">
                                @auth
                                    @if($user)
                                        @if($user->role == 'admin')
                                            <a href="{{ route('admin.dashboard') }}" class="btn theme-btn d-none d-lg-inline-block">
                                                <i class="mr-1 la la-dashboard"></i>Tableau de bord admin
                                            </a>
                                        @elseif($user->role == 'instructor')
                                            <a href="{{ route('instructor.dashboard') }}" class="btn theme-btn d-none d-lg-inline-block">
                                                <i class="mr-1 la la-dashboard"></i>Tableau de bord instructeur
                                            </a>
                                        @else
                                            <a href="{{ route('dashboard') }}" class="btn theme-btn d-none d-lg-inline-block">
                                                <i class="mr-1 la la-dashboard"></i>Tableau de bord
                                            </a>
                                        @endif
                                    @endif
                                @else
                                <a href="{{ route('login') }}" class="btn theme-btn d-none d-lg-inline-block">
                                    <i class="mr-1 la la-user-plus"></i>Admission
                                </a>
                                @endauth
                            </div><!-- Fin du bouton -->
                        </div><!-- Fin du conteneur du menu -->
                    </div><!-- Fin de la colonne -->
                </div><!-- Fin de la grille -->
            </div>
        </div><!-- Fin du conteneur -->
    </div><!-- Fin du contenu du menu -->
    <!-- Menu off-canvas principal -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <!-- Bouton de fermeture -->
        <div class="shadow-sm off-canvas-menu-close main-menu-close icon-element icon-element-sm"
            data-toggle="tooltip" data-placement="left" title="Fermer le menu">
            <i class="la la-times"></i>
        </div><!-- Fin du bouton -->
        <!-- Liste des éléments du menu -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            <li>
                <a href="{{ url('/') }}">Accueil</a>
            </li>
            <li>
                <a href="{{ url('/all/courses') }}">Cours</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('/all/courses') }}">Tous les cours</a></li>
                    <li><a href="{{ url('/courses/grid') }}">Grille des cours</a></li>
                    <li><a href="{{ url('/courses/list') }}">Liste des cours</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Étudiant</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('/student/profile') }}">Profil étudiant</a></li>
                    <li><a href="{{ url('/student/quiz') }}">Passer un quiz</a></li>
                    <li><a href="{{ url('/student/quiz/results') }}">Résultats des quiz</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Pages</a>
                <ul class="sub-menu">
                    <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    <li><a href="{{ url('/about') }}">À propos</a></li>
                    <li><a href="{{ url('/teachers') }}">Enseignants</a></li>
                    <li><a href="{{ route('become.instructor') }}">Devenir enseignant</a></li>
                    <li><a href="{{ url('/faq') }}">FAQ</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li><a href="{{ route('register') }}">Inscription</a></li>
                    <li><a href="{{ route('login') }}">Connexion</a></li>
                    <li><a href="{{ url('/terms') }}">Conditions générales</a></li>
                    <li><a href="{{ url('/privacy') }}">Politique de confidentialité</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('view/all/post') }}">Blog</a>
                <ul class="sub-menu">
                    <li><a href="{{ url('view/all/post') }}">Tous les articles</a></li>
                    <li><a href="{{ url('/blog/list') }}">Liste des articles</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- Fin du menu off-canvas -->
    <!-- Menu off-canvas des catégories -->
    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <!-- Bouton de fermeture -->
        <div class="shadow-sm off-canvas-menu-close cat-menu-close icon-element icon-element-sm" data-toggle="tooltip"
            data-placement="left" title="Fermer le menu">
            <i class="la la-times"></i>
        </div><!-- Fin du bouton -->
        <!-- Liste des catégories dynamiques -->
        <ul class="generic-list-item off-canvas-menu-list pt-90px">
            @foreach ($categories as $category)
            <li>
                <a href="{{ url('category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }}</a>
                <ul class="sub-menu">
                    @php
                        $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name', 'ASC')->get();
                    @endphp
                    @foreach ($subcategories as $subcategory)
                    <li><a href="{{ url('subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div><!-- Fin du menu des catégories -->
    <!-- Formulaire de recherche mobile -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" action="{{ route('search') }}" class="mr-3 flex-grow-1" style="position: relative;">
                @csrf
                <div class="mb-0 form-group">
                    <input class="pl-3 form-control form--control" type="text" name="search"
                        placeholder="Rechercher un cours">
                    <button type="submit" style="background: none; border: none; position: absolute; right: 15px; top: 50%; transform: translateY(-50%);">
                        <span class="la la-search search-icon"></span>
                    </button>
                </div>
            </form>
            <!-- Bouton de fermeture -->
            <div class="shadow-sm search-bar-close icon-element icon-element-sm">
                <i class="la la-times"></i>
            </div><!-- Fin du bouton -->
        </div>
    </div><!-- Fin du formulaire -->
    <!-- Superposition pour les menus mobiles -->
    <div class="body-overlay"></div>
</header><!-- Fin de l'en-tête -->

<!-- Styles pour les thèmes clair et sombre -->
<style>
    :root {
        --bg-color: #ffffff;
        --text-color: #000000;
        --header-bg: #ffffff;
        --border-color: rgba(0, 0, 0, 0.1);
        --card-bg: #ffffff;
        --link-color: #007bff;
        --tab-active-color: #007bff;
        --input-bg: #ffffff;
        --input-text: #000000;
    }

    [data-theme="dark"] {
        --bg-color: #1a1a1a;
        --text-color: #ffffff;
        --header-bg: #2c2c2c;
        --border-color: rgba(255, 255, 255, 0.12);
        --card-bg: #2c2c2c;
        --link-color: #4da3ff;
        --tab-active-color: #4da3ff;
        --input-bg: #3a3a3a;
        --input-text: #ffffff;
    }

    body {
        background-color: var(--bg-color);
        color: var(--text-color);
        transition: background-color 0.3s, color 0.3s;
    }

    .header-menu-area {
        background-color: var(--header-bg);
    }

    .header-menu-content {
        background-color: var(--header-bg);
    }

    .border-bottom-gray {
        border-bottom-color: var(--border-color);
    }

    .border-right-gray {
        border-right-color: var(--border-color);
    }

    .border-left-gray {
        border-left-color: var(--border-color);
    }

    a {
        color: var(--link-color);
    }

    .form-control {
        background-color: var(--input-bg);
        color: var(--input-text);
        border-color: var(--border-color);
    }

    .dark-mode-btn,
    .light-mode-btn {
        display: inline-block;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
    }

    .dark-mode-btn svg,
    .light-mode-btn svg {
        width: 20px;
        height: 20px;
        stroke: var(--text-color);
    }

    [data-theme="dark"] .dark-mode-btn,
    [data-theme="light"] .light-mode-btn {
        display: none;
    }
</style>

<!-- Script pour gérer le basculement de thème -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const darkModeBtn = document.querySelector('.dark-mode-btn');
        const lightModeBtn = document.querySelector('.light-mode-btn');
        const html = document.documentElement;

        // Charger le thème depuis localStorage
        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);

        // Écouteurs pour les boutons
        darkModeBtn?.addEventListener('click', () => {
            html.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        });

        lightModeBtn?.addEventListener('click', () => {
            html.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        });
    });
</script>