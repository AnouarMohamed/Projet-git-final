# TaskPilot IA

MVP Laravel de gestion de taches avec assistant IA.

## Etat actuel

La partie lourde est en place :

- Bootstrap Laravel.
- CRUD des taches.
- Interface Blade.
- Integration IA avec Strategy Pattern :
  - `TaskAdvisorInterface`
  - `DemoTaskAdvisor`
  - `OpenAiTaskAdvisor`
- Hotfix de validation : une date limite passee est refusee.
- Workflow GitHub avec branches et PR.

La partie teammate reste volontairement a finaliser :

- Tests fonctionnels.
- Analyse Sonar et correction de 2 issues.
- README professionnel final.
- Offre commerciale finale.
- Presentation finale.
- Release/tag final apres validation commune.

## Installation rapide

Prerequis :

- PHP 8.3+
- Composer
- Node.js et npm
- Extensions PHP `pdo` et `pdo_sqlite`

Sur Fedora :

```bash
sudo dnf install -y php-pdo php-sqlite3
```

Puis :

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

## IA

Demo fiable :

```env
AI_PROVIDER=demo
```

OpenAI optionnel :

```env
AI_PROVIDER=openai
OPENAI_API_KEY=sk-...
OPENAI_MODEL=gpt-5.4-mini
OPENAI_BASE_URL=https://api.openai.com/v1
```

## Handoff teammate

Voir [docs/teammate-todo.md](docs/teammate-todo.md).
