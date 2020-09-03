<?php

namespace AppComp;

use AppCont\TakeoutsController;

class Layout
{
	public $takeouts_num  = '';

	public function takeoutsBadgeForLayout($data, $layout_type)
	{
		$takeouts_obj = new TakeoutsController();
		$takeouts_num = $takeouts_obj->getTakoutsNumber();
		if(0 < $takeouts_num ){
			return '<span class="badge badge-danger" style="margin-left: 23px;">'.$takeouts_num.'</span>';
		}
		return '';
	}
}
