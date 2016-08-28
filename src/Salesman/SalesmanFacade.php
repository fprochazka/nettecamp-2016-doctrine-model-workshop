<?php

declare(strict_types = 1);

namespace App\Salesman;

use Doctrine\ORM\EntityManager;

class SalesmanFacade
{

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $em;

	/**
	 * @var \App\Salesman\SalesmanService
	 */
	private $salesmanService;

	public function __construct(
		SalesmanService $salesmanService,
		EntityManager $em
	)
	{
		$this->em = $em;
		$this->salesmanService = $salesmanService;
	}

	public function createSalesman(string $name, string $registrationId): Salesman
	{
		$salesman = $this->salesmanService->createSalesman($name, $registrationId);

		$this->em->persist($salesman);
		$this->em->flush();

		return $salesman;
	}

}
