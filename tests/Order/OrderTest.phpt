<?php

declare(strict_types = 1);

namespace App\Order;

use Ramsey\Uuid\Uuid;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

class OrderTest extends TestCase
{

	public function testCreate()
	{
		$order = new Order();
		Assert::type(Uuid::class, $order->getId());
	}

}

(new OrderTest())->run();
