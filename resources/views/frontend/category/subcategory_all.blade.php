@extends('frontend.master')

@section('title')
{{ $subcategory->subcategory_name }} | EduPlatform
@endsection

@section('home')
<!-- Fil d'Ariane -->
<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="flex-wrap breadcrumb-content d-flex align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="text-white section__title">{{ $subcategory->subcategory_name }}</h2>
            </div>
            <nav aria-label="Fil d'Ariane">
                <ul class="flex-wrap generic-list-item generic-list-item-white generic-list-item-arrow d-flex align-items-center">
                    <li><a href="{{ url('/') }}" aria-label="Retour à l'accueil">Accueil</a></li>
                    <li><a href="{{ url('category/' . $subcategory->category->id . '/' . $subcategory->category->category_slug) }}">{{ $subcategory->category->category_name }}</a></li>
                    <li>{{ $subcategory->subcategory_name }}</li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- Zone des cours -->
<section class="course-area section--padding">
    <div class="container">
        <div class="mb-4 filter-bar">
            <div class="flex-wrap filter-bar-inner d-flex align-items-center justify-content-between">
                <p class="fs-14">Nous avons trouvé <span class="text-black">{{ $courses->total() }}</span> cours disponibles pour vous</p>
                <div class="flex-wrap d-flex align-items-center">
                    <ul class="mr-3 filter-nav">
                        <li><a href="{{ url()->current() }}?view=grid" data-toggle="tooltip" data-placement="top" title="Vue grille" class="active" aria-label="Vue grille"><span class="la la-th-large"></span></a></li>
                        <li><a href="{{ url()->current() }}?view=list" data-toggle="tooltip" data-placement="top" title="Vue liste" aria-label="Vue liste"><span class="la la-list"></span></a></li>
                    </ul>
                    <div class="select-container select--container">
                        <select class="select-container-select" aria-label="Trier les cours">
                            <option value="all-category">Toutes les catégories</option>
                            <option value="newest">Cours les plus récents</option>
                            <option value="oldest">Cours les plus anciens</option>
                            <option value="high-rated">Les mieux notés</option>
                            <option value="popular-courses">Cours populaires</option>
                            <option value="high-to-low">Prix : décroissant</option>
                            <option value="low-to-high">Prix : croissant</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="mb-5 sidebar">
                    <!-- Champ de recherche -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Rechercher</h3>
                            <div class="divider"><span></span></div>
                            <form method="GET" action="{{ url()->current() }}">
                                <div class="mb-0 form-group">
                                    <input class="pl-3 form-control form--control" type="text" name="search" placeholder="Rechercher des cours" aria-label="Rechercher des cours">
                                    <span class="la la-search search-icon"></span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Catégories de cours -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Catégories de cours</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item">
                                @forelse ($categories as $category)
                                    <li><a href="{{ url('category/' . $category->id . '/' . $category->category_slug) }}">{{ $category->category_name }}</a></li>
                                @empty
                                    <li>Aucune catégorie disponible.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                    <!-- Filtres par évaluation -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Évaluations</h3>
                            <div class="divider"><span></span></div>
                            @php
                                $ratings = [
                                    5 => ['label' => '5.0', 'count' => 20230],
                                    4 => ['label' => '4.5 et plus', 'count' => 10230],
                                    3 => ['label' => '3.0 et plus', 'count' => 7230],
                                    2 => ['label' => '2.0 et plus', 'count' => 5230],
                                    1 => ['label' => '1.0 et plus', 'count' => 3230],
                                ];
                            @endphp
                            @foreach ($ratings as $stars => $data)
                                <div class="mb-1 custom-control custom-radio fs-15">
                                    <input type="radio" class="custom-control-input" id="rating{{ $stars }}" name="rating" value="{{ $stars }}" aria-label="Filtrer par {{ $data['label'] }} étoiles">
                                    <label class="custom-control-label custom--control-label" for="rating{{ $stars }}">
                                        <span class="rating-wrap d-flex align-items-center">
                                            <span class="review-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span class="la {{ $i <= $stars ? 'la-star' : 'la-star-o' }}"></span>
                                                @endfor
                                            </span>
                                            <span class="pl-1 rating-total"><span class="mr-1 text-black">{{ $data['label'] }}</span>({{ number_format($data['count']) }})</span>
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Filtres par sous-catégorie -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Sous-catégories</h3>
                            <div class="divider"><span></span></div>
                            @php
                                $subcategories = [
                                    ['name' => 'Business', 'count' => 12300],
                                    ['name' => 'UI & UX', 'count' => 12300],
                                    ['name' => 'Animation', 'count' => 12300],
                                    ['name' => 'Game Design', 'count' => 12300],
                                    ['name' => 'Graphic Design', 'count' => 12300],
                                    ['name' => 'Typography', 'count' => 12300],
                                    ['name' => 'Web Development', 'count' => 12300],
                                    ['name' => 'Photography', 'count' => 12300],
                                    ['name' => 'Finance', 'count' => 12300],
                                ];
                            @endphp
                            @foreach ($subcategories as $index => $subcategory)
                                @if ($index < 4)
                                    <div class="mb-1 custom-control custom-checkbox fs-15">
                                        <input type="checkbox" class="custom-control-input" id="subcat{{ $index }}" name="subcategory[]" value="{{ $subcategory['name'] }}" aria-label="Filtrer par {{ $subcategory['name'] }}">
                                        <label class="text-black custom-control-label custom--control-label" for="subcat{{ $index }}">
                                            {{ $subcategory['name'] }}<span class="ml-1 text-gray">({{ number_format($subcategory['count']) }})</span>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            <div class="collapse" id="collapseMore">
                                @foreach ($subcategories as $index => $subcategory)
                                    @if ($index >= 4)
                                        <div class="mb-1 custom-control custom-checkbox fs-15">
                                            <input type="checkbox" class="custom-control-input" id="subcat{{ $index }}" name="subcategory[]" value="{{ $subcategory['name'] }}" aria-label="Filtrer par {{ $subcategory['name'] }}">
                                            <label class="text-black custom-control-label custom--control-label" for="subcat{{ $index }}">
                                                {{ $subcategory['name'] }}<span class="ml-1 text-gray">({{ number_format($subcategory['count']) }})</span>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="collapse-btn collapse--btn fs-15" data-toggle="collapse" href="#collapseMore" role="button" aria-expanded="false" aria-controls="collapseMore">
                                <span class="collapse-btn-hide">Voir plus<i class="ml-1 la la-angle-down fs-14"></i></span>
                                <span class="collapse-btn-show">Voir moins<i class="ml-1 la la-angle-up fs-14"></i></span>
                            </a>
                        </div>
                    </div>

                    <!-- Filtres par niveau -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Niveau</h3>
                            <div class="divider"><span></span></div>
                            @php
                                $levels = [
                                    ['name' => 'Tous les niveaux', 'value' => 'all', 'count' => 20300],
                                    ['name' => 'Débutant', 'value' => 'beginner', 'count' => 5300],
                                    ['name' => 'Intermédiaire', 'value' => 'intermediate', 'count' => 3300],
                                    ['name' => 'Expert', 'value' => 'expert', 'count' => 1300],
                                ];
                            @endphp
                            @foreach ($levels as $index => $level)
                                <div class="mb-1 custom-control custom-checkbox fs-15">
                                    <input type="checkbox" class="custom-control-input" id="level{{ $index }}" name="level[]" value="{{ $level['value'] }}" aria-label="Filtrer par niveau {{ $level['name'] }}">
                                    <label class="text-black custom-control-label custom--control-label" for="level{{ $index }}">
                                        {{ $level['name'] }}<span class="ml-1 text-gray">({{ number_format($level['count']) }})</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Filtres par coût -->
                    <div class="card card-item shadow-sm">
                        <div class="card-body">
                            <h3 class="pb-2 card-title fs-18">Par coût</h3>
                            <div class="divider"><span></span></div>
                            @php
                                $costs = [
                                    ['name' => 'Payant', 'value' => 'paid', 'count' => 19300],
                                    ['name' => 'Gratuit', 'value' => 'free', 'count' => 1300],
                                    ['name' => 'Tous', 'value' => 'all', 'count' => 20300],
                                ];
                            @endphp
                            @foreach ($costs as $index => $cost)
                                <div class="mb-1 custom-control custom-checkbox fs-15">
                                    <input type="checkbox" class="custom-control-input" id="cost{{ $index }}" name="cost[]" value="{{ $cost['value'] }}" aria-label="Filtrer par coût {{ $cost['name'] }}">
                                    <label class="text-black custom-control-label custom--control-label" for="cost{{ $index }}">
                                        {{ $cost['name'] }}<span class="ml-1 text-gray">({{ number_format($cost['count']) }})</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des cours -->
            <div class="col-lg-8">
                <div class="row">
                    @forelse ($courses as $course)
                        @php
                            $reviews = $course->reviews()->where('status', 1)->get();
                            $averageRating = $reviews->avg('rating') ?? 0;
                            $reviewCount = $reviews->count();
                            $discount = $course->selling_price - $course->discount_price;
                            $discountPer = $course->selling_price ? round($discount / $course->selling_price * 100) : 0;
                        @endphp
                        <div class="col-lg-6 responsive-column-half">
                            <div class="card card-item card-preview shadow-sm">
                                <div class="card-image">
                                    <a href="{{ url('course/details/' . $course->id . '/' . $course->course_name_slug) }}" class="d-block">
                                        <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" alt="Image du cours {{ $course->course_name }}">
                                    </a>
                                    <div class="course-badge-labels">
                                        @if ($course->bestseller == 1)
                                            <div class="course-badge">Best-seller</div>
                                        @endif
                                        @if ($course->highestrated == 1)
                                            <div class="course-badge sky-blue">Mieux noté</div>
                                        @endif
                                        @if ($course->featured == 1)
                                            <div class="course-badge">Mis en avant</div>
                                        @endif
                                        @if ($course->discount_price == null)
                                            <div class="course-badge blue">Nouveau</div>
                                        @else
                                            <div class="course-badge blue">-{!! $discountPer !!}%</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-3 ribbon ribbon-blue-bg fs-14">
                                        @switch($course->label)
                                            @case('Beginner') Débutant @break
                                            @case('Intermediate') Intermédiaire @break
                                            @case('Advanced') Avancé @break
                                            @default Inconnu
                                        @endswitch
                                    </h6>
                                    <h5 class="card-title"><a href="{{ url('course/details/' . $course->id . '/' . $course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                                    <p class="card-text"><a href="{{ route('instructor.details', $course->instructor_id) }}">{{ $course->user->name }}</a></p>
                                    <div class="py-2 rating-wrap d-flex align-items-center">
                                        <div class="review-stars">
                                            <span class="rating-number">{{ round($averageRating, 1) }}</span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="la {{ $i <= round($averageRating) ? 'la-star' : 'la-star-o' }}"></span>
                                            @endfor
                                        </div>
                                        <span class="pl-1 rating-total">({{ number_format($reviewCount) }})</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($course->discount_price == null)
                                            <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->selling_price }}</p>
                                        @else
                                            <p class="text-black card-price font-weight-bold">{{ $setting->currency }}{{ $course->discount_price }} <span class="before-price font-weight-medium">{{ $setting->currency }}{{ $course->selling_price }}</span></p>
                                        @endif
                                        <div class="shadow-sm cursor-pointer icon-element icon-element-sm" title="Ajouter à la liste de souhaits" id="{{ $course->id }}" onclick="addToWishList(this.id)" aria-label="Ajouter à la liste de souhaits">
                                            <i class="la la-heart-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12">
                            <p class="text-center">Aucun cours disponible dans cette sous-catégorie.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="pt-3 text-center">
                    <nav aria-label="Navigation de la pagination">
                        {{ $courses->links('pagination::bootstrap-4') }}
                    </nav>
                    <p class="pt-2 fs-14">Affichage de {{ $courses->firstItem() }} à {{ $courses->lastItem() }} sur {{ $courses->total() }} résultats</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection