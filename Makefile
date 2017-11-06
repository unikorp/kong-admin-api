PATH := $(PATH):$(HOME)/.local/bin:$(HOME)/bin:/bin:/usr/local/bin
SHELL := /usr/bin/env bash

.DEFAULT_GOAL := help

help: ## Display this help
	@grep -E '^[a-zA-Z1-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
		| sort \
		| awk 'BEGIN { FS = ":.*?## " }; { printf "\033[36m%-30s\033[0m %s\n", $$1, $$2 }'

install: ## Install
	$(info --> Install)
	@make install-vendor

install-vendor: ## Install vendor
	$(info --> Install composer vendor)
	@composer install

test: ## Test
	$(info --> Execute all tests)
	@docker-compose -f tests/Functional/docker-compose.yml down &>/dev/null
	@docker-compose -f tests/Functional/docker-compose.yml up -d --scale kong=2 &>/dev/null
	@sleep 5
	@docker run --rm --env "KONG_DATABASE=postgres" --env "KONG_PG_HOST=functional_db_1" --link "functional_db_1" --network "functional_default" kong:0.11.1 kong migrations up &>/dev/null
	@sleep 15
	@./vendor/bin/phpunit
	@docker-compose -f tests/Functional/docker-compose.yml down &>/dev/null

test-unit: ## Unit test
	$(info --> Execute unit tests)
	@./vendor/bin/phpunit tests/Unit

test-functional: ## Functional test
	$(info --> Execute functional tests)
	@docker-compose -f tests/Functional/docker-compose.yml down &>/dev/null
	@docker-compose -f tests/Functional/docker-compose.yml up -d --scale kong=2 &>/dev/null
	@sleep 5
	@docker run --rm --env "KONG_DATABASE=postgres" --env "KONG_PG_HOST=functional_db_1" --link "functional_db_1" --network "functional_default" kong:0.11.1 kong migrations up &>/dev/null
	@sleep 15
	@./vendor/bin/phpunit tests/Functional
	@docker-compose -f tests/Functional/docker-compose.yml down &>/dev/null
