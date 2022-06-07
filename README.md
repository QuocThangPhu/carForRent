# carForRent

## I.About Project 
1. **Car For Rent** is a website was built to help people who can rent a car for travel, picnic, whatever.
    The people can find the car they want  and rent this car.
2. The website is written by PHP, and SQL from scratch in 3 weeks with the guidance of Mr.Tinh and Mr.Bang. 

## II.Getting Started

1. Follow this article to install Nginx in Ubuntu 20.04: 
    [Click here](https://www.digitalocean.com/community/tutorials/how-to-install-nginx-on-ubuntu-20-04)
2. Clone project to local: [Click here](https://github.com/QuocThangPhu/carForRent)
3. Make a copy of the file `.env.example` and rename it to `.env`
4. Edit all the parameters in `.env` corresponding to your environment
5. Install Xdebug to generate test coverage:

    ```bash
    sudo apt-get install php-xdebug
    sudo apt-get install php-simplexml
    ```
6. Install all necessary packages, and dependencies by using composer:

    ```bash
    composer install
    ```
Run the project and enjoy.

## III.Something Command 
1. Run Scan error Psalm
    ```bash
   - Scan: ./vendor/bin/psalm
   - Fix : ./vendor/bin/psalm --alter --issues=MissingReturnType,MismatchingDocblockParamType,MissingParamType --dry-run
    ```
2. Run UnitTest
    ```bash
   - Run all and reload coverage: XDEBUG_MODE=coverage ./vendor/bin/phpunit tests --coverage-html coverage
   - Run only file:  ./vendor/bin/phpunit ./tests/Repository/UserRepositoryTest.php
    ```
3. Code style: 
    ```bash
   - Fix code style: phpcbf --standard=PSR2 --extensions=php src
   - Scan code style: phpcs --standard=PSR2 --extensions=php src
    ```
