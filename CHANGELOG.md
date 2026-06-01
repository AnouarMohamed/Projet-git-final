# Changelog

## v1.0, 2026-06-01

Version finale du MVP pedagogique.

### Ajoute

- CRUD complet des taches.
- Tableau de bord avec filtres et compteurs.
- Suggestions IA sauvegardees par tache.
- Strategy Pattern pour choisir entre provider `demo` et provider `openai`.
- Tests unitaires et fonctionnels.
- Documentation projet, offre commerciale et plan de presentation.
- Configuration SonarCloud.

### Corrige

- Validation hotfix : une date limite passee est maintenant refusee.

### Notes

- Installer `php-pdo` et `php-sqlite3` avant d'executer les migrations et les tests fonctionnels.
- Le provider `demo` est le choix recommande pour la soutenance.
