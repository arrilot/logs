[![Latest Stable Version](https://poser.pugx.org/arrilot/logs/v/stable.svg)](https://packagist.org/packages/arrilot/logs/)
[![Total Downloads](https://img.shields.io/packagist/dt/arrilot/logs.svg?style=flat)](https://packagist.org/packages/Arrilot/logs)
[![Build Status](https://img.shields.io/travis/arrilot/logs/master.svg?style=flat)](https://travis-ci.org/arrilot/logs)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/arrilot/logs/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/arrilot/logs/)

# Simple trait that makes any class able to use PSR-3 loggers.

## Installation

`composer require arrilot/logs`

## Usage

```php
use Arrilot\Logs\Logs;

class Foo
{
    use Logs;

    function bar()
    {
        $this->logger()->error('Error happened in bar!);
        $this->logger()->warning('Warning happened in bar!);
        // etc
    }
}


$foo = new Foo();
$foo->bar(); // Everything is ok, but nothing was logged anywhere because no logger was set.

$foo->setLogger($anyPsr3LoggerHere);
$foo->bar(); // There is a log record in $anyPsr3LoggerHere now.

$foo->setEchoLogger();
$foo->bar(); // 'ALERT: Something bad happened in bar' is echo'ed to a screen.

// If you are using Monolog\Registry to store loggers, you can simply pass a logger name and the package will grab a logger from the Registry.
$foo->setLogger('application_log');
$foo->bar(); // There is a record in application log.
```

You can also use `Arrilot\Logs\EchoLogger` as a separate PSR-3 logger without a trait.
