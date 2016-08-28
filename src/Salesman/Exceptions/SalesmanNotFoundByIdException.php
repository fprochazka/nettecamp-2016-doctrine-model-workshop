<?php

declare(strict_types = 1);

namespace App\Salesman\Exceptions;

use Ramsey\Uuid\Uuid;

class SalesmanNotFoundByIdException extends \RuntimeException
{

	/**
	 * @var \Ramsey\Uuid\Uuid
	 */
	private $salesmanId;

	public function __construct(Uuid $salesmanId, \Exception $previous = null)
	{
		parent::__construct(sprintf(
			'Salesman with id %s not found',
			$salesmanId->toString()
		), 0, $previous);
		$this->salesmanId = $salesmanId;
	}

	public function getSalesmanId(): \Ramsey\Uuid\Uuid
	{
		return $this->salesmanId;
	}

}
