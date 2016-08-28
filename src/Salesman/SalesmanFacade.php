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

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function createSalesman(string $name, string $registrationId): Salesman
	{
		$salesman = new Salesman(
			$name,
			$registrationId
		);

		$this->em->persist($salesman);
		$this->em->flush();

		return $salesman;
	}

}
