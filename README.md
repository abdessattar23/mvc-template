# MVC-template
# Développement d'une architecture MVC moderne avec PHP et Eloquent

## 📅 **Contexte du Projet**
Dans le cadre du développement d'applications web modernes, une architecture **MVC (Modèle-Vue-Contrôleur)** bien structurée est essentielle pour assurer une séparation claire des responsabilités, une meilleure maintenabilité et une extensibilité du code.

Ce projet vise à construire un **framework PHP minimaliste**, inspiré des meilleures pratiques, tout en restant léger, rapide et facile à utiliser. Il répondra aux besoins d'applications modernes avec des dépendances minimales, mais proposera des fonctionnalités puissantes telles que :
- Gestion des routes,
- Intégration avec **Eloquent ORM**,
- Système de validation des données sécurisé.

---

## 💡 **Objectifs du Projet**
1. 🔹 Développer une architecture **MVC** claire et modulaire.
2. 🔹 Implémenter un **routeur personnalisé** pour gérer les URL de l'application.
3. 🔹 Intégration sécurisée avec **Eloquent ORM** pour la gestion des bases de données.
4. 🔹 Assurer la **sécurisation des données** contre les attaques **XSS**, **CSRF** et **SQL Injection**.
5. 🔹 Offrir des outils pratiques : validation des données, système de sessions, gestion des erreurs.
6. 🔹 Séparer fonctionnellement le **Front Office** et le **Back Office**.
7. 🔹 Utiliser **Composer** pour l'autoloading des classes.

---

## ✅ **Fonctionnalités Principales**
- Gestion avancée des routes.
- Connexion à la base de données via **Eloquent ORM**.
- Séparation entre **Front Office** et **Back Office**.
- Système d’authentification sécurisé avec permissions utilisateurs.
- Gestion des **rôles et autorisations (ACL)**.
- Protection contre **SQL Injection**, **XSS**, **CSRF**.
- Classes pratiques : Validator, Security, Session.
- Autoloading dynamique avec Composer.

---

## 🔍 **Structure MVC Proposée**
```plaintext
/projet-mvc-php
├── public/
│   ├─ index.php
│   ├─ .htaccess
│   └─ assets/
├── app/
│   ├─ controllers/
│   │   ├─ front/
│   │   └─ back/
│   ├─ models/
│   ├─ views/
│   └─ core/
│       ├─ Router.php
│       ├─ Controller.php
│       ├─ Model.php
│       ├─ View.php
│       ├─ Database.php
│       ├─ Auth.php
│       ├─ Validator.php
│       ├─ Security.php
│       └─ Session.php
┌── config/
│   ├─ config.php
│   └─ routes.php
├── logs/
├── vendor/
├── .env
├── composer.json
└── .gitignore
```

---

## ⚖️ **Bonnes Pratiques à Suivre**

### 1. Séparation stricte des responsabilités
- **Front Office** : Partie publique accessible à tous.
- **Back Office** : Réservé aux administrateurs authentifiés.

### 2. Sécurisation des données
- Protection CSRF via des **tokens sécurisés**.
- Validation des entrées utilisateurs avec **Validator.php**.
- Protection contre les attaques **XSS** et **SQL Injection** avec **Security.php**.

### 3. Modularité
- Utilisation de classes abstraites pour réutiliser le code.
- Intégration facile avec d'autres bases de données.

### 4. Gestion avancée des sessions et authentification
- Gestion des sessions avec **Session.php**.
- Authentification utilisateur via **Auth.php**.

### 5. Autoloading avec Composer
- Créez un fichier `composer.json` pour gérer les dépendances.

---

## 💡 **Livrables**
- **Déploiement** : Projet fonctionnel accessible via une URL publique.
- **Planification sur JIRA** : Suivi des tâches et avancement.
- **GitHub Repository** : Avec un README détaillé.

---

## 📈 **Présentation Finale**
- **Temps : 10 minutes**
  - Explication du code.
  - Réponse aux questions techniques.
