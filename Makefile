.PHONY: init start stop restart down cc php logs migrate seed test

init:
	cp .env.local .env
	docker-compose build && \
	make start

start:
	cp .env.local .env
	docker-compose up -d

stop:
	docker-compose stop
	rm -vf .env

restart: stop start

down:
	make cc
	docker-compose down
	docker volume prune -f
	docker network prune -f
	rm -vf .env

cc:
	docker-compose exec php php artisan cache:clear
	docker-compose exec php php artisan config:clear
	docker-compose exec php php artisan route:cache
	docker-compose exec php php artisan view:clear
	docker-compose exec php rm -Rvf ./storage/logs/*

php:
	docker-compose exec php bash

logs:
	tail -f storage/logs/*.log

migrate:
	docker-compose exec php php artisan migrate

seed:
	docker-compose exec php php artisan db:seed

test:
	docker-compose exec php ./vendor/bin/phpunit --disallow-todo-tests --stop-on-error --stop-on-failure --debug -v --colors=always $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
