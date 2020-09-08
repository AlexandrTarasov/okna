<?php

namespace AppComp;

use AppCont\TakeoutsController;
use AppM\User;

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

	public function userRoleForLayout($role_id)
	{
		$user_obj = new User();
		return $user_obj->getRoleByid($role_id)[0];


	}
}
