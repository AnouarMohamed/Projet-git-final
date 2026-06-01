# Checklist release v1.0

## Git et GitHub

- Repository Git initialise.
- Branches feature creees.
- Pull Requests utilisees et mergees :
  - PR #1 : CRUD
  - PR #2 : IA
  - PR #3 : qualite
  - PR #4 : documentation business
  - PR #5 : hotfix date limite
- Tag final : `v1.0`.

## Verification technique

Commandes validees localement :

```bash
vendor/bin/pint --test
vendor/bin/phpunit tests/Unit/TaskSuggestionDataTest.php
npm run build
php artisan route:list
```

Commande bloquee par l'environnement local :

```bash
composer test
```

Cause : extension PHP `PDO` absente. Installer `php-pdo` et `php-sqlite3`, puis relancer les migrations et les tests.

## Demo

Scenario conseille :

1. Ouvrir le tableau des taches.
2. Creer une tache.
3. Modifier son statut et sa priorite.
4. Generer une suggestion IA avec `AI_PROVIDER=demo`.
5. Montrer la suggestion sauvegardee.
6. Montrer le Strategy Pattern et les PR GitHub.
