<?php

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


$resolver = new CzProject\DependencyPhp\Resolver;
$resolver->add('f1', ['f4', 'f2', 'f3']);
Assert::same(['f4', 'f2', 'f3', 'f1'], $resolver->getResolved());

$resolver->add('f2');
Assert::same(['f4', 'f2', 'f3', 'f1'], $resolver->getResolved());

$resolver->add('f3');
Assert::same(['f4', 'f2', 'f3', 'f1'], $resolver->getResolved());

$resolver->add('f4', ['f2']);
Assert::same(['f2', 'f4', 'f3', 'f1'], $resolver->getResolved());

$resolver->reset();



$resolver = new CzProject\DependencyPhp\Resolver;
$resolver->add('x', ['a', 'b']);
Assert::same(['a', 'b', 'x'], $resolver->getResolved());

$resolver->add('a', ['b', 'c']);
Assert::same(['b', 'c', 'a', 'x'], $resolver->getResolved());

$resolver->add('b', 'd');
Assert::same(['d', 'b', 'c', 'a', 'x'], $resolver->getResolved());

$resolver->add('c', ['d']);
Assert::same(['d', 'b', 'c', 'a', 'x'], $resolver->getResolved());

$resolver->reset();
