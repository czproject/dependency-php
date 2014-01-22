Dependency-PHP
==============

PHP class for dependency resolving.

Usage
-----

``` php
<?php
	$resolver = new Cz\Dependency;
	$resolver->add('x', array('a', 'b'))
		->add('a', array('b', 'c'))
		->add('b', 'd')
		->add('c', array('d'));

	$resolver->getResolved(); // returns ['d', 'b', 'c', 'a', 'x']
```


Installation
------------

[Download a latest package](https://github.com/czproject/dependency-php/releases) or use [Composer](http://getcomposer.org/):

```
composer require czproject/dependency-php
```

Dependency-PHP requires PHP 5.3.0 or later and ....


------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, http://janpecha.iunas.cz/
