<?php

declare(strict_types = 1);

namespace App\Api;

use App\Salesman\Salesman;

class SalesmanResponseFactory
{

	public function createSalesmanResponse(Salesman $salesman): array
	{
		return [
			'id' => $salesman->getId(),
			'name' => $salesman->getName(),
			'registrationId' => $salesman->getRegistrationId(),
		];
	}

}
