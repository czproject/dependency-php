<?php

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


#$resolver = new Cz\Dependency;
#$resolver->add('f1', array('f2', 'f3', 'f4'));
#$resolver->add('f2');
#$resolver->add('f3');
#$resolver->add('f4', array('f2'));

#Assert::same(array('f2', 'f3', 'f1', 'f4'), $resolver->getResolved());
#$resolver->reset();



$resolver = new CzProject\DependencyPhp\Resolver;
$resolver->add('f1', ['f4', 'f2', 'f3']);
$resolver->add('f2');
$resolver->add('f3');
$resolver->add('f4', ['f2']);

Assert::same(['f2', 'f4', 'f3', 'f1'], $resolver->getResolved());
$resolver->reset();



$resolver = new CzProject\DependencyPhp\Resolver;
$resolver->add('f1', ['f2', 'f3']);
$resolver->add('f2');
$resolver->add('f3');
$resolver->add('f4', ['f2']);

Assert::same(['f2', 'f3', 'f1', 'f4'], $resolver->getResolved());
$resolver->reset();



# sirotek
$resolver = new CzProject\DependencyPhp\Resolver;
$resolver->add('x', ['a', 'b']);
$resolver->add('a', ['b', 'c']);
$resolver->add('b', 'd');
$resolver->add('c', ['d']);

Assert::same(['d', 'b', 'c', 'a', 'x'], $resolver->getResolved());
# cache test
Assert::same(['d', 'b', 'c', 'a', 'x'], $resolver->getResolved());
$resolver->reset();



# fluent interface
$resolver = new CzProject\DependencyPhp\Resolver;
$result = $resolver->add('x', ['a', 'b'])
	->add('a', ['b', 'c'])
	->add('b', 'd')
	->add('c', ['d'])
	->getResolved();

Assert::same(['d', 'b', 'c', 'a', 'x'], $result);
