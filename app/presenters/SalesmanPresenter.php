<?php

declare(strict_types = 1);

namespace App\Presenters;

use App\Salesman\SalesmanFacade;
use Nette;


class SalesmanPresenter extends Nette\Application\UI\Presenter
{

	/** @var  SalesmanFacade @inject */
	public $salesmanFacade;

	public function actionCreate(array $data)
	{
		$salesman = $this->salesmanFacade->createSalesman(
			$data['name'],
			$data['registrationId']
		);

		$this->getHttpResponse()->setCode(Nette\Http\IResponse::S201_CREATED);
		$this->sendJson([
			'id' => $salesman->getId(),
			'name' => $salesman->getName(),
			'registrationId' => $salesman->getRegistrationId(),
		]);
	}

}
