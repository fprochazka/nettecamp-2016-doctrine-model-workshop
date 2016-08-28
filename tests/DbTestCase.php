<?php

declare(strict_types = 1);

namespace App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Nette\Application\IPresenter;
use Nette\Application\IPresenterFactory;
use Nette\Application\Request;
use Nette\Application\Responses\JsonResponse;
use Nette\Configurator;
use Nette\DI\Container;
use Tester\TestCase;

abstract class DbTestCase extends TestCase
{

	/** @var Container */
	protected $container;

	/** @var EntityManager */
	protected $entityManager;

	protected function setUp()
	{
		$this->container = $this->createContainer();
		$this->entityManager = $this->container->getByType(EntityManager::class);
		$schemaTool = new SchemaTool($this->entityManager);
		$schemaTool->dropDatabase();
		$schemaTool->createSchema(
			$this->entityManager->getMetadataFactory()->getAllMetadata()
		);
	}

	protected function createPresenter(string $name): IPresenter
	{
		/** @var IPresenterFactory $presenterFactory */
		$presenterFactory = $this->container->getByType(IPresenterFactory::class);

		return $presenterFactory->createPresenter($name);
	}

	protected function runAction(
		IPresenter $presenter,
		string $name,
		string $method,
		string $action,
		array $data
	): JsonResponse
	{
		return $presenter->run(
			new Request(
				$name,
				$method,
				[
					'action' => $action,
					'data' => $data,
				]
			)
		);
	}

	private function createContainer(): Container
	{
		$configurator = new Configurator();

		$configurator->enableDebugger(__DIR__ . '/../log');
		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory(__DIR__ . '/../temp/tests');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__ . '/../app')
			->register();

		$configurator->addConfig(__DIR__ . '/../app/config/config.neon');
		$configurator->addConfig(__DIR__ . '/../app/config/config.local.neon');
		$configurator->addConfig(__DIR__ . '/config.neon');

		return $configurator->createContainer();
	}

}
