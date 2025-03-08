PWD = $(shell pwd -L)
IMAGE = ballastlane-app:latest
CONTAINER = docker run -u root --rm -it --network=ballastlane_default -v ${PWD}:/application ${IMAGE}

configure:
	@${CONTAINER} composer update --optimize-autoloader && npm install

test:
	@${CONTAINER} php artisan test --env=testing

migrate:
	@${CONTAINER} php artisan migrate

migrate-rollback:
	@${CONTAINER} php artisan migrate:rollback

seed:
	@${CONTAINER} php artisan db:seed

load-initial:
	.migrate .seed .initial-dump

recreate:
	docker-compose stop && docker-compose down && docker-compose up -d