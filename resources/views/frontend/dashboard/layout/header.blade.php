<header class="header-menu-area">
    <div class="bg-white shadow-sm header-menu-content dashboard-menu-content pr-30px pl-30px">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="logo-box logo--box">
                            <a href="{{ route('index') }}" class="logo">
                                <img src="{{ asset('frontend/images/logo-edu0.png') }}" alt="logo">
                            </a>
                            <div class="user-btn-action">
                                <div class="mr-2 shadow-sm search-menu-toggle icon-element icon-element-sm" data-toggle="tooltip" data-placement="top" title="Rechercher">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="mr-2 shadow-sm off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm" data-toggle="tooltip" data-placement="top" title="Menu des catégories">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="shadow-sm off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm" data-toggle="tooltip" data-placement="top" title="Menu principal">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div><!-- end logo-box -->
                        <div class="menu-wrapper">
                            <form method="post" class="ml-0 mr-auto">
                                <div class="mb-0 form-group">
                                    <input class="pl-3 form-control form--control form--control-gray" type="text" name="search" placeholder="Rechercher...">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                            <div class="nav-right-button d-flex align-items-center">
                                <div class="user-action-wrap d-flex align-items-center">
                                    @php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp
                                    <div class="shop-cart user-profile-cart">
                                        <ul>
                                            <li>
                                                <div class="shop-cart-btn">
                                                    <div class="avatar-xs">
                                                        <img class="rounded-full img-fluid" src="{{ !empty($profileData->photo) ? url('upload/user_image/' . $profileData->photo) : url('upload/noimage.jpg') }}" alt="Avatar">
                                                    </div>
                                                    <span class="dot-status bg-1"></span>
                                                </div>
                                                <ul class="p-0 cart-dropdown-menu after-none notification-dropdown-menu">
                                                    <li class="menu-heading-block d-flex align-items-center">
                                                        <a href="{{ route('user.profile') }}" class="flex-shrink-0 avatar-sm d-block">
                                                            <img class="rounded-full img-fluid" src="{{ !empty($profileData->photo) ? url('upload/user_image/' . $profileData->photo) : url('upload/noimage.jpg') }}" alt="Avatar">
                                                        </a>
                                                        <div class="ml-2">
                                                            <h4><a href="{{ route('user.profile') }}" class="text-black">{{ $profileData->name }}</a></h4>
                                                            <span class="d-block fs-14 lh-20">{{ $profileData->email }}</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="theme-picker d-flex align-items-center justify-content-center lh-40">
                                                            <button class="theme-picker-btn dark-mode-btn w-100 font-weight-semi-bold justify-content-center" title="Mode sombre">
                                                                <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                                                </svg>
                                                                Mode sombre
                                                            </button>
                                                            <button class="theme-picker-btn light-mode-btn w-100 font-weight-semi-bold justify-content-center" title="Mode clair">
                                                                <svg class="mr-1" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
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
                                                                Mode clair
                                                            </button>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <ul class="generic-list-item">
                                                            <li><div class="section-block"></div></li>
                                                            <li>
                                                                <a href="{{ route('my.course') }}">
                                                                    <i class="mr-1 la la-file-text"></i> Mes Cours
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('user.profile') }}">
                                                                    <i class="mr-1 la la-user"></i> Mon Profil
                                                                </a>
                                                            </li>
                                                            <li><div class="section-block"></div></li>
                                                            <li>
                                                                <a href="{{ route('user.logout') }}">
                                                                    <i class="mr-1 la la-power-off"></i> Déconnexion
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div><!-- end shop-cart -->
                                </div>
                            </div><!-- end nav-right-button -->
                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->

    <!-- Main Off Canvas Menu -->
    <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
        <div class="shadow-sm off-canvas-menu-close main-menu-close icon-element icon-element-sm" data-toggle="tooltip" data-placement="left" title="Fermer le menu">
            <i class="la la-times"></i>
        </div>
        <h4 class="off-canvas-menu-heading pt-90px">Notifications</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1 pb-2 border-bottom border-bottom-gray">
            <li><a href="{{ route('dashboard') }}"><i class="la la-dashboard mr-2"></i>Tableau de bord</a></li>
            <li><a href="{{ route('live.chat') }}"><i class="la la-comments mr-2"></i>Messages</a></li>
            <li><a href="{{ route('user.wishlist') }}"><i class="la la-heart-o mr-2"></i>Liste de souhaits</a></li>
        </ul>
        <h4 class="off-canvas-menu-heading pt-20px">Mon Compte</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1 pb-2 border-bottom border-bottom-gray">
            <li><a href="{{ route('user.profile') }}"><i class="la la-user mr-2"></i>Mon Profil</a></li>
            <li><a href="{{ route('my.course') }}"><i class="la la-file-text mr-2"></i>Mes Cours</a></li>
            <li><a href="{{ route('user.change.password') }}"><i class="la la-lock mr-2"></i>Changer le mot de passe</a></li>
            <li><a href="{{ route('user.logout') }}"><i class="la la-power-off mr-2"></i>Déconnexion</a></li>
        </ul>
        </div>

    <!-- Category Off Canvas Menu -->
    <div class="off-canvas-menu custom-scrollbar-styled category-off-canvas-menu">
        <div class="shadow-sm off-canvas-menu-close cat-menu-close icon-element icon-element-sm" data-toggle="tooltip" data-placement="left" title="Fermer le menu">
            <i class="la la-times"></i>
        </div>
        <h4 class="off-canvas-menu-heading pt-90px">Apprentissage</h4>
        <ul class="generic-list-item off-canvas-menu-list pt-1 pb-2 border-bottom border-bottom-gray">
            <li><a href="{{ route('my.course') }}"><i class="la la-graduation-cap mr-2"></i>Mes cours</a></li>
            <li><a href="{{ route('user.wishlist') }}"><i class="la la-heart-o mr-2"></i>Liste de souhaits</a></li>
        </ul>
    </div>

    <!-- Mobile Search Form -->
    <div class="mobile-search-form">
        <div class="d-flex align-items-center">
            <form method="post" class="flex-grow-1 mr-3">
                <div class="form-group mb-0">
                    <input class="form-control form--control pl-3" type="text" name="search" placeholder="Rechercher...">
                    <span class="la la-search search-icon"></span>
                </div>
            </form>
            <div class="search-bar-close icon-element icon-element-sm shadow-sm">
                <i class="la la-times"></i>
            </div>
        </div>
    </div>

    <div class="body-overlay"></div>
</header>

@push('scripts')
<script>
    $(document).ready(function() {
        // Toggle du menu principal
        $('.main-menu-toggle').on('click', function() {
            $('.main-off-canvas-menu').addClass('active');
            $('.body-overlay').addClass('active');
        });

        // Toggle du menu des catégories
        $('.cat-menu-toggle').on('click', function() {
            $('.category-off-canvas-menu').addClass('active');
            $('.body-overlay').addClass('active');
        });

        // Toggle de la recherche mobile
        $('.search-menu-toggle').on('click', function() {
            $('.mobile-search-form').addClass('active');
            $('.body-overlay').addClass('active');
        });

        // Fermeture des menus
        $('.off-canvas-menu-close, .cat-menu-close, .search-bar-close, .body-overlay').on('click', function() {
            $('.off-canvas-menu').removeClass('active');
            $('.mobile-search-form').removeClass('active');
            $('.body-overlay').removeClass('active');
        });
    });
</script>
@endpush
