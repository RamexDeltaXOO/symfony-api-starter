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
