<?php
use Tester\Assert;

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/../../src/Dependency.php';


$resolver = new Cz\Dependency;
$resolver->add('f1', array('f4', 'f2', 'f3'));
Assert::same(array('f4', 'f2', 'f3', 'f1'), $resolver->getResolved());

$resolver->add('f2');
Assert::same(array('f4', 'f2', 'f3', 'f1'), $resolver->getResolved());

$resolver->add('f3');
Assert::same(array('f4', 'f2', 'f3', 'f1'), $resolver->getResolved());

$resolver->add('f4', array('f2'));
Assert::same(array('f2', 'f4', 'f3', 'f1'), $resolver->getResolved());

$resolver->reset();



$resolver = new Cz\Dependency;
$resolver->add('x', array('a', 'b'));
Assert::same(array('a', 'b', 'x'), $resolver->getResolved());

$resolver->add('a', array('b', 'c'));
Assert::same(array('b', 'c', 'a', 'x'), $resolver->getResolved());

$resolver->add('b', 'd');
Assert::same(array('d', 'b', 'c', 'a', 'x'), $resolver->getResolved());

$resolver->add('c', array('d'));
Assert::same(array('d', 'b', 'c', 'a', 'x'), $resolver->getResolved());

$resolver->reset();
