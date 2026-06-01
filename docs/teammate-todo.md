# Handoff teammate

## Objectif

Il reste une vraie moitie de projet a faire pour que la contribution du teammate soit visible et defendable.

## Taches a prendre

1. Ajouter les tests Laravel :
   - creation de tache
   - modification de tache
   - suppression de tache
   - validation d'une tache invalide
   - generation IA avec provider `demo`

2. Faire l'analyse Sonar :
   - lancer le baseline
   - noter les issues
   - corriger au moins 2 problemes
   - mettre a jour `docs/sonar-analysis.md`

3. Finaliser la documentation :
   - completer le README
   - completer `docs/offre-commerciale.md`
   - completer `docs/presentation.md`

4. Preparer la release finale :
   - verifier `composer test`
   - verifier `npm run build`
   - creer le changelog
   - poser le tag final apres validation

## Bonnes issues Sonar candidates

- Extraire `TaskController::stats()` dans un service dedie.
- Extraire le parsing de `OpenAiTaskAdvisor::extractOutputText()` dans une classe dediee.
