# Opinionated Monolog factory

![Continuous Integration](https://github.com/wyrihaximus/php-monolog-factory/workflows/Continuous%20Integration/badge.svg)
[![Latest Stable Version](https://poser.pugx.org/wyrihaximus/monolog-factory/v/stable.png)](https://packagist.org/packages/wyrihaximus/monolog-factory)
[![Total Downloads](https://poser.pugx.org/wyrihaximus/monolog-factory/downloads.png)](https://packagist.org/packages/wyrihaximus/monolog-factory/stats)
[![Type Coverage](https://shepherd.dev/github/WyriHaximus/php-monolog-factory/coverage.svg)](https://shepherd.dev/github/WyriHaximus/php-monolog-factory)
[![License](https://poser.pugx.org/wyrihaximus/monolog-factory/license.png)](https://packagist.org/packages/wyrihaximus/monolog-factory)

# Installation

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/monolog-factory
```

# Usage

```php
<?php

use Psr\Log\LoggerInterface;
use WyriHaximus\Monolog\Factory;

$handler = new LoggerInterface();
$monolog = Factory::create('name', $handler, []);
$monolog->info('Information');
```

# License

The MIT License (MIT)

Copyright (c) 2024 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

