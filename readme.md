# ClicknEat

Projet de réservation de restaurant, en réalisant en même temps la commande de ce qu'on va manger.

## Liens utiles

- Laravel : https://laravel.com/docs/11.x/readme
- Faker : https://fakerphp.org/formatters/

## Models

- Restaurant
    - name
- Client
- Category ===> TODO + SEEDER
    - name
- Item


# Support de cours
Présentation de Laravel et bases

## Artisan
Artisan est une interface utilisable en ligne de commande (CLI - Command Line Interface).

### Utilisation de base
Artisan est basé sur PHP, et nécessite donc l'utilisation de la commande "PHP" pour s'en servir.
Toute commande artisan débute donc par "php artisan".
La commande "php artisan" seule, affichera l'ensemble des commandes disponibles proposées par Artisan.

### Commandes usuelles
- Création de fichiers : Artisan nous permet de générer des fichiers a l'aide de la commande "make". On doit ensuite interposer le symbole ":", puis spécifier le type de fichier que l'on veut créer.
- gestion de la base de données : Artisan nous permet de créer, modifier ou supprimer des tables au sein d'une base de données. Il utilise les fichiers de migration, mais n'exécute chaque migration, que sur les fichiers qui n'ont pas déjà été migrés. Pour cela, il faut utiliser la commande "migrate".
- gestion du cache : Artisan nous permet de nettoyer le cache de manière rapide et simple avec la commande "cache:clear".
- Affichage des routes : Artisan nous permet d'afficher les routes existantes au sein de l'application avec la commande "route:list".
- publication des vendors : Artisan nous permet de publier les dépendances et librairies utilisées au sein d'un projet Laravel. Ceci nous permettant de modifier ces librairies et dépendances sans crainte de voir le travail perdue pour cause de mise à jour. la commande étant "vendor:publish"

## Architecture de Laravel
|- /app  
|----- /Console  
|--------- /Commands : Dossier qui contient toutes les commandes personnalisées créées.  
|----- /Exceptions  
|----- /Http  
|--------- /Controller : Dossier qui contiendra l'ensembe des controleurs  
|------------- controller.php : Controleur de base du framework  
|--------- /Middleware : Dossier qui contiendra l'ensemble des middleware  
|----- /Providers  
|----- User.php : Modèle utilisateur généré automatiquement par Laravel  
|- /bootstrap  
|- /config : Contient les fichiers de configuration de l'application  
|- /database  
|----- /migrations : Contient les fichiers de migrations qui permettent de créer, modifier ou   supprimer une ou plusieurs table(s)  
|- /public : dossier d'entrée de l'application  
|----- index.php : point d'entrée de l'application  
|- /ressources  
|----- /lang : dossier qui contient les fichiers de traductions de l'application  
|----- /views : dossier qui contient l'ensemble des vues du projet  
|- /routes  
|----- api.php : fichier pour déclarer les routes relatives à une API  
|----- web.php : fichier pour déclarer les routes relatives à une application web.  
|- /storage  
|- /tests : dossier contenant les tests unitaires & fonctionnels  
|- /vendor : Contient l'ensemble des dépendances du projet (géré par Composer)  
|- composer.json => le fichier qui permet de lister les dépendances  
|- .env => fichier de configuration de l'application  

## Etapes d'un CRUD
1. Création d'une table en base de données :
    - Création d'un ou plusieurs fichier(s) de migration avec la commande "php artisan make:migration [NOM_DU_FICHIER_DE_MIGRATION]"
    - Migration des fichiers grâce à la commande "php artisan migrate"
2. Création du modèle en lien avec la table créée en base de données :
    - Création du fichier avec la commande "php artisan make:model [NOM_DU_MODEL]"
    - Renseignement du nom de la table en lien avec le nouveau modèle grâce à l'attribut : "protected $table="[NOM_DE_LA_TABLE]";"
    - Renseignement des champs de la table qui peuvent être modifiés grâce au modèle via le tableau unidimensionnel contenu dans l'attribut "protected $fillable=[TABLEAU_DES_CHAMPS]"
3. Création d'une ou plusieurs route(s)
    - Ajout de la / des route(s) dans le fichier "/routes/web.php". Renseignement de l'URL attendue, du contrôleur ainsi que de sa méthode qui doit être appelée au matching de l'URL, puis définition d'un nom sur la route pour facilité son utilisation a posteriori.
