d-up:
	docker-compose up -d

d-down:
	docker-compose down

d-build:
	docker-compose up --build -d

test:
	docker exec app vendor/bin/phpunit --colors=always

perm:
	sudo chown ${USER}:${USER} bootstrap/cache -R
	sudo chown ${USER}:${USER} storage -R
