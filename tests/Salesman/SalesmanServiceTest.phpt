<?php

declare(strict_types = 1);

namespace App\Salesman;

use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

class SalesmanServiceTest extends TestCase
{

	public function testCreate()
	{
		$service = new SalesmanService();
		$salesman = $service->createSalesman('Filip', '1234');
		Assert::same('Filip', $salesman->getName());
		Assert::same('1234', $salesman->getRegistrationId());
	}

	public function testInvalidRegistrationIdException()
	{
		$service = new SalesmanService();

		Assert::exception(function () use ($service) {
			$service->createSalesman('Filip', 'a1234');
		}, \Nette\Utils\AssertionException::class);
	}

}

(new SalesmanServiceTest())->run();
