<!-- Section pour encourager l'inscription avec un formulaire -->
<section class="overflow-hidden register-area section-padding dot-bg">
    <!-- Conteneur principal pour le formulaire et le contenu -->
    <div class="container">
        <div class="row">
            <!-- Colonne avec le formulaire d'inscription -->
            <div class="col-lg-5">
                <div class="card card-item register-card">
                    <div class="card-body">
                        <!-- Titre du formulaire -->
                        <h3 class="pb-2 fs-24 font-weight-semi-bold">Accédez à des cours gratuits</h3>
                        <!-- Séparateur visuel -->
                        <div class="divider"><span></span></div>
                        <!-- Formulaire de collecte d'informations -->
                        <form method="post" action="#">
                            @csrf
                            <!-- Champ pour le nom -->
                            <div class="input-box">
                                <label for="name" class="label-text">Nom</label>
                                <div class="form-group">
                                    <input class="form-control form--control" id="name" type="text" name="name"
                                        placeholder="Votre nom" autocomplete="off">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- Fin du champ -->
                            <!-- Champ pour l'email -->
                            <div class="input-box">
                                <label for="email" class="label-text">Email</label>
                                <div class="form-group">
                                    <input class="form-control form--control" id="email" type="email" name="email"
                                        placeholder="Adresse email" autocomplete="off">
                                    <span class="la la-envelope input-icon"></span>
                                </div>
                            </div><!-- Fin du champ -->
                            <!-- Champ pour le numéro de téléphone -->
                            <div class="input-box">
                                <label for="phone" class="label-text">Numéro de téléphone</label>
                                <div class="form-group">
                                    <input class="form-control form--control" id="phone" type="text" name="phone"
                                        placeholder="Numéro de téléphone" autocomplete="off">
                                    <span class="la la-phone input-icon"></span>
                                </div>
                            </div><!-- Fin du champ -->
                        
                            <!-- Bouton de soumission -->
                            <div class="pt-2 btn-box">
                                <button class="btn theme-btn" type="submit">S'inscrire maintenant <i
                                        class="ml-1 la la-arrow-right icon"></i></button>
                            </div><!-- Fin du conteneur du bouton -->
                        </form>
                    </div><!-- Fin du corps de la carte -->
                </div><!-- Fin de la carte -->
            </div><!-- Fin de la colonne -->
            <!-- Colonne avec le contenu promotionnel -->
            <div class="col-lg-6">
                <div class="register-content">
                    <!-- En-tête avec titre et description -->
                    <div class="section-heading">
                        <!-- Ruban pour le sous-titre -->
                        <h5 class="mb-2 ribbon ribbon-lg">Inscription</h5>
                        <!-- Titre principal -->
                        <h2 class="section__title">Progressez avec des parcours d'apprentissage</h2>
                        <!-- Séparateur visuel -->
                        <span class="section-divider"></span>
                        <!-- Description de la section -->
                        <p class="section__desc">Avec EduPlatform, développez vos compétences grâce à des cours variés et flexibles. Nos parcours d'apprentissage sont conçus pour vous aider à atteindre vos objectifs, que vous soyez débutant ou expert, tout en vous offrant une expérience éducative enrichissante.</p>
                    </div><!-- Fin de l'en-tête -->
                    <!-- Bouton d'action -->
                    <div class="btn-box pt-35px">
                        <a href="{{route('register')}}" class="btn theme-btn"><i class="mr-1 la la-user"></i>Commencer</a>
                    </div>
                </div><!-- Fin du contenu -->
            </div><!-- Fin de la colonne -->
        </div><!-- Fin de la grille -->
    </div><!-- Fin du conteneur -->
</section><!-- Fin de la section -->
<style>
    @media (min-width: 992px) {
    .register-area .col-lg-5, .register-area .col-lg-6 {
        flex: 0 0 50%;
        max-width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .register-card {
        min-height: 480px; /* Ajuste selon le besoin */
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .register-card .card-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
}
</style>
