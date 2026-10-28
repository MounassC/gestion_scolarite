# Gestion Scolarité

[![Laravel CI](https://github.com/MounassC/gestion_scolarite/actions/workflows/laravel-tests.yml/badge.svg)](https://github.com/MounassC/gestion_scolarite/actions/workflows/laravel-tests.yml)

Application web de gestion de la scolarité d'un établissement : années académiques, filières, niveaux, classes et tarifs. Développée avec Laravel et Blade.


## Fonctionnalités

- **Années académiques** : création avec contrôle des dates (durée de 9 mois), puis gestion du cycle de vie : brouillon, publication, ouverture et fermeture des inscriptions, clôture
- **Filières**, **catégories de niveaux**, **niveaux** et **classes** : création, modification, consultation, suppression
- **Tarifs** : frais d'inscription et mensualité, rattachés aux classes
- **Tableau de bord** de synthèse
- Interface en français

## Technologies

- PHP 8.2+ et Laravel 12
- Blade (vues), Tailwind CSS 4 et Vite
- SQLite par défaut (configurable dans `.env`)
- PHPUnit pour les tests
- GitHub Actions pour l'intégration continue

## Architecture

- `app/Http/Controllers` : contrôleurs qui reçoivent les requêtes
- `app/Http/Requests` : validation des formulaires (Form Requests)
- `app/Services` : logique métier, séparée des contrôleurs
- `app/Models` : modèles Eloquent et relations
- `database/migrations` : structure de la base de données
- `resources/views` : vues Blade
- `tests` : tests unitaires et tests de fonctionnalités

## Installation

Prérequis : PHP 8.2 ou plus, Composer, Node.js et npm.

```bash
git clone https://github.com/MounassC/gestion_scolarite.git
cd gestion_scolarite

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

npm install
npm run dev
```

Dans un second terminal, lancez le serveur :

```bash
php artisan serve
```

L'application est alors disponible sur `http://localhost:8000`.

Sous Windows (PowerShell), remplacez `cp .env.example .env` par `copy .env.example .env`. Si `php artisan migrate` propose de créer le fichier de base SQLite, répondez oui.

## Tests

```bash
php artisan test
```

Les tests couvrent notamment la création des années académiques et la validation de leurs dates. Ils sont aussi exécutés automatiquement à chaque envoi de code grâce à GitHub Actions.

## Auteure

Maïmouna Cissé, diplômée en génie logiciel de l'Université Dakar Bourguiba.

## Licence

Projet développé dans un cadre pédagogique, sur la base du framework [Laravel](https://laravel.com), distribué sous [licence MIT](https://opensource.org/licenses/MIT).
