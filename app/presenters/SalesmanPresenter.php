<?php

declare(strict_types = 1);

namespace App\Presenters;

use App\Api\SalesmanResponseFactory;
use App\Salesman\SalesmanFacade;
use App\Salesman\SalesmanRepository;
use Nette;
use Ramsey\Uuid\Uuid;

class SalesmanPresenter extends Nette\Application\UI\Presenter
{

	/** @var SalesmanFacade @inject */
	public $salesmanFacade;

	/** @var SalesmanRepository @inject */
	public $salesmanRepository;

	/** @var SalesmanResponseFactory @inject */
	public $salesmanResponseFactory;

	public function actionCreate(array $data)
	{
		$salesman = $this->salesmanFacade->createSalesman(
			$data['name'],
			$data['registrationId']
		);

		$this->getHttpResponse()->setCode(Nette\Http\IResponse::S201_CREATED);
		$this->sendJson($this->salesmanResponseFactory->createSalesmanResponse($salesman));
	}

	public function actionRead(string $id)
	{
		try {
			$salesman = $this->salesmanRepository->getById(Uuid::fromString($id));

			$this->sendJson($this->salesmanResponseFactory->createSalesmanResponse($salesman));

		} catch (\App\Salesman\Exceptions\SalesmanNotFoundByIdException $e) {
			$this->getHttpResponse()->setCode(Nette\Http\IResponse::S404_NOT_FOUND);
			$this->sendJson([
				'error' => [
					'code' => 'salesman-not-found',
					'message' => $e->getMessage(),
				]
			]);
		}
	}

}
