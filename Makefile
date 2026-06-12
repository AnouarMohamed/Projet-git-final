.PHONY: help up down restart shell build test migrate seed pint pint-fix analyze
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*2457194' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'
up: ## Start the development environment
	docker-compose up -d
down: ## Stop the development environment
	docker-compose down
restart: ## Restart the development environment
	docker-compose restart
shell: ## Enter the app container shell
	docker-compose exec app bash
build: ## Build the containers
	docker-compose build
test: ## Run tests
	docker-compose exec app php artisan test
migrate: ## Run migrations
	docker-compose exec app php artisan migrate
seed: ## Run seeders
	docker-compose exec app php artisan db:seed
pint: ## Run Laravel Pint (dry run)
	docker-compose exec app ./vendor/bin/pint --test
pint-fix: ## Run Laravel Pint (fix)
	docker-compose exec app ./vendor/bin/pint
analyze: ## Run PHPStan static analysis
	docker-compose exec app ./vendor/bin/phpstan analyse app --level=5
