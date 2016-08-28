<?php

declare(strict_types = 1);

namespace App\Order;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`order`")
 */
class Order
{

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var \Ramsey\Uuid\Uuid
	 */
	private $id;

	public function __construct()
	{
		$this->id = Uuid::uuid4();
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

}
