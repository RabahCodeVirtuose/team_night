
## Commandes utilisées
supprimer la base de données php bin/console doctrine:schema:drop --force --full-database
C:\Users\HP\AppData\Roaming\DBeaverData\workspace6\General\Scripts
# Résumé rapide 
rm -rf migrations/*
php bin/console doctrine:schema:drop --force --full-database
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
symfony console doctrine:database:create

public function up(Schema $schema): void
{
$this->addSql("CREATE TYPE reaction_type AS ENUM ('like', 'love', 'haha', 'wow', 'grrr');");
$this->addSql("CREATE TYPE notification_type AS ENUM ('reaction', 'comment', 'validation', 'alert', 'info');");
}

il faut remplacer ça CREATE TABLE reaction (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, publication_id INT DEFAULT NULL, type 'like','love','haha','wow','grrr' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
 en ça  CREATE TABLE reaction (id SERIAL NOT NULL, utilisateur_id INT DEFAULT NULL, publication_id INT DEFAULT NULL, type reaction_type NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))

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




🔧 Table reaction :
Champ	Type	Description
id	int	Clé primaire
user_id	FK → User	Qui a réagi
publication_id	FK → Publication	Sur quoi
type	string	Type de réaction : 'like', 'haha', 'grrr'...
created_at	datetime	Date de réaction


| Champ        | Type                | Description                                         |
| ------------ | ------------------- | --------------------------------------------------- |
| `id`         | `int`               | Clé primaire auto-incrémentée                       |
| `user_id`    | `FK` → User         | Le **destinataire** de la notif                     |
| `type`       | `enum` ou `string`  | Le type : `reaction`, `comment`, `validation`, etc. |
| `message`    | `string`            | Le message affiché                                  |
| `is_read`    | `bool`              | True/false si elle a été lue                        |
| `created_at` | `datetime`          | Date de création                                    |
| `target_url` | `string (nullable)` | Lien vers l’élément concerné                        |



Je développe actuellement une plateforme web moderne en Symfony (backend) avec API Platform, Angular (frontend), 
et PostgreSQL pour la base de données. Ce projet s'appelle TeamNight, une agence événementielle en Algérie qui vise
à devenir un véritable portail de réservation et de gestion d'événements (mariages, soirées, anniversaires, etc.) 
avec un système de packs, de services personnalisés, et un panier de réservation. Côté front-end, je réfléchis à 
une interface fluide et intuitive, inspirée de Facebook : après connexion, l'utilisateur atterrit sur un journal 
où il voit les publications, avec un menu pour accéder aux packs, au simulateur de réservation, aux souvenirs 
(événements marquants), etc. J’ai conçu une entité Publication enrichie avec un champ isApproved (publication validée par admin)
et souvenir (pour classer une publication dans la page souvenir). J’ajoute aussi une entité Reaction (type : like, haha, grrr...)
liée à un utilisateur et une publication, et je gère ça proprement avec un enum PHP + type Doctrine personnalisé 
(ReactionTypeType). Même chose pour l’entité Notification, qui notifie un utilisateur lorsqu’un autre réagit à sa 
publication, avec champ is_read, message, target_url et enum NotificationType. Je suis en train de créer et 
enregistrer ces enums proprement dans Symfony avec les fichiers nécessaires (src/Enum, src/DBAL/Types, config 
dans doctrine.yaml). Mon objectif est de garder une architecture propre, scalable, et orientée utilisateurs, 
tout en préparant potentiellement une future migration vers application mobile. J’ai besoin d’un accompagnement 
structuré, technique et moderne pour finaliser tous ces composants (front + back + base) proprement.