ARTIFACT=$(shell basename $(PWD))

build:
	composer install
	docker compose build --no-cache

build-test:
	docker build \
		--no-cache -f ${PWD}/docker-compose/Dockerfile.test \
		-t ${ARTIFACT}:test .

setup: build build-test
	cp .env.example .env
	touch ./database/database.sqlite

run:
	docker compose up || \
		docker compose rm -f

test:
	docker run --rm \
		-v "${PWD}:/app" \
		-v "${PWD}/docker-compose/php/app.ini:/usr/local/etc/php/conf.d/app.ini" \
		${ARTIFACT}:test
