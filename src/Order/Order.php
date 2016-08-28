<?php

declare(strict_types = 1);

namespace App\Order;

use App\Salesman\Salesman;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`order`")
 */
class Order
{

	const BABIS_DEFAULT_SHARE = 30;

	/**
	 * @ORM\Id()
	 * @ORM\Column(type="uuid")
	 * @var \Ramsey\Uuid\Uuid
	 */
	private $id;

	/**
	 * @ORM\Column(type="datetime")
	 * @var \DateTime
	 */
	private $createdDate;

	/**
	 * @ORM\Column(type="integer")
	 * @var integer
	 */
	private $amount;

	/**
	 * @ORM\Column(type="integer")
	 * @var integer
	 */
	private $taxRate;

	/**
	 * @ORM\Column(type="integer")
	 * @var integer
	 */
	private $babisPercentageShare;

	/**
	 * @ORM\ManyToOne(targetEntity=Salesman::class, cascade={"persist"})
	 * @ORM\JoinColumn(nullable=FALSE)
	 * @var Salesman
	 */
	private $salesman;

	public function __construct(
		int $amount,
		int $taxRate,
		\DateTimeInterface $createdDate,
		Salesman $salesman
	)
	{
		$this->id = Uuid::uuid4();
		$this->babisPercentageShare = self::BABIS_DEFAULT_SHARE;
		$this->amount = $amount;
		$this->createdDate = $createdDate;
		$this->taxRate = $taxRate;
		$this->salesman = $salesman;
	}

	public function getId(): Uuid
	{
		return $this->id;
	}

}
