# carForRent

## I.About Project 
1. This is my project in Unlock Program.
2. Language: Php, bootstrap,

## II.Something command 
1. Run Scan error Psalm
- Scan: ./vendor/bin/psalm
- Fix : ./vendor/bin/psalm --alter --issues=MissingReturnType,MismatchingDocblockParamType,MissingParamType --dry-run
2. Run UnitTest
- Run all and reload coverage: XDEBUG_MODE=coverage ./vendor/bin/phpunit tests --coverage-html coverage
- Run only file:  ./vendor/bin/phpunit ./tests/Repository/UserRepositoryTest.php
3. Code style: 
- Fix code style: phpcbf --standard=PSR2 --extensions=php src
- Scan code style: phpcs --standard=PSR2 --extensions=php src
