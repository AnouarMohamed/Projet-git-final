# Analyse Sonar, plan teammate

## Etat actuel

Le projet contient deja le MVP, l'IA et le Strategy Pattern. La partie Sonar doit etre finalisee par le teammate pour garder une contribution claire.

## Baseline a produire

Commandes :

```bash
vendor/bin/pint --test
composer test
sonar-scanner
```

Sur Fedora, installer si besoin :

```bash
sudo dnf install -y php-pdo php-sqlite3
```

## Issues candidates

### Issue 1, statistiques dans le controller

Code candidat : `TaskController::stats()`.

Probleme : le controller contient plusieurs requetes de statistiques. C'est lisible pour le MVP, mais perfectible pour la qualite.

Correction conseillee :

- creer `App\Services\Tasks\TaskStatsCalculator` ;
- creer un petit DTO `TaskStats` ;
- injecter le service dans `TaskController@index`.

### Issue 2, parsing OpenAI dans le provider

Code candidat : `OpenAiTaskAdvisor::extractOutputText()`.

Probleme : le provider gere a la fois appel HTTP, schema, parsing de reponse et mapping.

Correction conseillee :

- creer `OpenAiResponseTextExtractor` ;
- injecter cette classe dans `OpenAiTaskAdvisor` ;
- garder le provider centre sur l'appel IA.

## Avant / apres a completer

| Element | Avant | Apres |
| --- | --- | --- |
| Stats dashboard | Requetes Eloquent directes dans `TaskController::index` via une methode privee `stats()`. | Logique extraite dans `TaskStatsCalculator` et DTO `TaskStats`. Injection de dependance dans le controller. |
| Parsing OpenAI | Methode privee complexe `extractOutputText()` dans `OpenAiTaskAdvisor` gerant plusieurs niveaux de JSON. | Logique extraite dans `OpenAiResponseTextExtractor`. Injection de dependance via le Service Provider. |

## Preuves a ajouter

- Capture Sonar baseline : [Lien vers capture baseline]
- Capture apres correction : [Lien vers capture post-fix]
- Commits de correction :
  - `refactor: extract task statistics to dedicated service (Sonar fix)`
  - `refactor: extract OpenAI response parsing to dedicated class (Sonar fix)`
- Resultat `npm run build` : SUCCESS (vu ci-dessus).
