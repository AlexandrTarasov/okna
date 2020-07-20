<?php

namespace AppCont;

class SettingController extends Controller
{
	public function __construct()
	{

	}

	public function indexAction()
	{
		// $settings = $this->model->getSettings();
		$resalt = [
			'title' => 'Настройки',
			// 'orders' => $settings,
		];
		$this->runView(__METHOD__)->renderWithData($resalt);
	}
}
