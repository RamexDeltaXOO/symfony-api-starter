# Symfony API Starter - CheatSheet LockSelf

## 1. Créer un nouveau projet depuis Packagist

```bash
composer create-project ramexdeltaxoo/symfony-api-starter lockself-projet dev-main
```

---

# 2. Entrer dans le projet

```bash
cd lockself-projet
```

---

# 3. Nettoyer la base SQLite (optionnel mais conseillé)

## Windows CMD

```bash
del var\data.db
del migrations\*.php
```

---

# 4. Créer une nouvelle migration

```bash
php bin/console make:migration
```

---

# 5. Exécuter les migrations

```bash
php bin/console doctrine:migrations:migrate
```

Répondre :

```txt
yes
```

---

# 6. Vérifier les routes API

```bash
php bin/console debug:router
```

Tu dois voir :

```txt
GET      /api/secure-notes
POST     /api/secure-notes
GET      /api/secure-notes/{id}
PUT      /api/secure-notes/{id}
DELETE   /api/secure-notes/{id}
```

---

# 7. Lancer les tests PHPUnit

```bash
php bin/phpunit
```

Résultat attendu :

```txt
OK (1 test, 1 assertion)
```

---

# 8. Lancer le serveur Symfony

## Méthode Windows simple

```bash
php -S 127.0.0.1:8000 -t public
```

---

# 9. Ouvrir l'API

```txt
http://127.0.0.1:8000/api/secure-notes
```

---

# 10. Créer une nouvelle Entity

```bash
php bin/console make:entity
```

Exemple :

```txt
Class name:
> Category
```

---

# 11. Ajouter un champ dans une Entity

Exemple :

```txt
New property name:
> name

Field type:
> string

Field length:
> 255
```

---

# 12. Créer un utilisateur

```bash
php bin/console make:user
```

Réponses :

```txt
Class name:
> User

Store in database:
> yes

Unique property:
> email
```

---

# 13. Créer une migration après modification Entity

```bash
php bin/console make:migration
```

---

# 14. Appliquer migration

```bash
php bin/console doctrine:migrations:migrate
```

---

# 15. Créer un Controller

```bash
php bin/console make:controller Api/CategoryController
```

---

# 16. Créer un Test

```bash
php bin/console make:test
```

Choisir :

```txt
WebTestCase
```

---

# 17. Vérifier les services

Symfony autowire automatiquement toutes les classes dans :

```txt
src/
```

Exemple :

```txt
src/Service
src/Repository
src/Security
```

---

# 18. Architecture Symfony à retenir

```txt
Controller
→ HTTP / JSON / Routes

Service
→ logique métier

Repository
→ requêtes Doctrine

DTO
→ validation input API

Voter
→ permissions sécurité

Entity
→ modèle base de données
```

---

# 19. Commandes Git utiles

## Initialiser Git

```bash
git init
```

## Ajouter les fichiers

```bash
git add .
```

## Commit

```bash
git commit -m "Initial commit"
```

## Push GitHub

```bash
git push -u origin main
```

---

# 20. Créer une version stable Composer

```bash
git tag v1.0.0
git push origin v1.0.0
```

Puis cliquer sur :

```txt
Update
```

dans Packagist.

---

# 21. Utiliser ensuite sans dev-main

```bash
composer create-project ramexdeltaxoo/symfony-api-starter mon-projet
```

---

# 22. Les phrases senior importantes

## Service

> Je préfère garder des controllers très fins et déplacer la logique métier dans des services.

## DTO

> J’utilise des DTO pour éviter d’exposer directement mes Entities Doctrine.

## Voter

> Le Voter centralise la logique d’autorisation.

## Architecture

> J’ai privilégié une architecture simple mais maintenable vu le temps imparti.

---

# 23. Concepts importants

## Autowiring

Symfony injecte automatiquement les dépendances grâce au type des classes.

## strict_types

```php
declare(strict_types=1);
```

Permet d’éviter les conversions implicites de types.

## CQRS

Séparation lecture / écriture.

Pas nécessaire pour un test technique court.

---

# 24. Workflow recommandé pendant un test technique

```txt
1. Entity
2. Migration
3. Controller CRUD
4. DTO
5. Service
6. Repository
7. Voter
8. Test
```

---

# 25. Règle d’or

```txt
Faire SIMPLE mais PROPRE.
```

# 26. Questions probables pendant le test technique

## Pourquoi avoir créé un Service ?

> Pour éviter de mettre la logique métier dans le controller et garder des controllers très fins.

---

## Pourquoi utiliser un DTO ?

> Pour valider les données entrantes sans exposer directement les Entities Doctrine.

---

## Pourquoi séparer CreateDto et UpdateDto ?

> Parce que les contraintes de validation peuvent être différentes entre création et modification.

