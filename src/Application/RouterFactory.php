<?php

declare(strict_types = 1);

namespace App\Application;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Utils\Json;

class RouterFactory
{

	/**
	 * @var \Nette\Http\Request
	 */
	private $httpRequest;

	public function __construct(Nette\Http\Request $httpRequest)
	{
		$this->httpRequest = $httpRequest;
	}

	public function createRouter(): Nette\Application\IRouter
	{
		$router = new RouteList;
		$router[] = new Route('v1/<presenter>/<action>', [
			NULL => [
				Route::FILTER_IN => function (array $params): array {
					// naprasáka, takhle se nepíše REST router
					$params['data'] = Json::decode(
						$this->httpRequest->getRawBody(),
						Json::FORCE_ARRAY
					);
					return $params;
				},
			]
		]);
		return $router;
	}

}
