## Implémentation des API REST permettant de gérer des utilisateurs et des trajets.

## Fonctionnalités

- Authentification utilisateur avec JWT (`/api/login`)
- CRUD Trajets :
  - Créer un trajet lié à l’utilisateur connecté
  - Lister uniquement les trajets de l’utilisateur connecté, pagination des résultats et filtrage par date
  - Mettre à jour un trajet si l’utilisateur en est propriétaire
  - Supprimer un trajet si l’utilisateur en est propriétaire

 
## Installation

## Cloner le projet
   
   git clone https://github.com/idriss-mbiapo/zenithis-test-technique-backend.git
   cd zenithis-test-technique-backend/laravel

# Installer les dépendances
composer install

## Configurer l’environnement
cp .env.example .env
php artisan key:generate

NB: Modifier le fichier .env pour configurer la base de données.

## Migrer la base de données et genereation d'un user

php artisan migrate --seed

## Installer JWT, publier jwt et generer la cle secret

- composer require tymon/jwt-auth
- php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
- php artisan jwt:secret

## Lancer le serveur

php artisan serve

## Authentification

Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password"
}

Réponse


{
  "access_token": "TOKEN_GENERE",
  "token_type": "bearer",
  "expires_in": 3600
}

## Lancer Test Feature pour tester l'authentification
php artisan test

## NB: Toutes les requêtes suivantes nécessitent le header :

Authorization: Bearer <token>

## Endpoints Trajets

## 1. Créer un trajet

POST /api/trajet/create
Authorization: Bearer <token>
Content-Type: application/json

{
  "lieu_epart": "Douala",
  "lieu_arrivee": "Yaoundé",
  "date_trajet": "2025-09-05"
}

## 2. Récupérer mes trajets

GET /api/trajets
Authorization: Bearer <token>

## 3. Mettre à jour un trajet

PUT /api/trajets/1
Authorization: Bearer <token>
Content-Type: application/json

{
  "depart": "Bafoussam",
  "arrivee": "Yaoundé",
  "date": "2025-09-10"
}

## 4. Supprimer un trajet

DELETE /api/trajet/1
Authorization: Bearer <token>

 
## Exemple de pagination

GET /api/trajets
Authorization: Bearer <token>
Réponse

{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "lieu_depart": "Douala",
      "lieu_arrivee": "Yaoundé",
      "date_trajet": "2025-09-01"
    }
  ],
  "per_page": 10,
  "total": 1
}

## Auteur
Projet réalisé par MBIAPO NZEPA Idriss Cabrel



