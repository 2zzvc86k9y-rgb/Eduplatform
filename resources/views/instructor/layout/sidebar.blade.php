@php
    $id = Auth::user()->id;
    $instructorid = App\Models\User::find($id);
    $status = $instructorid->status;
@endphp

<link rel="stylesheet" href="{{ asset('backend/assets/css/sidebar.css') }}">
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div><a href="{{ route('index') }}">
            <img src="{{ asset('backend/assets/images/edulog.png') }}" class="logo-icon" alt="Icône du logo de EduPlatform">
        </a>
        </div>
        <div>
            <h4 class="logo-text">Instructeur</h4>
        </div>
        <div class="toggle-icon ms-auto" onclick="toggleSidebar()">
            <i class='bx bx-chevrons-left'></i>
        </div>
    </div>
    <!--navigation-->
    <nav>
        <ul class="metismenu" id="menu" role="menu">
            <li role="menuitem">
                <a href="{{ route('instructor.dashboard') }}" aria-label="Tableau de bord">
                    <div class="parent-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="#ff9800" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                    </div>
                    <div class="menu-title">Tableau de bord</div>
                </a>
            </li>

            @if ($status === '1')
                <li role="menuitem" class="@if (Route::currentRouteNamed('all.course')) active-menu @endif">
                    <a href="{{ route('all.course') }}">
                        <div class="parent-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#2196f3" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <rect x="7" y="8" width="10" height="2" fill="#fff"/>
                                <rect x="7" y="12" width="6" height="2" fill="#fff"/>
                            </svg>
                        </div>
                        <div class="menu-title">Gestion des cours</div>
                    </a>
                </li>
                <li role="menuitem" class="@if (Route::currentRouteNamed('instructor.all.order')) active-menu @endif">
                    <a href="{{ route('instructor.all.order') }}">
                        <div class="parent-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#4caf50" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="7" width="18" height="10" rx="2"/>
                                <rect x="7" y="11" width="10" height="2" fill="#fff"/>
                            </svg>
                        </div>
                        <div class="menu-title">Commandes de cours</div>
                    </a>
                </li>
                <li role="menuitem" class="@if (Route::currentRouteNamed('instructor.all.questions')) active-menu @endif">
                    <a href="{{ route('instructor.all.questions') }}">
                        <div class="parent-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#e040fb" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10"/>
                                <rect x="10" y="6" width="4" height="12" rx="2" fill="#fff"/>
                            </svg>
                        </div>
                        <div class="menu-title">Questions sur les cours</div>
                    </a>
                </li>
                <li role="menuitem" class="@if (Route::currentRouteNamed('instructor.all.cupon')) active-menu @endif">
                    <a href="{{ route('instructor.all.cupon') }}">
                        <div class="parent-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#ab47bc" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="7" width="18" height="10" rx="2"/>
                                <circle cx="7" cy="12" r="1.5" fill="#fff"/>
                                <circle cx="17" cy="12" r="1.5" fill="#fff"/>
                            </svg>
                        </div>
                        <div class="menu-title">Gestion des coupons</div>
                    </a>
                </li>
                <li role="menuitem" class="@if (Route::currentRouteNamed('instructor.all.review')) active-menu @endif">
                    <a href="{{ route('instructor.all.review') }}">
                        <div class="parent-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#e040fb" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        </div>
                        <div class="menu-title">Gestion des avis</div>
                    </a>
                </li>
                <li class="menu-label">Éléments d'interface</li>
                <li role="menuitem">
                    <a href="{{ route('instructor.live.chat') }}" aria-label="Chat en direct">
                        <div class="parent-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#00bcd4" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="7" width="18" height="10" rx="2"/>
                                <rect x="7" y="11" width="10" height="2" fill="#fff"/>
                            </svg>
                        </div>
                        <div class="menu-title">Chat en direct</div>
                    </a>
                </li>
                <li role="menuitem">
                    <a href="#" target="_blank" aria-label="Documentation">
                        <div class="parent-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="#607d8b" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10"/>
                                <rect x="10" y="6" width="4" height="12" rx="2" fill="#fff"/>
                            </svg>
                        </div>
                        <div class="menu-title">Documentation</div>
                    </a>
                </li>
            @endif

            <li role="menuitem">
                <a href="#" target="_blank" aria-label="Support">
                    <div class="parent-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="#2196f3" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10"/>
                            <rect x="10" y="6" width="4" height="12" rx="2" fill="#fff"/>
                        </svg>
                    </div>
                    <div class="menu-title">Support</div>
                </a>
            </li>
        </ul>
    </nav>
</div>

<style>
    .submenu {
        display: none;
    }
    .has-arrow.active + .submenu {
        display: block;
    }
    body {
        background: linear-gradient(135deg, #fdf1e3 0%, #f7e9d7 100%) !important;
    }
    .active-menu > a {
        background: #ffe0b2;
        border-radius: 12px;
        font-weight: bold;
        color: #ff9800 !important;
    }
    .active-menu .parent-icon svg {
        filter: drop-shadow(0 0 4px #ff9800aa);
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fermer tous les sous-menus au chargement de la page
        $('.submenu').slideUp();
        $('.has-arrow').attr('aria-expanded', 'false').removeClass('active');

        // Gérer l'ouverture/fermeture des sous-menus au clic
        $('.has-arrow').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $menu = $this.next('.submenu');
            var isExpanded = $this.attr('aria-expanded') === 'true';

            // Fermer les autres sous-menus
            $('.submenu').not($menu).slideUp();
            $('.has-arrow').not($this).attr('aria-expanded', 'false').removeClass('active');

            // Basculer le sous-menu cliqué
            $menu.slideToggle();
            $this.attr('aria-expanded', !isExpanded).toggleClass('active');
        });
    });

    function toggleSidebar() {
        $('.sidebar-wrapper').toggleClass('sidebar-collapsed');
        $('.toggle-icon i').toggleClass('bx-chevrons-left bx-chevrons-right');
    }
</script>