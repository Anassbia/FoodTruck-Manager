# FoodTruck

Projet réalisé en groupe pendant notre première année d'études en informatique.

## Présentation

FoodTruck est un projet de gestion de camions de restauration. Il rassemble quatre applications complémentaires : un site pour les clients, une interface d'administration, une application de caisse en C++ et une application de gestion des stocks en Java.

L'objectif était de mettre en pratique plusieurs langages et de relier des fonctionnalités web et des applications en console à des bases de données MySQL.

## Fonctionnalités

### Espace client — Laravel

- Consulter les menus et les produits proposés.
- Ajouter des articles au panier et modifier les quantités.
- Consulter les camions disponibles et passer une commande.
- Se connecter et accéder à son profil.

### Administration — Laravel

- Gérer les administrateurs, les employés et leurs rôles.
- Gérer les camions, les menus et les stocks.
- Consulter des statistiques sur les commandes et les paiements.

### Caisse — C++

- Authentifier un camion depuis une interface en console.
- Afficher les menus et les filtrer par catégorie.
- Saisir une commande contenant plusieurs articles.
- Calculer le total, afficher un reçu et enregistrer la commande.

### Gestion des stocks — Java

- Gérer les produits alimentaires, le matériel de cuisine et les pièces mécaniques.
- Gérer les catégories et les unités.
- Enregistrer les entrées et les sorties de stock.
- Suivre les produits endommagés et consulter des statistiques.

## Organisation du dépôt

| Dossier | Contenu |
| --- | --- |
| `client/` | Site web destiné aux clients |
| `admin/` | Interface web d'administration |
| `cpp/` | Application de caisse en console |
| `java/` | Application de gestion des stocks en console |

## Technologies utilisées

- **PHP et Laravel** pour les deux applications web.
- **HTML, CSS et JavaScript** pour les interfaces web.
- **C++ et Java** pour les applications en console.
- **MySQL** pour le stockage des données, avec Connector/C++ et JDBC.

Les applications Laravel et la caisse C++ utilisent la base `food_truck`. L'application Java utilise une base distincte, `gestion_stock`.

Ce projet nous a permis de découvrir l'architecture MVC, les formulaires et l'authentification avec Laravel, de manipuler des listes chaînées, des pointeurs et des fichiers en C++, et de travailler avec les classes, l'héritage et les collections en Java. Nous avons également appris à connecter ces applications à MySQL et à ajouter, consulter, modifier et supprimer des données.
