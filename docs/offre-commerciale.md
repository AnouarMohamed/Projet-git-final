# Offre commerciale, TaskPilot IA

## 1. Presentation du client

Le client cible est une petite equipe projet qui doit livrer un MVP rapidement : binome etudiant, mini-agence, startup early-stage ou equipe interne sans outil de pilotage lourd.

## 2. Probleme identifie

Les taches sont souvent gerees dans des messages, des notes ou la memoire des membres. Cela cree trois problemes :

- priorites floues ;
- oublis de dates limites ;
- preparation de demo insuffisamment structuree.

## 3. Solution proposee

TaskPilot IA centralise les taches dans une application Laravel simple. L'assistant IA transforme une tache brute en recommandation claire : resume, priorite conseillee, sous-taches, risques et estimation d'effort.

## 4. Fonctionnalites cles

- Creation, modification, consultation et suppression de taches.
- Statut : a faire, en cours, terminee.
- Priorite : basse, moyenne, haute, urgente.
- Date limite avec validation hotfix contre les dates passees.
- Tableau de bord avec filtres.
- Suggestion IA sauvegardee par tache.
- Provider `demo` pour une demo stable.
- Provider `openai` activable par configuration.

## 5. Technologies utilisees

- Laravel 13
- PHP 8.3+
- Blade
- Tailwind CSS
- SQLite
- Vite
- PHPUnit, a completer par le teammate
- SonarCloud, a finaliser par le teammate

## 6. Planning simplifie

| Phase | Duree | Livrable |
| --- | ---: | --- |
| Cadrage | 0,5 jour | Roles, besoin, backlog |
| MVP CRUD | 1 jour | Gestion des taches |
| IA | 1 jour | Suggestion IA sauvegardee |
| Qualite | 0,5 jour | Tests, Sonar, refactoring |
| Documentation | 0,5 jour | README, offre, presentation |

## 7. Estimation budgetaire

Simulation pedagogique :

| Poste | Charge | Montant |
| --- | ---: | ---: |
| Cadrage et architecture | 0,5 jour | 1 000 MAD |
| MVP Laravel | 1,5 jour | 3 000 MAD |
| Integration IA | 1 jour | 2 000 MAD |
| Qualite et tests | 0,5 jour | 1 000 MAD |
| Documentation et presentation | 0,5 jour | 1 000 MAD |
| Total estime | 4 jours | 8 000 MAD |

## 8. Conclusion

TaskPilot IA donne a une petite equipe un outil clair pour suivre ses taches et preparer une demo professionnelle. L'architecture reste simple, mais extensible grace au Strategy Pattern.

## TODO teammate

- Ajouter les captures Sonar ou le lien du rapport.
- Ajuster le budget si le professeur demande un format precis.
