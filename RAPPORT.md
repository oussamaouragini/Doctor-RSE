# RAPPORT DE DOCUMENTATION - Doctor RSE App

## Table des matières

1. [Introduction](#introduction)
2. [Vue d'ensemble du projet](#vue-densemble-du-projet)
3. [Architecture technique](#architecture-technique)
4. [Structure de la base de données](#structure-de-la-base-de-données)
5. [Fonctionnalités principales](#fonctionnalités-principales)
6. [Installation et configuration](#installation-et-configuration)
7. [Structure du code](#structure-du-code)
8. [Utilisation de l'application](#utilisation-de-lapplication)
9. [Système de scoring RSE](#système-de-scoring-rse)
10. [Technologies utilisées](#technologies-utilisées)
11. [Développement et tests](#développement-et-tests)
12. [Conclusion](#conclusion)

---

## Introduction

**Doctor RSE App** est une application web moderne de gestion de rendez-vous médicaux avec un focus particulier sur la **Responsabilité Sociétale des Entreprises (RSE)** et les pratiques écologiques. Cette application permet de connecter les patients avec des professionnels de santé tout en suivant et en récompensant les choix respectueux de l'environnement.

### Objectifs du projet

- Faciliter la prise de rendez-vous avec des médecins
- Promouvoir les consultations à distance pour réduire les émissions de CO₂
- Encourager le soutien aux entreprises locales
- Suivre et récompenser les actions écologiques des utilisateurs
- Fournir un tableau de bord complet pour le suivi des statistiques RSE

---

## Vue d'ensemble du projet

### Contexte

Dans un contexte où la prise de conscience environnementale est croissante, cette application combine les besoins de santé avec les préoccupations écologiques. Elle permet aux utilisateurs de :

- Réduire leur empreinte carbone en choisissant des consultations à distance
- Soutenir les entreprises locales
- Suivre leur impact environnemental positif
- Accumuler des points RSE pour leurs actions écologiques

### Public cible

- **Patients** : Personnes cherchant à prendre rendez-vous avec des médecins
- **Médecins** : Professionnels de santé souhaitant être référencés sur la plateforme
- **Organisations** : Entités intéressées par le suivi de leur impact RSE

---

## Architecture technique

### Stack technologique

L'application est construite avec une architecture **MVC (Model-View-Controller)** utilisant le framework Laravel.

#### Backend
- **Framework** : Laravel 10
- **Langage** : PHP 8.1+
- **Base de données** : MySQL/MariaDB
- **Authentification** : Laravel Breeze (Sanctum)

#### Frontend
- **Templates** : Blade (moteur de template Laravel)
- **CSS Framework** : Tailwind CSS
- **JavaScript** : Alpine.js
- **Build Tool** : Vite

#### Outils de développement
- **Gestionnaire de dépendances PHP** : Composer
- **Gestionnaire de dépendances Node** : npm
- **Tests** : PHPUnit
- **Code Style** : Laravel Pint

### Architecture des couches

```
┌─────────────────────────────────────┐
│         Vue (Blade Templates)       │
│         Tailwind CSS + Alpine.js     │
└─────────────────────────────────────┘
                  ↓
┌─────────────────────────────────────┐
│      Controllers (Logique métier)    │
│  - AppointmentController             │
│  - DoctorController                  │
│  - SustainabilityController          │
│  - ProfileController                 │
└─────────────────────────────────────┘
                  ↓
┌─────────────────────────────────────┐
│         Models (Eloquent ORM)        │
│  - User                              │
│  - Doctor                            │
│  - Appointment                       │
│  - SustainabilityLog                 │
└─────────────────────────────────────┘
                  ↓
┌─────────────────────────────────────┐
│         Base de données MySQL        │
└─────────────────────────────────────┘
```

---

## Structure de la base de données

### Schéma relationnel

L'application utilise quatre tables principales avec les relations suivantes :

```
Users (1) ────< (N) Appointments (N) >─── (1) Doctors
  │                                              │
  │                                              │
  └───< (N) SustainabilityLogs                  │
                                                │
                                          RSE Features:
                                          - is_eco_friendly
                                          - is_local_business
                                          - is_accessible
                                          - rse_score
```

### Tables détaillées

#### 1. Table `users`

Stocker les informations des utilisateurs (patients) avec leurs statistiques RSE.

| Colonne | Type | Description |
|---------|------|-------------|
| `id` | bigint | Identifiant unique |
| `name` | string | Nom de l'utilisateur |
| `email` | string | Email (unique) |
| `password` | string | Mot de passe hashé |
| `carbon_saving` | float | Total CO₂ économisé (en kg) |
| `eco_friendly_bookings` | integer | Nombre de rendez-vous écologiques |
| `local_businesses_supported` | integer | Nombre d'entreprises locales soutenues |
| `rse_score` | integer | Score RSE total de l'utilisateur |
| `email_verified_at` | timestamp | Date de vérification email |
| `remember_token` | string | Token de session |
| `created_at` | timestamp | Date de création |
| `updated_at` | timestamp | Date de mise à jour |

#### 2. Table `doctors`

Stocker les informations des médecins avec leurs caractéristiques RSE.

| Colonne | Type | Description |
|---------|------|-------------|
| `id` | bigint | Identifiant unique |
| `name` | string | Nom du médecin |
| `speciality` | string | Spécialité (ancien champ) |
| `specialty` | string | Spécialité |
| `email` | string | Email (unique) |
| `phone` | string | Téléphone |
| `bio` | text | Biographie |
| `address` | string | Adresse |
| `is_eco_friendly` | boolean | Médecin éco-responsable |
| `is_local_business` | boolean | Entreprise locale |
| `is_accessible` | boolean | Accessible aux personnes à mobilité réduite |
| `rse_score` | integer | Score RSE du médecin (défaut: 50) |
| `created_at` | timestamp | Date de création |
| `updated_at` | timestamp | Date de mise à jour |

#### 3. Table `appointments`

Gérer les rendez-vous entre utilisateurs et médecins.

| Colonne | Type | Description |
|---------|------|-------------|
| `id` | bigint | Identifiant unique |
| `user_id` | bigint | Référence à l'utilisateur (FK) |
| `doctor_id` | bigint | Référence au médecin (FK) |
| `date` | date | Date du rendez-vous |
| `time` | time | Heure du rendez-vous |
| `status` | enum | Statut: pending, confirmed, completed, cancelled |
| `is_remote` | boolean | Consultation à distance (RSE) |
| `created_at` | timestamp | Date de création |
| `updated_at` | timestamp | Date de mise à jour |

#### 4. Table `sustainability_logs`

Enregistrer toutes les actions RSE des utilisateurs.

| Colonne | Type | Description |
|---------|------|-------------|
| `id` | bigint | Identifiant unique |
| `user_id` | bigint | Référence à l'utilisateur (FK) |
| `action` | string | Description de l'action |
| `co2_saved` | float | CO₂ économisé (en kg) |
| `points` | integer | Points RSE gagnés |
| `created_at` | timestamp | Date de création |
| `updated_at` | timestamp | Date de mise à jour |

### Relations Eloquent

```php
// User Model
- hasMany(Appointment::class)
- hasMany(SustainabilityLog::class)

// Doctor Model
- hasMany(Appointment::class)

// Appointment Model
- belongsTo(User::class)
- belongsTo(Doctor::class)

// SustainabilityLog Model
- belongsTo(User::class)
```

---

## Fonctionnalités principales

### 1. Gestion des médecins

#### Liste des médecins (`/doctors`)
- Affichage de tous les médecins disponibles
- Informations affichées : nom, spécialité, adresse
- Indicateurs RSE visibles (éco-responsable, local, accessible)

#### Détails d'un médecin (`/doctors/{id}`)
- Informations complètes du médecin
- Biographie
- Coordonnées (email, téléphone)
- Score RSE et caractéristiques
- Bouton pour prendre rendez-vous

### 2. Gestion des rendez-vous

#### Création de rendez-vous (`/appointments/create`)
- Sélection d'un médecin
- Choix de la date (validation : date >= aujourd'hui)
- Choix de l'heure
- Option de consultation à distance (`is_remote`)
- Validation des données avant enregistrement

#### Liste des rendez-vous (`/appointments`)
- Affichage de tous les rendez-vous de l'utilisateur
- Tri par date (plus récents en premier)
- Informations : médecin, date, heure, statut, type (présentiel/à distance)

#### Logique de scoring RSE lors de la création
Lorsqu'un rendez-vous à distance est créé :
- **CO₂ économisé** : +2.5 kg par consultation
- **Points RSE** : +10 points
- **Compteur écologique** : +1 rendez-vous éco-friendly
- Enregistrement dans `sustainability_logs`

### 3. Tableau de bord RSE (`/rse`)

#### Statistiques affichées
- Total de CO₂ économisé
- Nombre de rendez-vous écologiques
- Score RSE total
- Graphique des 7 derniers jours (CO₂ économisé par jour)

#### Historique des actions
- Liste des 10 dernières actions RSE
- Détails : action, CO₂ économisé, points gagnés, date

### 4. Tableau de bord utilisateur (`/dashboard`)

#### Statistiques
- Total des rendez-vous
- Rendez-vous à venir
- 5 derniers rendez-vous avec détails

### 5. Gestion du profil (`/profile`)

- Modification des informations personnelles
- Changement de mot de passe
- Suppression du compte

### 6. Authentification

- Inscription de nouveaux utilisateurs
- Connexion/Déconnexion
- Réinitialisation de mot de passe
- Vérification d'email (optionnelle)

---

## Installation et configuration

### Prérequis

- **PHP** >= 8.1 avec extensions : BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- **Composer** (gestionnaire de dépendances PHP)
- **Node.js** >= 16.0 et npm
- **MySQL** >= 5.7 ou **MariaDB** >= 10.3
- **Serveur web** (Apache/Nginx) ou serveur de développement PHP

### Étapes d'installation

#### 1. Cloner le dépôt

```bash
git clone https://github.com/oussamaouragini/Doctor-RSE.git
cd Doctor-RSE/doctor-rse-app
```

#### 2. Installer les dépendances PHP

```bash
composer install
```

#### 3. Installer les dépendances Node.js

```bash
npm install
```

#### 4. Configuration de l'environnement

```bash
# Copier le fichier d'exemple
cp .env.example .env

# Générer la clé d'application
php artisan key:generate
```

#### 5. Configuration de la base de données

Éditer le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=doctor_rse_app
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

#### 6. Exécuter les migrations et seeders

```bash
# Créer les tables
php artisan migrate

# Remplir avec des données de test
php artisan db:seed
```

#### 7. Compiler les assets frontend

```bash
# Pour la production
npm run build

# Pour le développement (avec hot reload)
npm run dev
```

#### 8. Démarrer le serveur de développement

```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

### Identifiants par défaut

Après le seeding, vous pouvez vous connecter avec :
- **Email** : `test@example.com`
- **Password** : `password`

---

## Structure du code

### Organisation des fichiers

```
doctor-rse-app/
├── app/
│   ├── Console/              # Commandes Artisan
│   ├── Exceptions/           # Gestion des exceptions
│   ├── Http/
│   │   ├── Controllers/      # Contrôleurs MVC
│   │   │   ├── AppointmentController.php
│   │   │   ├── DoctorController.php
│   │   │   ├── SustainabilityController.php
│   │   │   ├── ProfileController.php
│   │   │   └── Auth/         # Contrôleurs d'authentification
│   │   ├── Middleware/       # Middleware personnalisés
│   │   ├── Requests/         # Form Requests (validation)
│   │   └── Kernel.php        # Configuration HTTP
│   ├── Models/               # Modèles Eloquent
│   │   ├── User.php
│   │   ├── Doctor.php
│   │   ├── Appointment.php
│   │   └── SustainabilityLog.php
│   ├── Providers/            # Service Providers
│   └── View/                 # Composants Blade
│       └── Components/
│
├── database/
│   ├── factories/            # Factories pour les tests
│   ├── migrations/           # Migrations de base de données
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2025_12_05_020924_create_doctors_table.php
│   │   ├── 2025_12_05_020929_create_appointments_table.php
│   │   ├── 2025_12_05_020934_create_sustainability_logs_table.php
│   │   └── 2025_12_05_023522_add_fields_to_doctors_table.php
│   └── seeders/              # Seeders pour données de test
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── DoctorSeeder.php
│       └── AppointmentSeeder.php
│
├── resources/
│   ├── views/                # Templates Blade
│   │   ├── layouts/          # Layouts principaux
│   │   ├── components/       # Composants réutilisables
│   │   ├── appointments/     # Vues des rendez-vous
│   │   ├── doctors/          # Vues des médecins
│   │   ├── sustainability/   # Vues RSE
│   │   ├── auth/             # Vues d'authentification
│   │   ├── profile/          # Vues de profil
│   │   ├── dashboard.blade.php
│   │   └── welcome.blade.php
│   ├── css/                  # Feuilles de style
│   │   └── app.css
│   └── js/                   # Fichiers JavaScript
│       ├── app.js
│       └── bootstrap.js
│
├── routes/
│   ├── web.php               # Routes web
│   ├── api.php               # Routes API (si nécessaire)
│   └── auth.php              # Routes d'authentification
│
├── public/                    # Fichiers publics
│   ├── index.php             # Point d'entrée
│   └── build/                # Assets compilés
│
├── tests/                     # Tests PHPUnit
│   ├── Feature/              # Tests fonctionnels
│   └── Unit/                 # Tests unitaires
│
├── config/                    # Fichiers de configuration
├── storage/                   # Fichiers de stockage
└── vendor/                    # Dépendances Composer
```

### Contrôleurs principaux

#### AppointmentController

**Méthodes** :
- `index()` : Liste des rendez-vous de l'utilisateur
- `create()` : Formulaire de création
- `store()` : Enregistrement avec calcul RSE automatique

**Logique métier** :
- Validation des données (date >= aujourd'hui)
- Conversion `is_remote` en boolean
- Calcul automatique des points RSE pour consultations à distance
- Mise à jour des statistiques utilisateur
- Création d'un log de durabilité

#### DoctorController

**Méthodes** :
- `index()` : Liste de tous les médecins
- `show($doctor)` : Détails d'un médecin

#### SustainabilityController

**Méthodes** :
- `dashboard()` : Tableau de bord RSE avec graphique des 7 derniers jours

**Fonctionnalités** :
- Calcul des données de graphique (CO₂ économisé par jour)
- Récupération des 10 derniers logs
- Préparation des données pour les badges (structure prête)

---

## Utilisation de l'application

### Parcours utilisateur type

#### 1. Inscription/Connexion

1. Accéder à la page d'accueil
2. Cliquer sur "Register" ou "Login"
3. Remplir le formulaire
4. Être redirigé vers le tableau de bord

#### 2. Recherche et sélection d'un médecin

1. Naviguer vers "Doctors" dans le menu
2. Parcourir la liste des médecins
3. Cliquer sur un médecin pour voir ses détails
4. Vérifier les caractéristiques RSE (éco-friendly, local, accessible)

#### 3. Prise de rendez-vous

1. Depuis la liste ou les détails d'un médecin, cliquer sur "Book Appointment"
2. Remplir le formulaire :
   - Sélectionner le médecin
   - Choisir une date (>= aujourd'hui)
   - Choisir une heure
   - Cocher "Remote consultation" si souhaité
3. Soumettre le formulaire
4. Confirmation et redirection vers la liste des rendez-vous

#### 4. Consultation du tableau de bord RSE

1. Naviguer vers "RSE Dashboard"
2. Visualiser :
   - Total CO₂ économisé
   - Score RSE
   - Graphique des 7 derniers jours
   - Historique des actions

### Cas d'usage RSE

#### Consultation à distance

**Avant** :
- L'utilisateur doit se déplacer → émission de CO₂
- Temps de transport
- Coûts de transport

**Avec l'application** :
- Consultation à distance → 0 émission
- **Économie** : 2.5 kg CO₂ par consultation
- **Récompense** : +10 points RSE
- Suivi automatique dans le tableau de bord

#### Soutien aux entreprises locales

- Les médecins peuvent être marqués comme "local business"
- Les utilisateurs peuvent filtrer pour soutenir les entreprises locales
- Impact positif sur l'économie locale

---

## Système de scoring RSE

### Calcul des points

#### Consultation à distance
- **CO₂ économisé** : 2.5 kg par consultation
- **Points RSE** : +10 points
- **Compteur** : +1 rendez-vous éco-friendly

### Métriques suivies

#### Au niveau utilisateur
- `carbon_saving` : Total de CO₂ économisé (en kg)
- `eco_friendly_bookings` : Nombre de rendez-vous écologiques
- `local_businesses_supported` : Nombre d'entreprises locales soutenues
- `rse_score` : Score RSE total (cumul des points)

#### Au niveau médecin
- `is_eco_friendly` : Médecin éco-responsable
- `is_local_business` : Entreprise locale
- `is_accessible` : Accessible aux personnes à mobilité réduite
- `rse_score` : Score RSE du médecin (défaut: 50)

### Historique des actions

Toutes les actions RSE sont enregistrées dans `sustainability_logs` avec :
- Type d'action (ex: "Remote appointment")
- CO₂ économisé
- Points gagnés
- Date et heure

---

## Technologies utilisées

### Backend

| Technologie | Version | Usage |
|------------|---------|-------|
| PHP | >= 8.1 | Langage principal |
| Laravel | 10.x | Framework MVC |
| Laravel Breeze | 1.29 | Authentification |
| Laravel Sanctum | 3.3 | API Authentication |
| MySQL/MariaDB | >= 5.7/10.3 | Base de données |

### Frontend

| Technologie | Version | Usage |
|------------|---------|-------|
| Blade | - | Moteur de templates |
| Tailwind CSS | - | Framework CSS |
| Alpine.js | - | Framework JavaScript léger |
| Vite | - | Build tool et dev server |

### Outils de développement

| Outil | Usage |
|-------|-------|
| Composer | Gestion des dépendances PHP |
| npm | Gestion des dépendances Node.js |
| PHPUnit | Tests unitaires et fonctionnels |
| Laravel Pint | Code style et formatting |

### Dépendances principales

**Production** :
- `guzzlehttp/guzzle` : Client HTTP
- `laravel/framework` : Framework Laravel
- `laravel/sanctum` : Authentification API
- `laravel/tinker` : REPL pour Laravel

**Développement** :
- `fakerphp/faker` : Génération de données de test
- `laravel/breeze` : Kit d'authentification
- `laravel/pint` : Code formatter
- `phpunit/phpunit` : Framework de tests

---

## Développement et tests

### Exécution des tests

```bash
# Lancer tous les tests
php artisan test

# Tests avec couverture
php artisan test --coverage
```

### Formatage du code

```bash
# Formater le code selon les standards Laravel
./vendor/bin/pint
```

### Compilation des assets

```bash
# Mode développement (avec hot reload)
npm run dev

# Mode production (optimisé)
npm run build
```

### Commandes Artisan utiles

```bash
# Créer une migration
php artisan make:migration create_table_name

# Créer un modèle
php artisan make:model ModelName

# Créer un contrôleur
php artisan make:controller ControllerName

# Vider le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimiser l'application
php artisan optimize
```

### Structure des tests

Les tests sont organisés en deux catégories :

1. **Tests Feature** (`tests/Feature/`) : Tests fonctionnels
   - Tests d'authentification
   - Tests de profil
   - Tests de fonctionnalités métier

2. **Tests Unit** (`tests/Unit/`) : Tests unitaires
   - Tests de modèles
   - Tests de logique métier isolée

---

## Conclusion

### Résumé

**Doctor RSE App** est une application complète qui combine la gestion de rendez-vous médicaux avec un système innovant de suivi et de récompense des actions écologiques. Elle démontre comment la technologie peut être utilisée pour promouvoir la responsabilité sociétale et environnementale.

### Points forts

✅ **Architecture moderne** : Utilisation de Laravel 10 avec une structure MVC claire  
✅ **Interface utilisateur** : Design moderne avec Tailwind CSS  
✅ **Système RSE intégré** : Suivi automatique des actions écologiques  
✅ **Expérience utilisateur** : Navigation intuitive et responsive  
✅ **Extensibilité** : Structure modulaire permettant l'ajout de nouvelles fonctionnalités  

### Améliorations possibles

- **API REST** : Développement d'une API pour applications mobiles
- **Notifications** : Système de notifications pour rappels de rendez-vous
- **Paiement** : Intégration d'un système de paiement en ligne
- **Calendrier** : Vue calendrier pour les rendez-vous
- **Recherche avancée** : Filtres par spécialité, localisation, score RSE
- **Badges et récompenses** : Système de badges pour les utilisateurs
- **Statistiques avancées** : Graphiques plus détaillés et rapports
- **Multi-langue** : Support de plusieurs langues
- **Export de données** : Export des statistiques RSE en PDF/CSV

### Contribution

Le projet est open-source et les contributions sont les bienvenues. Pour contribuer :

1. Fork le repository
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

### Licence

Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.

### Auteur

Développé avec ❤️ pour une santé durable et responsable.

---

**Date de documentation** : Décembre 2025  
**Version de l'application** : 1.0.0  
**Framework** : Laravel 10.x

