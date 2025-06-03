<?php

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


$resolver = new CzProject\DependencyPhp\Resolver;

$resolver->add('a', ['b']);
$resolver->add('b', ['c']);
$resolver->add('c', ['d']);
$resolver->add('d', ['a']);

Assert::same(['d', 'c', 'b', 'a'], $resolver->getResolved());


$resolver = new CzProject\DependencyPhp\Resolver;

$resolver->add('a', ['b']);
$resolver->add('b', ['c']);
$resolver->add('c', ['d']);
$resolver->add('d', ['a']);
$resolver->add('e', ['b']);

Assert::same(['d', 'c', 'b', 'a', 'e'], $resolver->getResolved());
