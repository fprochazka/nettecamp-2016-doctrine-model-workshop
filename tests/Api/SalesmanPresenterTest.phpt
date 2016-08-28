<?php

declare(strict_types = 1);

namespace App\Api;

use App\DbTestCase;
use App\Presenters\SalesmanPresenter;
use Nette\Application\IPresenterFactory;
use Nette\Application\Request;
use Nette\Application\Responses\JsonResponse;
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

}

(new SalesmanPresenterTest())->run();