4. Création du contrôleur
    - Création du fichier avec la commande "php artisan make:controller [NOM_DU_CONTROLLER]"
    - Définition de la / des méthode(s) en lien avec les routes précédemment créées
    - Penser à retourner les vues à l'issue de chaque méthode du controleur
5. Création des vues
    - Pour chaque vue nécessaire, créer un fichier avec l'extension ".blade.php" dans le dossier "/ressources/views/". Nommer ce fichier de telle sorte à pouvoir l'appeler simplement dans les méthodes des contrôleurs.

## Relations entre entitées

1. Ajouter une foreign key dans votre base de données pour lier une table "A" à une table "B". Ajouter donc un champs "b_id" dans la table "A". Ensuite, déclarer votre foreign dans la migration grâce à : 

    ```
    # b_id est le nom de la colonne créée dans la table représentant le lien vers l'autre table
    # unsigned() permet d'éviter de nombreuses erreurs laravel
    # nullable() vous permet de ne pas rendre obligatoire le remplissage de ce champs.
    $table->bigInteger('b_id')->unsigned()->nullable();

    # le foreign('b_id') indique que c'est le champs 'b_id', créé juste au dessus, qui servira
    # de lien avec l'autre table.
    # references('id)->on('b') signifie que le champs 'b_id' va avoir comme référence (le champs qui va le lié à l'autre table) la colonne 'id', de la table 'b'
    $table->foreign('b_id') 
        ->references('id')
        ->on('b');
    ```

2. Déclarer cette relation dans vos models.
    - Ajouter le champs "b_id" dans l'attribut fillable du model "A"
    - déclarer dans le model "A", la relation avec le model "B", grâce au code suivant : 
    ```
        # le nom de la méthode est arbitraire. Vous pouvez mettre ce que vous souhaitez, cependant c'est ce nom de méthode que vous devrez utiliser avec l'utilisation du "with" plus bas.
        public function b()
        {
            # BelongsTo doit prendre en premier paramètre le nom du model A, puis en second paramètre, le nom du champs dans le modèle courant lié avec le model A grâce à sa foreign key
            return $this->belongsTo(B::class, "b_id");
        }
    ```
    - Vous pouvez déclarer la fonction inverse dans l'autre model pour pouvoir accéder au "with" depuis l'autre model : 
    ```
        # le nom de la méthode est arbitraire. Vous pouvez mettre ce que vous souhaitez, cependant c'est ce nom de méthode que vous devrez utiliser avec l'utilisation du "with" plus bas.
        public function as()
        {
            # la relation inverse se déclare grace a la méthode "hasMany", qui ne prend cette fois en paramètre, que le nom du model "A"
            return $this->hasMany(A::class);
        }
    ```

3. Vous pouvez maintenant vous servir des méthodes "as" et "b" respectivement des modèles "B" et "A" grâce à la méthode "with" d'Eloquent (désormais votre ORM préféré).
Pour cela, vous pouvez par exemple faire l'une des requêtes suivantes : 

```
    # Renverra a la fois le model A, en y incluant dans les relations, l'objet "B" correspondant en base de données
    $obj = A::where('id', $id)->with('b')->first();

    # Renverra a la fois le model B, en y incluant dans les relations, le ou les objets "A" correspondant(s) en base de données
    $obj = B::where('id', $id)->with('as')->first();
```

## Authentification - Breeze

Installer les dépendances de Breeze :
```
composer require laravel/breeze --dev
```


Installer Breeze :
```
php artisan breeze:install
```

Liste des choix : 
- Blade with Alpine
- No
- PEST

Installer les dépendances NPM nécessaires pour que les vues de l'authentification de base fonctionnent : 

```
npm install
```

Builder les vues pour qu'elles soient accessible sans serveur front lancé

```
npm run build
```

A partir de là, les routes `/login` et `/register` sont disponibles et fonctionnelles.

Attention, pensez à sauvegarder vos routes avant 😁

Vous pouvez maintenant restreindre l'accès aux routes en leur appliquant le middleware `auth`. Voici un exemple avec un groupement de routes : 

```
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/{id}/show', [RestaurantController::class, 'show'])->name('restaurants.show');
    Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
    Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
    Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
    Route::put('/restaurants/{id}/update', [RestaurantController::class, 'update'])->name('restaurants.update');
    Route::delete('/restaurants/{id}/destroy', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
```

### Accéder à l'utilisateur courant depuis Blade ou un Controller

```
Auth::user()
```