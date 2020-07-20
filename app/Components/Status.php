<?php

namespace AppComp;

class Status 
{
	private $options;
	private $orderStatus = [
		"new"        => 'Новый',
		"processing" => 'В обработке',
		"measuring"	 => 'Замер',
		"during" 	 => 'В процессе',
		"in_work" 	 => 'В работе',
		"complete"	 => 'Готов',
		"fulfilled"  => 'Выполнен',
		"archive"    => 'Архив',
	];

	public function __construct($current_status)
	{
		foreach($this->orderStatus as $key=>$val){
			$state = '';
			if( $current_status == $key ){
				$state = 'selected';
			}
			$this->options.= '<option '.$state.' value="'.$key.'">'.$val.'</option>';
		}
	}

	public function render()
	{
		return $this->options;
	}
}
