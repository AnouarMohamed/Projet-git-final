# Presentation finale, 10-12 minutes

## 1. Probleme du client, 1 minute

Phrase de pitch :

> Une petite equipe projet perd du temps quand les taches, priorites et risques ne sont pas centralises.

Points a dire :

- Les taches sont souvent dispersees.
- La priorite reelle n'est pas toujours claire.
- Les risques sont detectes trop tard.

## 2. Solution proposee, 1 minute

TaskPilot IA est un tableau de bord Laravel qui permet de gerer les taches et de demander une suggestion IA pour transformer une tache en plan d'action.

Points forts :

- CRUD simple.
- Priorites et statuts visibles.
- Assistant IA sauvegarde dans la base.
- Demo stable avec `AI_PROVIDER=demo`.

## 3. Architecture et workflow Git, 2 minutes

Architecture :

- Laravel MVC.
- `TaskController` pour le CRUD.
- `TaskAiSuggestionController` pour la generation IA.
- `TaskAdvisorInterface` pour le Strategy Pattern.
- `DemoTaskAdvisor` et `OpenAiTaskAdvisor` comme strategies.
- SQLite pour le MVP local.

Workflow Git :

- `main`
- branches `feature/*`
- branche `hotfix/due-date-validation`
- Pull Requests mergees sur GitHub
- tag final pose apres validation qualite

## 4. Demo des fonctionnalites, 3 minutes

Scenario conseille :

1. Ouvrir `/tasks`.
2. Creer une tache avec description et date limite.
3. Filtrer par statut ou priorite.
4. Modifier la tache.
5. Generer une suggestion IA.
6. Montrer le resume, les sous-taches, les risques et l'estimation.
7. Montrer rapidement la validation hotfix en essayant une date passee.

## 5. Refactoring et design pattern, 2 minutes

Design pattern :

- Pattern choisi : Strategy.
- Objectif : changer de provider IA sans modifier le controller.
- Interface : `TaskAdvisorInterface`.
- Strategies : `DemoTaskAdvisor`, `OpenAiTaskAdvisor`.

Refactoring qualite :

- Extraire les statistiques du dashboard dans un service.
- Extraire le parsing de reponse OpenAI dans une classe dediee.

## 6. Corrections Sonar, 1 minute

Points a presenter :

- Montrer le rapport baseline.
- Montrer deux issues.
- Montrer les commits de correction.
- Montrer le avant/apres.

## 7. Valeur business, 1-2 minutes

- Gain de clarte pour l'equipe.
- Meilleure priorisation.
- Demo plus professionnelle.
- Application extensible : authentification, equipe, notifications, exports.

## Repartition orale conseillee

- Anouar : probleme, solution, architecture, CRUD, IA, Git workflow.
- Zakaria : Sonar, corrections qualite, preuves avant/apres, valeur business.
