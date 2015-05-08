
<style>
#logo {
    position: relative;
    padding: 0.1em 0.2em;
    letter-spacing: 1px;
    margin: 0;
    width: 165px;
    height: 50px;
    line-height: 1.7em;
    background-color: #28aae4;
    border: 7px solid rgba(0, 0, 0, 0.15);
    overflow: hidden;
}

#typolib-title {
    color: #fff;
    font-size: 2em;
    font-weight: normal;
    font-style: italic;
    position: absolute;
    left: 0.1em;
    z-index: 1;
}

#typolib-title::before {
    content: "";
    -webkit-transform: rotate(11.4deg);
    -moz-transform:    rotate(11.4deg);
    -o-transform:      rotate(11.4deg);
    transform:         rotate(11.4deg);
    width: 90px;
    height: 90px;
    background-color: rgba(0, 0, 0, 0.15);
    position: absolute;
    display: block;
    z-index: -1;
    right: -33px;
    top: -20px;
}
</style>
<h1 id="logo" align="center"><span id="typolib-title">Typolib’</span></h1>


Typolib’ is a project created by French students in MIAGE with the help of the [Mozilla Localization Drivers team](https://wiki.mozilla.org/L10n:Mozilla_Team).


***


**Mailing List:** [al2c-typolib@googlegroups.com](mailto:al2c-typolib@googlegroups.com)


**Build Status:** [![Build Status](https://api.travis-ci.org/TheoChevalier/typolib.svg)](https://travis-ci.org/TheoChevalier/typolib)


**Test Coverage:** [![Coverage Status](https://coveralls.io/repos/TheoChevalier/typolib/badge.svg)](https://coveralls.io/r/TheoChevalier/typolib)


## Dependencies

- PHP >= 5.4
- php-curl extension (```sudo apt-get install php5-curl```)
- Composer (Dependency Manager for PHP, [Composer](http://getcomposer.org/))



## Auto setup + running Typolib’

To setup automatically the project, just run the ```start.sh``` script.

You can run Typolib’ in your local machine either with the ```start.sh``` script or with ```php -S localhost:8080 -t web/ app/inc/router.php``` and opening http://localhost:8080/ with your browser. To bound PHP internal web server to 0.0.0.0 use ```start.sh -remote```: server will be accessible from other devices in the LAN, or from the host machine in case Typolib’ is running inside a Virtual Machine.

## Manual setup

If you can’t run start.sh, follow these steps.

1. Set up the config file. In ```app/config```, copy/paste ```config.ini-dist``` and rename it into ```config.ini```

Edit the file and provide the install and config path information.
Here is my config for reference:


install=/home/theo/moz/github/typolib


config=/home/theo/moz/github/typolib/app/config


2. Installing and running Composer to get dependencies:

In a terminal, change directory to the “Typolib” repository you just cloned, then run:

```curl -sS https://getcomposer.org/installer | php && php composer.phar install```


## Update dependencies with composer

```php composer.phar update``` (or ```composer update``` if installed globally)


## Before committing

### Run Unit tests

Before committing your work, run Unit tests to check you’re not creating any regression.
From typolib root folder, run:

```php vendor/atoum/atoum/bin/atoum -d tests/units/```


You should see a green line in your terminal stating something like:


```Success (1 test, 9/9 methods, 0 void method, 0 skipped method, 55 assertions)!```


### Run PHP CS fixer

php-cs-fixer will check the code on all the project and apply our coding guidelines (as specified in .php_cs file).
Once you’re ready to commit, just run:

```vendor/bin/php-cs-fixer fix```


All your code should now follow our guidelines, you can commit and open a Pull-Request. Travis-CI will also run both atoum and php-cs-fixer automatically and warn you if you need to fix something.


If the Travis run has failed, fix the issue on your branch, then commit and push again and watch for Travis result.
