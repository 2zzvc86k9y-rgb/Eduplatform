{{-- 
    Commentaire original : Accès direct aux données de la base sans contrôleur en Blade, utilisant le modèle.
    La fonction 'limit' de Laravel permet d'afficher un sous-ensemble des données (ex. : 6 catégories sur 100).
    Traduction : Aucun texte à traduire dans ce commentaire, conservé tel quel pour clarté.
--}}

@php
    $category = App\Models\Category::latest()->limit(6)->get();
@endphp

<!-- Section "Catégories" de la page, traduite directement en français avec commentaires -->
<section class="category-area pb-90px">
    <!-- Conteneur principal avec padding inférieur de 90px -->
    <div class="container">
        <!-- Grille centrée pour l'en-tête -->
        <div class="row align-items-center text-center">
            <div class="col-lg-12">
                <div class="category-content-wrap">
                    <!-- En-tête de la section -->
                    <div class="section-heading">
                        <!-- Ruban/titre secondaire, traduit de "Categories" à "Catégories" -->
                        <!-- Le style "ribbon ribbon-lg" applique un design de ruban -->
                        <h5 class="mb-2 ribbon ribbon-lg">Catégories</h5>
                        <!-- Titre principal, traduit de "Popular Categories" à "Catégories populaires" -->
                        <!-- Intègre le contexte d'EduPlatform -->
                        <h2 class="section__title">Catégories populaires d'EduPlatform</h2>
                        <!-- Séparateur visuel, inchangé -->
                        <span class="section-divider"></span>
                    </div><!-- Fin de l'en-tête de section -->
                </div>
            </div><!-- Fin de la colonne pleine largeur -->
        </div><!-- Fin de la grille d'en-tête -->
        <!-- Conteneur pour les cartes de catégories -->
        <div class="category-wrapper mt-30px">
            <div class="row">
                @foreach ($category as $item)
                @php
                    $course = App\Models\Course::where('category_id', $item->id)->get();
                @endphp
                <!-- Carte pour chaque catégorie, occupe 4/12 de la largeur sur grand écran -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="category-item">
                        <!-- Image de la catégorie, dynamique depuis la base de données -->
                        <!-- Texte alternatif traduit de "Category image" à "Image de la catégorie" -->
                        <img class="cat__img lazy" src="{{ asset($item->photo) }}"
                            data-src="images/img1.jpg" alt="Image de la catégorie">
                        <div class="category-content">
                            <div class="category-inner">
                                <!-- Nom de la catégorie, dynamique, inchangé car géré par la base de données -->
                                <!-- Le lien est un placeholder (#), à vérifier -->
                                <h3 class="cat__title"><a href="#">{{ $item->category_name }}</a></h3>
                                @if ($course->count() > 0)
                                <!-- Nombre de cours, traduit implicitement par le contexte -->
                                <!-- Affiche le nombre de cours dans la catégorie -->
                                <p class="cat__meta">{{ $course->count() }} cours</p>
                                @endif
                                <!-- Bouton, traduit de "Explore" à "Explorer" -->
                                <!-- Lien vers la page de la catégorie, icône flèche inchangée -->
                                <a href="{{ url('category/'.$item->id.'/'.$item->category_slug) }}" class="btn theme-btn theme-btn-sm theme-btn-white">Explorer<i
                                        class="ml-1 la la-arrow-right icon"></i></a>
                            </div>
                        </div><!-- Fin du contenu de la catégorie -->
                    </div><!-- Fin de la carte de catégorie -->
                </div><!-- Fin de la colonne -->
                @endforeach
            </div><!-- Fin de la grille des catégories -->
        </div><!-- Fin du conteneur des catégories -->
    </div><!-- Fin du conteneur principal -->
</section><!-- Fin de la section "Catégories" -->

<style>
.cat__title {
    font-weight: 700;
    font-size: 1.2rem;
    margin-bottom: 8px;
    color: #233d63;
}
.cat__meta {
    display: inline-block;
    background: linear-gradient(90deg, #3578e5 0%, #38f9d7 100%);
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 2px 14px;
    font-size: 0.95em;
    margin-bottom: 10px;
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