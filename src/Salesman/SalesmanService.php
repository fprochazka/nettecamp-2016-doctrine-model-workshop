<?php

declare(strict_types = 1);

namespace App\Salesman;

use Nette\Utils\Validators;

class SalesmanService
{

	public function createSalesman(string $name, string $registrationId)
	{
		Validators::assert($registrationId, 'numeric');

		return new Salesman(
			$name,
			$registrationId
		);
	}

}
