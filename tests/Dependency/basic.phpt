<?php
use Tester\Assert;

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/../../src/Dependency.php';


#$resolver = new Cz\Dependency;
#$resolver->add('f1', array('f2', 'f3', 'f4'));
#$resolver->add('f2');
#$resolver->add('f3');
#$resolver->add('f4', array('f2'));

#Assert::same(array('f2', 'f3', 'f1', 'f4'), $resolver->getResolved());
#$resolver->reset();



$resolver = new Cz\Dependency;
$resolver->add('f1', array('f4', 'f2', 'f3'));
$resolver->add('f2');
$resolver->add('f3');
$resolver->add('f4', array('f2'));

Assert::same(array('f2', 'f4', 'f3', 'f1'), $resolver->getResolved());
$resolver->reset();



$resolver = new Cz\Dependency;
$resolver->add('f1', array('f2', 'f3'));
$resolver->add('f2');
$resolver->add('f3');
$resolver->add('f4', array('f2'));

Assert::same(array('f2', 'f3', 'f1', 'f4'), $resolver->getResolved());
$resolver->reset();



# sirotek
$resolver = new Cz\Dependency;
$resolver->add('x', array('a', 'b'));
$resolver->add('a', array('b', 'c'));
$resolver->add('b', 'd');
$resolver->add('c', array('d'));

Assert::same(array('d', 'b', 'c', 'a', 'x'), $resolver->getResolved());
$resolver->reset();



# fluent interface
$resolver = new Cz\Dependency;
$result = $resolver->add('x', array('a', 'b'))
	->add('a', array('b', 'c'))
	->add('b', 'd')
	->add('c', array('d'))
	->getResolved();

Assert::same(array('d', 'b', 'c', 'a', 'x'), $result);


