<?php

declare(strict_types = 1);

namespace App\Salesman;

use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;

class SalesmanRepository
{

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function getById(Uuid $salesmanId): Salesman
	{
		try {
			return $this->em->createQueryBuilder()
				->select('salesman')
				->from(Salesman::class, 'salesman')
				->andWhere('salesman.id = :id')->setParameter('id', $salesmanId->toString())
				->getQuery()
				->getSingleResult();

		} catch (\Doctrine\ORM\NoResultException $e) {
			throw new \App\Salesman\Exceptions\SalesmanNotFoundByIdException($salesmanId, $e);
		}
	}

}
