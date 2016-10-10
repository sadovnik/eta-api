install:
	composer install

force-install:
	composer install --ignore-platform-reqs

autoload:
	composer dump-autoload

test:
	composer exec 'phpunit ${ARGS}'

lint:
	composer exec 'phpcs --standard=PSR2 src tests'

send-coverage:
	composer exec test-reporter

migrate:
	# There's no real migration tool for simplicity's sake
	mongo < app/migrations/indexLocation.js
