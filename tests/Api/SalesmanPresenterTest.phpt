<?php

declare(strict_types = 1);

namespace App\Api;

use App\DbTestCase;
use App\Presenters\SalesmanPresenter;
use App\Salesman\SalesmanFacade;
use Nette\Application\IPresenterFactory;
use Nette\Application\Request;
use Nette\Application\Responses\JsonResponse;
use Nette\Http\IResponse;
use Nette\Http\Response;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

class SalesmanPresenterTest extends DbTestCase
{

	public function testCreate()
	{
		$salesmanPresenter = $this->createPresenter('Salesman');

		$response = $this->postAction(
			$salesmanPresenter,
			'Salesman',
			[
				'name' => 'Filip',
				'registrationId' => '123456',
			]
		);

		$payload = $response->getPayload();

		Assert::same('Filip', $payload['name']);
	}

	public function testRead()
	{
		$salesmanFacade = $this->getSalesmanFacade();
		$salesman = $salesmanFacade->createSalesman('Filip', '1235');
		$this->entityManager->clear();

		$salesmanPresenter = $this->createPresenter('Salesman');

		$response = $this->getAction(
			$salesmanPresenter,
			'Salesman',
			[
				'id' => $salesman->getId()->toString(),
			]
		);

		$payload = $response->getPayload();

		Assert::same($salesman->getId()->toString(), $payload['id']);
	}

	public function testReadNonexistentSalesmanException()
	{
		$salesmanFacade = $this->getSalesmanFacade();
		$salesman = $salesmanFacade->createSalesman('Filip', '1235');
		$this->entityManager->clear();

		$salesmanPresenter = $this->createPresenter('Salesman');

		$response = $this->getAction(
			$salesmanPresenter,
			'Salesman',
			[
				'id' => $salesman->getId()->toString(),
			]
		);

		Assert::same(IResponse::S404_NOT_FOUND, $this->getHttpResponse()->getCode());
		$payload = $response->getPayload();

		Assert::same('Filip', $payload['name']);
	}

	private function getSalesmanFacade(): SalesmanFacade
	{
		return $this->container->getByType(SalesmanFacade::class);
	}

	private function getHttpResponse(): Response
	{
		return $this->container->getByType(Response::class);
	}

}

(new SalesmanPresenterTest())->run();
