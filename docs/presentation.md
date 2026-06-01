# Plan de presentation finale, 10-12 minutes

## 1. Probleme client, 1 minute

- Les equipes perdent du temps a clarifier les priorites.
- Les taches sont mal structurees avant les demos.
- Les risques sont identifies trop tard.

## 2. Solution proposee, 1 minute

- TaskPilot IA centralise les taches.
- L'assistant IA transforme une tache en plan d'action.
- Le provider demo garantit une presentation fiable.

## 3. Architecture et workflow Git, 2 minutes

- Laravel MVC : routes, controllers, models, migrations, Blade.
- SQLite pour un MVP local rapide.
- Strategy Pattern pour separer `demo` et `openai`.
- Branches feature, PR GitHub, hotfix et tag `v1.0`.

## 4. Demo fonctionnelle, 3 minutes

Scenario :

1. Creer une tache avec priorite et date limite.
2. Filtrer le tableau de bord.
3. Modifier le statut.
4. Generer une suggestion IA.
5. Montrer la suggestion sauvegardee.

## 5. Refactoring et design pattern, 2 minutes

- Expliquer `TaskAdvisorInterface`.
- Montrer `DemoTaskAdvisor` et `OpenAiTaskAdvisor`.
- Expliquer pourquoi l'interface evite de changer le controller.
- Montrer le refactoring qualite : `TaskStatsCalculator`, `OpenAiResponseTextExtractor`.

## 6. Corrections Sonar, 1 minute

- Issue 1 : logique de statistiques sortie du controller.
- Issue 2 : parsing OpenAI sorti du provider.
- Tests et Pint pour verrouiller la qualite.

## 7. Valeur business, 1-2 minutes

- Gain de clarte pour l'equipe.
- Priorisation plus rapide.
- Demo plus professionnelle.
- Evolution possible : authentification, equipes, notifications, exports.