---

## Pourquoi un Repository ?

> Pour centraliser les requêtes spécifiques liées à l’Entity.

Exemple :

```txt
findByOwner()
```

---

## Pourquoi un Voter ?

> Pour centraliser la logique d’autorisation sur une ressource.

---

## Pourquoi `denyAccessUnlessGranted()` ?

> Pour déléguer la logique de sécurité au système de Voter Symfony.

---

## Pourquoi `MapRequestPayload` ?

> Pour mapper automatiquement le JSON entrant vers un DTO validé.

---

## Pourquoi `readonly` ?

> Pour garantir que les dépendances injectées ne changent pas après construction.

---

## Pourquoi `final` ?

> Pour éviter l’héritage inutile et garder un comportement prévisible.

---

## Pourquoi `DateTimeImmutable` ?

> Pour éviter les modifications involontaires des objets date.

---

## Pourquoi `persist()` uniquement à la création ?

> Parce qu’une Entity déjà gérée par Doctrine n’a pas besoin d’être persistée à nouveau.

---

## Pourquoi SQLite ?

> SQLite permet de démarrer rapidement sans configuration serveur et convient parfaitement à un test technique.

---

## Différence entre Entity et DTO ?

```txt
Entity = modèle base de données
DTO = données d’entrée/sortie API
```

---

## Différence entre 401 et 403 ?

```txt
401 = non authentifié
403 = authentifié mais non autorisé
```

---

## Pourquoi utiliser des groupes Serializer ?

Exemple :

```php
['groups' => ['note:read']]
```

> Pour contrôler les données exposées dans les réponses JSON.

---

## Pourquoi ne pas retourner directement toute l’Entity ?

> Pour éviter d’exposer des données sensibles ou des relations inutiles.

---

## C’est quoi l’autowiring ?

> Symfony injecte automatiquement les dépendances grâce au type des classes.

---

## C’est quoi Doctrine ?

> Doctrine est un ORM qui permet de mapper des objets PHP vers des tables SQL.

---

## C’est quoi une migration Doctrine ?

> Une migration permet de versionner les modifications de schéma de base de données.

---

## Pourquoi utiliser des tests ?

> Pour vérifier le comportement attendu de l’application et éviter les régressions.

---

## Pourquoi avoir testé le 401 ?

> Parce que c’est un test simple qui valide que la sécurité est correctement appliquée.

---

## Pourquoi ne pas utiliser API Platform ?

> Pour ce test, je voulais montrer explicitement la structure complète Symfony : Controller, Service, DTO, Repository et sécurité.

---

## C’est quoi CQRS ?

> CQRS consiste à séparer les opérations de lecture et d’écriture.

---

## Pourquoi ne pas avoir utilisé CQRS ici ?

> Vu le temps imparti, j’ai préféré garder une architecture simple et maintenable.

---

## Pourquoi injecter les dépendances via le constructeur ?

> Cela rend les dépendances explicites, facilement testables et compatibles avec l’autowiring Symfony.

---

## Que ferais-tu avec plus de temps ?

> Pagination, gestion centralisée des erreurs, tests supplémentaires, PHPStan, PHP-CS-Fixer, CI/CD et éventuellement JWT/API Platform selon le besoin.

---

# 27. Questions Symfony techniques rapides

## Commande pour créer une Entity

```bash
php bin/console make:entity
```

---

## Commande pour créer une migration

```bash
php bin/console make:migration
```

---

## Commande pour exécuter les migrations

```bash
php bin/console doctrine:migrations:migrate
```

---

## Commande pour afficher les routes

```bash
php bin/console debug:router
```

---

## Commande pour lancer les tests

```bash
php bin/phpunit
```

---

## Commande pour créer un Controller

```bash
php bin/console make:controller
```

---

## Commande pour créer un User

```bash
php bin/console make:user
```

---

# 28. Les erreurs fréquentes à connaître

## `could not find driver`

> Extension PDO SQLite ou MySQL manquante dans PHP.

---

## `table already exists`

> La base SQLite contient déjà les tables. Supprimer `var/data.db` puis recréer les migrations.

---

## `src refspec main does not match any`

> Aucun commit Git n’a encore été créé.

---

## `Class already in use`

> Deux classes avec le même namespace existent dans le projet.

---

## `Could not find package with stability stable`

> Le package Composer n’a pas encore de version stable. Utiliser `dev-main`.

---

# 29. Ce qu’il faut retenir absolument

```txt
Controller = HTTP
Service = métier
Repository = requêtes
DTO = validation
Voter = permissions
Entity = base de données
```

---

# 30. Mentalité senior pendant le test

```txt
- Faire simple
- Faire propre
- Livrer quelque chose qui fonctionne
- Expliquer ses choix
- Ne pas over-engineer
```
