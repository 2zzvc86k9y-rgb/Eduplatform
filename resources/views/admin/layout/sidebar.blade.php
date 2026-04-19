<!-- Barre latérale d'administration avec menu déroulant -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/sidebar.css') }}">
<div class="sidebar-wrapper" data-simplebar>
    <!-- En-tête de la barre latérale -->
    <div class="sidebar-header">
        <!-- Icône du logo -->
        <div><a href="{{ route('index') }}">
            <img src="{{ asset('backend/assets/images/edulog.png') }}" class="logo-icon" alt="Icône du logo EduPlatform">
        </a>
        </div>
        <!-- Texte du logo -->
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <!-- Bouton pour réduire/afficher la barre -->
        <div class="toggle-icon ms-auto" onclick="toggleSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M13.78 15.28a.75.75 0 01-1.06 0l-5-5a.75.75 0 010-1.06l5-5a.75.75 0 111.06 1.06L9.06 10l4.72 4.72a.75.75 0 010 1.06z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <!-- Navigation -->
    <ul class="metismenu" id="menu">
        <!-- Tableau de bord -->
        <li class="@if (Route::currentRouteNamed('admin.dashboard')) active-menu @endif">
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#ff9800" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                </div>
                <div class="menu-title">Tableau de bord</div>
            </a>
        </li>

        <!-- Gérer les catégories -->
        <li class="menu-item @if (Route::currentRouteNamed('all.category') || Route::currentRouteNamed('all.subcategory')) active-menu @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#2196f3" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 3H3v18h18V3zm-2 16H5V5h14v14z"/>
                        <rect x="7" y="7" width="4" height="4" rx="1"/>
                        <rect x="13" y="7" width="4" height="4" rx="1"/>
                        <rect x="7" y="13" width="4" height="4" rx="1"/>
                        <rect x="13" y="13" width="4" height="4" rx="1"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer catégories</div>
            </a>
            <ul class="submenu @if (Route::currentRouteNamed('all.category') || Route::currentRouteNamed('all.subcategory')) mm-show @endif">
                <li><a href="{{ route('all.category') }}">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle">
                        <circle cx="12" cy="12" r="5"/>
                    </svg>
                    Toutes les catégories
                </a></li>
                <li><a href="{{ route('all.subcategory') }}"><i class='bx bx-radio-circle'></i>Toutes les sous-catégories</a></li>
            </ul>
        </li>

        <!-- Gérer les instructeurs -->
        <li class="@if (Route::currentRouteNamed('all.instructor')) active-menu @endif">
            <a href="{{ route('all.instructor') }}">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#ffb300" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M12 14c-4.41 0-8 1.79-8 4v2h16v-2c0-2.21-3.59-4-8-4z"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les instructeurs</div>
            </a>
        </li>

        <!-- Gérer les cours -->
        <li class="@if (Route::currentRouteNamed('admin.all.courses')) active-menu @endif">
            <a href="{{ route('admin.all.courses') }}">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#2196f3" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <rect x="7" y="8" width="10" height="2" fill="#fff"/>
                        <rect x="7" y="12" width="6" height="2" fill="#fff"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les cours</div>
            </a>
        </li>

        <!-- Gérer les coupons -->
        <li class="@if (Route::currentRouteNamed('admin.all.cupon')) active-menu @endif">
            <a href="{{ route('admin.all.cupon') }}">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#ab47bc" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="7" width="18" height="10" rx="2"/>
                        <circle cx="7" cy="12" r="1.5" fill="#fff"/>
                        <circle cx="17" cy="12" r="1.5" fill="#fff"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les coupons</div>
            </a>
        </li>

        <!-- Gérer les commandes -->
        <li class="menu-item @if (Route::currentRouteNamed('admin.pending.order') || Route::currentRouteNamed('admin.confirm.order')) active-menu @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#4caf50" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="7" width="18" height="10" rx="2"/>
                        <rect x="7" y="11" width="10" height="2" fill="#fff"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les commandes</div>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('admin.pending.order') }}"><i class='bx bx-radio-circle'></i>Commandes en attente</a></li>
                <li><a href="{{ route('admin.confirm.order') }}"><i class='bx bx-radio-circle'></i>Commandes confirmées</a></li>
            </ul>
        </li>

        <!-- Gérer les rapports -->
        <li class="@if (Route::currentRouteNamed('admin.all.report.view')) active-menu @endif">
            <a href="{{ route('admin.all.report.view') }}">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#00bcd4" xmlns="http://www.w3.org/2000/svg">
                        <rect x="5" y="14" width="3" height="5" rx="1.5"/>
                        <rect x="10.5" y="10" width="3" height="9" rx="1.5"/>
                        <rect x="16" y="7" width="3" height="12" rx="1.5"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les rapports</div>
            </a>
        </li>

        <!-- Gérer les avis -->
        <li class="menu-item @if (Route::currentRouteNamed('admin.pending.review') || Route::currentRouteNamed('admin.active.review')) active-menu @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#e040fb" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les avis</div>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('admin.pending.review') }}"><i class='bx bx-radio-circle'></i>Avis en attente</a></li>
                <li><a href="{{ route('admin.active.review') }}"><i class='bx bx-radio-circle'></i>Avis actifs</a></li>
            </ul>
        </li>

        <!-- Gérer les utilisateurs -->
        <li class="menu-item @if (Route::currentRouteNamed('admin.all.users') || Route::currentRouteNamed('admin.all.instructor')) active-menu @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#ffb300" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M12 14c-4.41 0-8 1.79-8 4v2h16v-2c0-2.21-3.59-4-8-4z"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer utilisateurs</div>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('admin.all.users') }}"><i class='bx bx-radio-circle'></i>Tous les utilisateurs</a></li>
                <li><a href="{{ route('admin.all.instructor') }}"><i class='bx bx-radio-circle'></i>Tous les instructeurs</a></li>
            </ul>
        </li>

        <!-- Gérer les blogs -->
        <li class="menu-item @if (Route::currentRouteNamed('blog.category') || Route::currentRouteNamed('blog.posts')) active-menu @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#2196f3" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <rect x="7" y="8" width="10" height="2" fill="#fff"/>
                        <rect x="7" y="12" width="6" height="2" fill="#fff"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les blogs</div>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('blog.category') }}"><i class='bx bx-radio-circle'></i>Catégories de blog</a></li>
                <li><a href="{{ route('blog.posts') }}"><i class='bx bx-radio-circle'></i>Articles de blog</a></li>
            </ul>
        </li>

        <!-- Gérer les paramètres -->
        <li class="menu-item @if (Route::currentRouteNamed('admin.frontend.sitesettings') || Route::currentRouteNamed('admin.all.smtp')) active-menu @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#607d8b" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10"/>
                        <rect x="10" y="6" width="4" height="12" rx="2" fill="#fff"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les paramètres</div>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('admin.frontend.sitesettings') }}"><i class='bx bx-radio-circle'></i>Paramètres du site</a></li>
                <li><a href="{{ route('admin.all.smtp') }}"><i class='bx bx-radio-circle'></i>Paramètres SMTP</a></li>
            </ul>
        </li>

        <!-- Gérer les rôles et permissions -->
        <li class="menu-item @if (Route::currentRouteNamed('admin.all.permission') || Route::currentRouteNamed('admin.all.role') || Route::currentRouteNamed('admin.role.permission') || Route::currentRouteNamed('admin.all.role.permission')) active-menu @endif">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#00bcd4" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M12 14c-4.41 0-8 1.79-8 4v2h16v-2c0-2.21-3.59-4-8-4z"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les rôles et permissions</div>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('admin.all.permission') }}"><i class='bx bx-radio-circle'></i>Toutes les permissions</a></li>
                <li><a href="{{ route('admin.all.role') }}"><i class='bx bx-radio-circle'></i>Tous les rôles</a></li>
                <li><a href="{{ route('admin.role.permission') }}"><i class='bx bx-radio-circle'></i>Rôle dans permission</a></li>
                <li><a href="{{ route('admin.all.role.permission') }}"><i class='bx bx-radio-circle'></i>Tous les rôles dans permissions</a></li>
            </ul>
        </li>

        <!-- Gérer les administrateurs -->
        <li class="menu-item">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#ff9800" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="8" r="4"/>
                        <path d="M12 14c-4.41 0-8 1.79-8 4v2h16v-2c0-2.21-3.59-4-8-4z"/>
                    </svg>
                </div>
                <div class="menu-title">Gérer les administrateurs</div>
            </a>
            <ul class="submenu">
                <li class="@if (Route::currentRouteNamed('manage.all.admin')) active-menu @endif"><a href="{{ route('manage.all.admin') }}"><i class='bx bx-radio-circle'></i>Tous les administrateurs</a></li>
            </ul>
        </li>

        <!-- Support -->
        <li class="menu-item">
            <a href="#" target="_blank">
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
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/metismenu@3.0.7/dist/metismenu.min.js"></script>
<script>
    $(document).ready(function() {
        $('#menu').metisMenu();
    });

    function toggleSidebar() {
        $('.sidebar-wrapper').toggleClass('sidebar-collapsed');
        $('.toggle-icon i').toggleClass('bx-chevrons-left bx-chevrons-right');
    }
</script>

<style>
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
