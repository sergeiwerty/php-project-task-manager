start:
	npm run dev

#start:
#	php artisan serve --host 0.0.0.0

setup:
	make install
	cp -n .env.example .env
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate --force
	php artisan db:seed
	npm ci
	npm run build

install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpstan -- --level=6 analyse app tests database
	composer exec phpcs -- --standard=PSR12 app tests

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app routes tests database lang

test:
	docker compose exec -it pgsql psql -U homestead -tc "SELECT 1 FROM pg_database WHERE datname = 'db_app_test'" | grep -q 1 || docker compose exec -it pgsql psql -U homestead -c "CREATE DATABASE db_app_test"
	docker compose exec -it php php artisan test


test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

clear-cache:
#	docker-compose run --rm artisan cache:clear
#	docker-compose run --rm artisan config:cache
#	docker-compose run --rm artisan view:clear
#	docker-compose run --rm artisan route:clear
#	docker-compose run --rm artisan config:clear
	php artisan route:clear
	php artisan config:clear
	php artisan cache:clear