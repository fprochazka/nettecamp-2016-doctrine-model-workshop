<?php

declare(strict_types = 1);

namespace App\Order;

use Doctrine\ORM\EntityManager;

class OrderRepository
{

	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

}
