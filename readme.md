Dependency-PHP
==============

[![Tests Status](https://github.com/czproject/dependency-php/workflows/Tests/badge.svg)](https://github.com/czproject/dependency-php/actions)

PHP class for dependency resolving.

<a href="https://www.patreon.com/bePatron?u=9680759"><img src="https://c5.patreon.com/external/logo/become_a_patron_button.png" alt="Become a Patron!" height="35"></a>
<a href="https://www.paypal.me/janpecha/1eur"><img src="https://buymecoffee.intm.org/img/button-paypal-white.png" alt="Buy me a coffee" height="35"></a>


Installation
------------

[Download a latest package](https://github.com/czproject/dependency-php/releases) or use [Composer](http://getcomposer.org/):

```
composer require czproject/dependency-php
```

Dependency-PHP requires PHP 5.6.0 or later.


Usage
-----

``` php
$resolver = new Cz\Dependency;
$resolver->add('x', array('a', 'b'))
	->add('a', array('b', 'c'))
	->add('b', 'd')
	->add('c', array('d'));

$resolver->getResolved(); // returns ['d', 'b', 'c', 'a', 'x']
```

------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/
