@php
$setting = App\Models\SiteSetting::find(1);
@endphp


<div class="shadow-sm off-canvas-menu-close dashboard-menu-close icon-element icon-element-sm" data-toggle="tooltip" data-placement="left" title="Close menu">
    <i class="la la-times"></i>
</div><!-- end off-canvas-menu-close -->
<div class="px-4 logo-box">
    <a href="{{ route('index') }}" class="logo"><img src="{{ asset($setting->logo) }}" alt="logo"></a>
</div>
<ul class="generic-list-item off-canvas-menu-list off--canvas-menu-list pt-35px">
    <li class="@if (Route::currentRouteNamed('dashboard')) active-menu @endif">
        <a href="{{route('dashboard')}}">
            <div class="parent-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="#ff9800" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
            </div>
            Tableau de bord
        </a>
    </li>
    <li class="@if (Route::currentRouteNamed('user.profile')) active-menu @endif">
        <a href="{{ route('user.profile') }}">
            <div class="parent-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="#ffb300" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M12 14c-4.41 0-8 1.79-8 4v2h16v-2c0-2.21-3.59-4-8-4z"/>
                </svg>
            </div>
            Mon Profil
        </a>
    </li>


    <li class="@if (Route::currentRouteNamed('my.course')) active-menu @endif">
        <a href="{{route('my.course')}}">
            <div class="parent-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="#2196f3" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                    <rect x="7" y="8" width="10" height="2" fill="#fff"/>
                    <rect x="7" y="12" width="6" height="2" fill="#fff"/>
                </svg>
            </div>
            Mes Cours
        </a>
    </li>



    {{-- <li>
        <a href="dashboard-quiz.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="18px" viewBox="0 0 24 24" width="18px"><g><rect fill="none" height="24" width="24"/></g><g><path d="M11,21h-1l1-7H7.5c-0.88,0-0.33-0.75-0.31-0.78C8.48,10.94,10.42,7.54,13.01,3h1l-1,7h3.51c0.4,0,0.62,0.19,0.4,0.66 C12.97,17.55,11,21,11,21z"/></g></svg> Quiz Attempts</a>
    </li> --}}

    {{--============================ wishlist =============================== --}}
    <li  class="@if (Route::currentRouteNamed('user.wishlist')) active-menu @endif">
        <a href="{{ route('user.wishlist') }}">
            <div class="parent-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="#e040fb" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
            Liste de souhaits <span class="p-1 ml-2 badge badge-info" id="wishlistquantity">2</span>
        </a>
    </li>
   
    <li class="@if (Route::currentRouteNamed('live.chat')) active-menu @endif">
        <a href="{{ route('live.chat') }}">
            <div class="parent-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="#00bcd4" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="7" width="18" height="10" rx="2"/>
                    <rect x="7" y="11" width="10" height="2" fill="#fff"/>
                </svg>
            </div>
            Messages <span class="p-1 ml-2 badge badge-info">2</span>
        </a>
    </li>


    {{-- <li>
        <a href="dashboard-reviews.html"><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M22 9.24l-7.19-.62L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27 18.18 21l-1.63-7.03L22 9.24zM12 15.4l-3.76 2.27 1-4.28-3.32-2.88 4.38-.38L12 6.1l1.71 4.04 4.38.38-3.32 2.88 1 4.28L12 15.4z"/></svg> Reviews</a>
    </li> --}}




    <li>
        <a href="#">
            <div class="parent-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="#607d8b" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10"/>
                    <rect x="10" y="6" width="4" height="12" rx="2" fill="#fff"/>
                </svg>
            </div>
            Changer le mot de passe
        </a>
    </li>

    <li class="@if (Route::currentRouteNamed('user.logout')) active-menu @endif">
        <a href="{{ route('user.logout') }}">
            <div class="parent-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="#ff9800" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                </svg>
            </div>
            Déconnexion
        </a>
    </li>

    
</ul>
<style>
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
