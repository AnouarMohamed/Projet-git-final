# Analyse qualite et Sonar

## Etat local

- `sonar-scanner` n'est pas installe sur cette machine.
- Les tests fonctionnels Laravel sont ecrits mais bloques localement par l'absence de l'extension PHP `PDO` / `pdo_sqlite`.
- Commande systeme a executer avant l'analyse locale sur Fedora :

```bash
sudo dnf install -y php-pdo php-sqlite3 sonar-scanner
```

## Baseline avant refactoring

Deux points de maintenabilite etaient visibles apres le MVP :

1. `TaskController` calculait les statistiques du tableau de bord avec plusieurs requetes separees.
2. `OpenAiTaskAdvisor` melangeait appel API, schema de sortie, extraction du texte et mapping metier.

## Corrections appliquees

1. Extraction de `TaskStatsCalculator` et `TaskStats` pour produire les compteurs du tableau de bord via une responsabilite dediee.
2. Extraction de `OpenAiResponseTextExtractor` pour isoler le parsing de la reponse OpenAI du provider IA.

## Verification

Commandes passees localement :

```bash
vendor/bin/pint --test
vendor/bin/phpunit tests/Unit/TaskSuggestionDataTest.php
npm run build
php artisan route:list
```

Commande attendue apres installation des extensions PHP :

```bash
composer test
sonar-scanner
```
