# Analyse Sonar, a realiser par le teammate

Ce fichier est volontairement un point de depart, pas une analyse terminee.

## TODO

- Installer ou configurer SonarCloud/SonarScanner.
- Lancer une premiere analyse baseline.
- Identifier au moins 2 issues.
- Corriger les issues dans un commit dedie.
- Ajouter le avant/apres dans ce fichier.

## Issues candidates a corriger

- `TaskController::stats()` fait plusieurs requetes separees et peut etre extrait dans un service.
- `OpenAiTaskAdvisor::extractOutputText()` melange parsing API et logique provider.

## Commandes utiles

```bash
vendor/bin/pint --test
composer test
sonar-scanner
```
