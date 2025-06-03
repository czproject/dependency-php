Dependency-PHP
==============

[![Build Status](https://github.com/czproject/dependency-php/workflows/Build/badge.svg)](https://github.com/czproject/dependency-php/actions)
[![Downloads this Month](https://img.shields.io/packagist/dm/czproject/dependency-php.svg)](https://packagist.org/packages/czproject/dependency-php)
[![Latest Stable Version](https://poser.pugx.org/czproject/dependency-php/v/stable)](https://github.com/czproject/dependency-php/releases)
[![License](https://img.shields.io/badge/license-New%20BSD-blue.svg)](https://github.com/czproject/dependency-php/blob/master/license.md)

PHP class for dependency resolving.

<a href="https://www.janpecha.cz/donate/"><img src="https://buymecoffee.intm.org/img/donate-banner.v1.svg" alt="Donate" height="100"></a>


Installation
------------

[Download a latest package](https://github.com/czproject/dependency-php/releases) or use [Composer](http://getcomposer.org/):

```
composer require czproject/dependency-php
```

Dependency-PHP requires PHP 8.0 or later.


Usage
-----

``` php
$resolver = new CzProject\DependencyPhp\Resolver;
$resolver->add('x', array('a', 'b'))
	->add('a', array('b', 'c'))
	->add('b', 'd')
	->add('c', array('d'));

$resolver->getResolved(); // returns ['d', 'b', 'c', 'a', 'x']
```

------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/
