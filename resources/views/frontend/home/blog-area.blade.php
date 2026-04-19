@php
    $blog = App\Models\BlogPost::latest()->get();
@endphp

<!-- Section "Blog" de la page, traduite directement en français avec commentaires -->
<section class="overflow-hidden blog-area section--padding bg-gray">
    <!-- Conteneur principal avec fond gris et padding -->
    <div class="container">
        <!-- En-tête centré de la section -->
        <div class="text-center section-heading">
            <!-- Ruban/titre secondaire, traduit de "News feeds" à "Actualités" -->
            <!-- Le style "ribbon ribbon-lg" applique un design de ruban -->
            <h5 class="mb-2 ribbon ribbon-lg">Actualités</h5>
            <!-- Titre principal, traduit de "Latest News & Articles" à "Dernières nouvelles et articles" -->
            <!-- Intègre le contexte d'EduPlatform -->
            <h2 class="section__title">Dernières nouvelles et articles d'EduPlatform</h2>
            <!-- Séparateur visuel, inchangé -->
            <span class="section-divider"></span>
        </div><!-- Fin de l'en-tête de section -->
        <!-- Carrousel des articles de blog, utilisant Owl Carousel -->
        <div class="blog-post-carousel owl-action-styled half-shape mt-30px">
            @foreach($blog as $item)
            <!-- Carte pour chaque article de blog -->
            <div class="card card-item">
                <div class="card-image">
                    <!-- Lien vers la page de détails de l'article, image dynamique -->
                    <a href="{{url('blog/details/'.$item->post_slug)}}" class="d-block">
                        <img class="card-img-top" src="{{asset($item->post_image)}}" alt="Image de l'article">
                    </a>
                    <div class="course-badge-labels">
                        <!-- Date de publication, format inchangé mais contexte traduit -->
                        <!-- Affiche la date de création de l'article -->
                        <div class="course-badge">{{$item->created_at->format('M d Y')}}</div>
                    </div>
                </div><!-- Fin de l'image de la carte -->
                <div class="card-body">
                    <!-- Titre de l'article, dynamique, inchangé car géré par la base de données -->
                    <!-- Le lien pointe vers les détails de l'article -->
                    <h5 class="card-title"><a href="{{url('blog/details/'.$item->post_slug)}}">{{$item->post_title}}</a></h5>
                    <!-- Liste des métadonnées de l'article -->
                    <ul class="flex-wrap pt-2 generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                        <!-- Auteur, traduit de "By TechyDevs" à "Par EduPlatform" -->
                        <!-- "TechyDevs" remplacé par "EduPlatform" pour refléter votre marque -->
                        <li class="d-flex align-items-center">Par <a href="#">EduPlatform</a></li>
                        <!-- Nombre de commentaires, traduit de "4 Comments" à "4 commentaires" -->
                        <!-- Valeur statique, à rendre dynamique si possible -->
                        <li class="d-flex align-items-center"><a href="#">4 commentaires</a></li>
                        <!-- Nombre de likes, traduit de "130 Likes" à "130 j'aime" -->
                        <!-- Valeur statique, à rendre dynamique si possible -->
                        <li class="d-flex align-items-center"><a href="#">130 j'aime</a></li>
                    </ul>
                    <!-- Conteneur pour le bouton et les icônes de partage -->
                    <div class="pt-3 d-flex justify-content-between align-items-center">
                        <!-- Bouton, traduit de "Read More" à "Lire la suite" -->
                        <!-- Lien vers les détails de l'article, icône flèche inchangée -->
                        <a href="{{url('blog/details/'.$item->post_slug)}}" class="btn theme-btn theme-btn-sm theme-btn-white">Lire la suite <i class="ml-1 la la-arrow-right icon"></i></a>
                        <div class="share-wrap">
                            <!-- Icônes de partage sur les réseaux sociaux -->
                            <ul class="social-icons social-icons-styled">
                                <li class="mr-0"><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                <li class="mr-0"><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                <li class="mr-0"><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                            </ul>
                            <!-- Bouton pour afficher/masquer les icônes de partage -->
                            <!-- Texte "title" traduit de "Toggle to expand social icons" à "Basculer pour afficher les icônes de partage" -->
                            <div class="shadow-sm cursor-pointer icon-element icon-element-sm share-toggle" title="Basculer pour afficher les icônes de partage"><i class="la la-share-alt"></i></div>
                        </div>
                    </div>
                </div><!-- Fin du corps de la carte -->
            </div><!-- Fin de la carte -->
            @endforeach
        </div><!-- Fin du carrousel des articles -->
    </div><!-- Fin du conteneur -->
</section><!-- Fin de la section "Blog" -->