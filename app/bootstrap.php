<?php

declare(strict_types = 1);

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

//$configurator->setDebugMode('23.75.345.200'); // enable for your remote IP
$configurator->enableDebugger(__DIR__ . '/../log');

$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');

\Tracy\Dumper::$objectExporters[\Ramsey\Uuid\Uuid::class] = function (\Ramsey\Uuid\Uuid $uuid): array {
	return ['value' => $uuid->toString()];
};

$container = $configurator->createContainer();

return $container;
