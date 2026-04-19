<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo"></p>

# EduPlatform

> Plateforme d'apprentissage en ligne développée avec Laravel.

## Présentation

EduPlatform est une plateforme complète d’e-learning permettant la gestion de cours, d’instructeurs et d’étudiants. Elle propose un tableau de bord pour chaque rôle (admin, instructeur, étudiant), la gestion des inscriptions, des paiements, des quiz, des avis, et bien plus.

### Fonctionnalités principales

- Gestion des utilisateurs (admin, instructeur, étudiant)
- Création, modification et gestion des cours
- Tableau de bord personnalisé pour chaque rôle
- Inscription et suivi des étudiants
- Gestion des paiements (Stripe, etc.)
- Génération de certificats PDF
- Système de quiz et d’évaluations
- Gestion des avis et commentaires
- Wishlist (liste de souhaits)
- Notifications

## Installation

1. **Cloner le dépôt**
    ```bash
    git clone https://github.com/VOTRE_UTILISATEUR/NOM_DU_REPO.git
    cd NOM_DU_REPO
    ```
2. **Installer les dépendances**
    ```bash
    composer install
    npm install && npm run build
    ```
3. **Configurer l’environnement**
    - Copier le fichier `.env.example` en `.env` et adapter les variables (base de données, mail, Stripe, etc.)
    - Générer la clé d’application :
      ```bash
      php artisan key:generate
      ```
4. **Migrer la base de données et les seeders**
    ```bash
    php artisan migrate --seed
    ```
5. **Lancer le serveur**
    ```bash
    php artisan serve
    ```

## Utilisation

- Accédez à l’interface via `http://localhost:8000`
- Inscrivez-vous comme étudiant ou demandez à devenir instructeur
- L’admin valide les instructeurs et gère les cours
- Les étudiants peuvent s’inscrire aux cours, suivre leur progression, passer des quiz, etc.

## Technologies

- Laravel 11
- PHP 8.2+
- MySQL/MariaDB
- Stripe (paiement)
- Vue.js (front-end)
- Bootstrap

## Commandes utiles

- Générer un PDF :
  ```bash
  composer require barryvdh/laravel-dompdf
  ```
- Installer le plugin Vue.js :
  ```bash
  npm i @vitejs/plugin-vue
  ```
- Ajouter le panier :
  ```bash
  composer require anayarojo/shoppingcart
  ```

## Contribution

Les contributions sont les bienvenues ! Merci de soumettre vos PR ou issues.

## Licence

Ce projet est sous licence MIT.

==========================>
by using toggle button take the value inactive and active 
## controller value 
    // AllInstructor
    public function AllInstructor(){
        $allinstructor = User::where('role','instructor')->latest()->get();
        return view('admin.backend.instructor.all_instructor',compact('allinstructor'));
    }

    // important code for getting all instructor information

    public function UpdateUserStatus(Request $request)
    {
        $userId = $request->input('user_id');
        $isChecked = $request->input('is_checked', 0); // Default to 0 if not provided
        $user = User::find($userId);
    
        if ($user) {
            $user->status = $isChecked;
            $user->save();
            return redirect()->route('all.instructor');
        } 
    }
    

    ## web.route  admin should be login 
      
    Route::controller(AdminController::class)->group(function(){
        Route::get('/all/instructor','AllInstructor')->name('all.instructor');
        // Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        // Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
        // Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update/userstatus','UpdateUserStatus')->name('update.userstatus');
        // Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
    });

    ## all instructor page manage 
      <td>
                                <form id="statusForm{{ $item->id }}" action="{{ route('update.userstatus') }}" method="POST">
                                    @csrf
                                   
                                    <input type="hidden" name="user_id" value="{{ $item->id }}">
                <input type="hidden" name="is_checked" value="{{ $item->status }}">
                <div class="form-check form-switch">
                    <input class="form-check-input status-toggle" type="checkbox" {{ $item->status == 1 ? 'checked' : '' }} onchange="updateStatus({{ $item->id }}, this)">
                </div>
                                </form>
                            </td>

## js code for update status with status toggle disabled and disabled 
<script>
    function updateStatus(userId, checkbox) {
        let form = document.getElementById('statusForm' + userId);
        form.querySelector('input[name="is_checked"]').value = checkbox.checked ? 1 : 0;
        form.submit();
    }
</script>


    ====================================> finish the update 









  -- teacher details page route -- {{ route('instructor.details',$course->instructor_id) }}
  -- course details url -- {{url('course/details/'.$course->id.'/'.$course->course_name_slug)}}
 -- wishlist  --   id="{{$course->id}}" onclick="addToWishList(this.id)"
 -- blog post details url -- {{url('blog/details/'.$item->post_slug)}}




 --user registration -- {{route('register')}}
 --user login -- {{route('login')}}




 -- pdf generator command -- composer require barryvdh/laravel-dompdf






 Add to cart take form -- https://packagist.org/packages/anayarojo/shoppingcart

 vue js plugin  npm i @vitejs/plugin-vue


