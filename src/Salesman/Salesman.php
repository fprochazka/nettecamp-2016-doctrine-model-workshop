<?php

declare(strict_types = 1);

namespace App\Order;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 */
class Salesman
{

	const BABIS_DEFAULT_SHARE = 30;

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var \Ramsey\Uuid\Uuid
	 */
	private $id;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\Column(type="string")
	 * @var string
	 */
	private $registrationId;

	public function __construct(string $name, string $registrationId)
	{
		$this->id = Uuid::uuid4();
		$this->name = $name;
		$this->registrationId = $registrationId;
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

}
