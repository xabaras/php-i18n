# README #

Here follows a brief description of what is php-i18n and how to get it to work properly.

## What is php-i18n ##

php-i18n is an internationalization library for php web applications, it is aimed to help developers getting rid of custom code when dealing with website localizations.


## How do I get set up? ##

It is simple to getting started with php-i18n you should simply:

* Deploy the php-i18n directory anywhere you want on a php enabled server
* Fill in the proper configuration values in the "CONFIGUIRATION SECTION" in the "php-i18n / php-i18n.php" file
* Add localization files to the l10n directory

### CONFIGURATION ###

In the "CONFIGURATION SECTION" of the "php-i18n/php-i18n.php" file you'll find the following configuration options:

```
#!php

/* Path where php-i18n library is placed */
$phpi18n_PATH = $_SERVER["DOCUMENT_ROOT"] . "/php-i18n/php-i18n/";

/* Path where localization files (es: strings_en.l10n) are placed */
$l10n_PATH = $_SERVER["DOCUMENT_ROOT"] . "/php-i18n/php-i18n/l10n/";

/* Default language (two letters ISO 639-1 code) for the webapp (the matching file must exist) */
$DEFAULT_LANGUAGE="en";

/* Says whether to choose current language based on client or not  */
$DETECT_CURRENT_LANGUAGE=true;
```
### Localization files ###

You can write a localization file for each language. Localization files (extension .l10n) are automatically detected from the l10n directory provided that their name is strings_xx.l10n, where "xx" is the two letters ISO 639-1 code of the laguage to which the translation refers to.

Localization files use the Java [Property Resources Bundle](http://en.wikipedia.org/wiki/.properties) file format:


```
#!properties

# Default l10n file
hello_world=Hello %s, this page is in English
lblYourLanguage=Your language is:
lblAvailable=Available languages:
lblSetLanguage=Change language
lblJsSample=Click here to run a JavaScript call sample
msgJsSample=Hello %s, this is a JavaScript call sample

# Language specific keys, don't remove
country_code=US
locale=en_US
```
N.B. You must specify and never remove country_code and locale properties in each localization file.

## Usage ##

php-i18n provide simple API to access localized strings, all you have to do is including php-i18n.php in your php file (e.g. `include_once "../php-i18n/php-i18n.php";`) and use one of the methods provided by the php-18n API.

See [hello world sample](https://github.com/xabaras/php-i18n/blob/master/samples/helloworld.php) for any examples.


#### getString($key) ###
Returns a localized string for the given key.

Can also be accessed as `Phpi18n::getInstance()->getString($key)`

#### printString($key) ###
Prints a localized string for the given key.

Can also be accessed as `Phpi18n::getInstance()->printString($key)`


#### getFormattedString($key, $args) ###
Returns a formatted localized string replacing placeholders with supplied values.

It uses the same format as sprintf.

Can also be accessed as `Phpi18n::getInstance()->getFormattedString($key, $args)`


#### printFormattedString($key, $args) ###
Prints a formatted localized string replacing placeholders with supplied values.

It uses the same format as sprintf.

Can also be accessed as `Phpi18n::getInstance()->printFormattedString($key, $args)`

## JavaScript extension ##

php-i18n provides a JavaScript extension to let you use localization in your Javascript code as well as in php one.
All you have to do is include the 'php-i18n /ext /js-i18n/js-i18n.php' in your php file and you'll be able to use getString and getFormattedString from within your JS scripts.

There also are methods getStringAsync and getFormattedStringAsync performing asinchronous operations and returning a Promise (only from js-i18n v1.1 on).

See [hello world sample](https://github.com/xabaras/php-i18n/blob/master/samples/helloworld.php) for a sample of how it works.

N.B. js-i18n extension requires jQuery 


## Contribution guidelines ##

You can contribute to the project by:

* Reporting issues
* Writing tests
* Proposing missing features

## Who do I talk to? ##

Paolo Montalto (repository owner): <p.montalto@twomensudio.com>
