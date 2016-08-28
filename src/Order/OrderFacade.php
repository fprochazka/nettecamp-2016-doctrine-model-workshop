<?php

declare(strict_types = 1);

namespace App\Order;

use Doctrine\ORM\EntityManager;

class OrderFacade
{

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function createOrder()
	{
		$order = new Order();

		$this->em->persist($order);
		$this->em->flush();
	}

}
