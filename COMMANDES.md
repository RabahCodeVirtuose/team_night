
## Commandes utilisées

### Symfony
### question 2
- symfony composer install
- symfony console make:entity Animal --api-resource
- symfony console make:entity Observation --api-resource
- symfony console make:migration
- symfony console doctrine:migrations:migrate
- symfony server:start --no-tls --listen-ip=0.0.0.0

## Points d’entrée de l’API

L’API permet d’accéder aux ressources suivantes :

### Animal

- `GET /api/animals` : liste de tous les animaux
- `POST /api/animals` : ajouter un nouvel animal
- `GET /api/animals/{id}` : afficher un animal spécifique
- `DELETE /api/animals/{id}` : supprimer un animal
- `PATCH /api/animals/{id}` : modifier un animal

### Observation

- `GET /api/observations` : liste de toutes les observations
- `POST /api/observations` : ajouter une nouvelle observation
- `GET /api/observations/{id}` : afficher une observation spécifique
- `DELETE /api/observations/{id}` : supprimer une observation
- `PATCH /api/observations/{id}` : modifier une observation



### question 3
- symfony composer require orm-fixtures --dev
- symfony composer require fakerphp/faker
- symfony console make:fixture
- symfony console doctrine:fixture:load
- symfony server:start --no-tls --listen-ip=0.0.0.0

### Angular

### question 4
- ng generate component components/about --standalone
- ng serve --host 0.0.0.0

### question 5
- ng generate service services/animal
- ng generate service services/observation
- ng generate environments
- ng generate interface entity/animal
- ng generate interface entity/observation
- ng generate interface entity/api-response


### question 6
- ng generate component components/animals --standalone
- ng generate component components/details-animal --standalone
- ng generate component components/edit-animal --standalone


### question 7
- ng generate component components/observations --standalone
- ng generate component components/details-observation --standalone
- ng generate component components/edit-observation --standalone
- ng generate component components/select-animals --standalone
- ng add @angular/material
- ng serve --host 0.0.0.0
- symfony server:start --no-tls --listen-ip=0.0.0.0

## question 8
- ng add @angular/material
- ng generate component components/nav-bar --standalone
- ng generate component components/menu --standalone

## question 9
- symfony console make:user
- symfony console m:mig
- symfony console d:m:m
- symfony composer require lexik/jwt-authentication-bundle
- mkdir -p config/jwt 
- openssl genrsa -out config/jwt/private.pem 4096
- openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

- sudo snap install postman
- symfony console lexik:jwt:generate-keypair --overwrite
- ng generate service services/authentication
- ng generate interceptor interceptor/jwt

## question 10
- symfony server:start --no-tls --listen-ip=0.0.0.0
- ng serve --host 0.0.0.0
- symfony console make:entity User --api-resource
- symfony console make:migration
- symfony console doctrine:migrations:migrate

## question 11
Extension de Tri (Tri des Observations)
Description : Cette extension permet d'ajouter une fonctionnalité de tri pour les observations.
L'utilisateur peut trier les résultats selon différents critères, tels que la date ou la description,
ce qui permet d'afficher les observations dans un ordre logique et pertinent pour l'utilisateur


et Recherche Avancée (Recherche par Plusieurs Critères)
Description : Cette extension permet d'ajouter une fonctionnalité de recherche avancée pour les observations.
L'utilisateur peut rechercher des observations en combinant plusieurs critères (par exemple : date, description, auteur, etc.).
Cela permet de mieux affiner la recherche en fonction de plusieurs paramètres.


