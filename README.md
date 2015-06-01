Monolol
=======

PSR-3 compliant lol-gger

QA
--

[![Build Status](https://travis-ci.org/devwebpeanuts/monolol.svg?branch=master)](https://travis-ci.org/devwebpeanuts/monolol)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/devwebpeanuts/monolol/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/devwebpeanuts/monolol/?branch=master)

INSTALLATION
------------
Use composer:
```sh
composer require PHPointless/monolol
```

HOW TO USE IT
-------------

Monolol provide new wrapper handler for Monolog : LolHandler.
LolHandler will apply a Lolifier that will do some stuff on records handled by wrapped handler.

For example, we want to randomly shuffle log message words of all records that will be handled by a Monolog StreamHandler.
Here is the code that will do the trick:

```php
<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolol\Handlers\LolHandler;
use Monolol\Lolifiers;

$logger = new Logger('myLog');
$streamHandler = new StreamHandler(__DIR__ . '/monolol.log');

$lolHandler = new LolHandler($streamHandler, new Lolifiers\Shuffle());

$logger->pushHandler($lolHandler);

$logger->info('My littlest pony');
$logger->error('This burger has no cheese');
```

AVAILABLE LOLIFIERS
-------------------

- _Shuffle_: Words contained in record message will be randomly shuffled
- _Confuse_: This lolifier will change randomly the log level of the record
- _GeekTime_: Records will be handled only if it's 1:37pm (13:37)
- _Hangman_: Wants to play hangman game while reading your logfiles ?
- _Hash_: records message will be hashed with an algorithm randomly chosen
- _LaMerNoire_: records message will be replaced by the following string : 'La mer Noire'
- _Mirror_: records message content will be reversed (desrever eb lliw tnetnoc egassem sdrocer)
- _NotGiveAFuck_: message of records having loglevel above INFO will be replaced by the following string : "It seems that your application has encountered an issue. But as we don't give a fuck, we will not tell you what the problem is. Have a good day"
- _Quote_: records message will be replaced by a quote randomly chosen. Quote Lolifier needs a QuoteProvider. Here's an example of how to use it :
```php
$quoteProvider = new Lolifiers\QuoteProviders\Kaamelot\Kadoc();
$lolHandler = new LolHandler($streamHandler, new Lolifiers\Quote($quoteProvider));
```
If you want quotes from more than one provider, you can use QuoteProviders\Collection
```php
$quoteProvider = new Lolifiers\QuoteProviders\Collection();
$quoteProvider->add(new Lolifiers\QuoteProviders\Kaamelot\Kadoc())
              ->add(new Lolifiers\QuoteProviders\Kaamelot\Karadoc())
              ->add(new Lolifiers\QuoteProviders\Kaamelot\Perceval());
$lolHandler = new LolHandler($streamHandler, new Lolifiers\Quote($quoteProvider));
```
- _Warp_: handle records will travel through the Warp
- _Yell_: TO READ YOUR LOG FILES IN NOISY ENVIRONMENTS
- _Yolo_: "An error? What are you talking about? There was no error!". All records having loglevel above INFO will not be handled
- _Tourette_: Monolog is suffering a Tourette's syndrom. This lolifier needs a SwearWordsProvider. Here's an example of how to use it :
```php
$swearWordsProvider = new Lolifiers\Lolifiers\SwearWordsProviders\DefaultProvider();
$lolHandler = new LolHandler($streamHandler, new Lolifiers\Tourette($swearWordsProvider));
```
