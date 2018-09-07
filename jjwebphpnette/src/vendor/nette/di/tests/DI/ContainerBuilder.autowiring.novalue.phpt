<?php

/**
 * Test: Nette\DI\ContainerBuilder and missing values.
 */

declare(strict_types=1);

use Nette\DI;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


class Foo
{
	public function __construct($x)
	{
	}
}

Assert::exception(function () {
	$builder = new DI\ContainerBuilder;
	$builder->addDefinition('foo')->setType('Foo');
	$container = createContainer($builder);
}, Nette\DI\ServiceCreationException::class, "Service 'foo' (type of Foo): Parameter \$x in Foo::__construct() has no class type hint or default value, so its value must be specified.");


class Bar
{
	public function __construct(array $x)
	{
	}
}

Assert::exception(function () {
	$builder = new DI\ContainerBuilder;
	$builder->addDefinition('foo')->setType('Bar');
	$container = createContainer($builder);
}, Nette\DI\ServiceCreationException::class, "Service 'foo' (type of Bar): Parameter \$x in Bar::__construct() has no class type hint or default value, so its value must be specified.");