setup:
	docker build -t php-cli-img .
run:
	docker run -it --rm php-cli-img
unitTest:
	docker run -it --rm php-cli-img vendor/bin/phpunit
behavioralTest:		
	docker run -it --rm php-cli-img vendor/bin/behat
codeStyleChecker:		
	docker run -it --rm php-cli-img vendor/bin/phpcs --standard=./phpcs.xml