<?php

declare(strict_types = 1);

namespace App\Presenters;

use App\Order\OrderFacade;
use Nette;


class HomepagePresenter extends Nette\Application\UI\Presenter
{

	/** @var OrderFacade @inject */
	public $orderFacade;


	public function actionDefault()
	{
		$this->orderFacade->createOrder();
	}

}
