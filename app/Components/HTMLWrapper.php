<?php

namespace AppComp;

class HTMLWrapper
{
	public $wrapped;
	private $to_wrap;

	public function __construct($arr_to_wrap)
	{
		if(is_array($arr_to_wrap)) {
			$this->to_wrap = $arr_to_wrap;
		}
		return $this;
	}

	public function wrapCatDescr()
	{
		if( !empty ($this->to_wrap['categories_description']) ){
			$this->wrapped = '<div class="row">
				<div class="card">
					<div class="card-body">
						<h2>Описание</h2>
						'.$this->to_wrap['categories_description'].'
					</div>
				</div>
			</div>';
		}else{
			$this->wrapped = '';
		}
		return $this;
	}

	public function wrapSubMenu()
	{
		$this->wrapped = '<ul class="menu_ul">';
		foreach($this->to_wrap as $val){
			if( $val['sub_cats'] > 0 ){
				$this->wrapped .= '<li class="sub sub-cats">'.$val['categories_name'].'<i class="fa fa-level-down" aria-hidden="true"></i></li>';
			}else{
				$this->wrapped .= '<li class="sub bottom-item"><a href="'.$val['categories_id'].'" class="">'.$val['categories_name'].'</a></li>';
			}
			
		};

		$this->wrapped .= '</ul>';
		return $this;
	}

	public function showElem()
	{
		echo $this->wrapped;
	}


	public function receiveElem()
	{
		return $this->wrapped;
	}

	public function wrapSupplierPaymentsTable()
	{
		foreach($this->to_wrap as $payment){
			$status = '';
			$type   = '';
			$method = '';
			$date_create = date_create($payment['date_create']);
			$date_receiving = '-';
			if( $payment['date_receiving'] !== '0000-00-00 00:00:00' ){
				$date_receiving = date_format(date_create($payment['date_receiving']),"d.m.Y");
			}

			if( $payment['status'] == 'received' ){
				$status = '<span class="badge badge-success">Получен</span>';
			}elseif($payment['status'] == 'sent'){
				$status = '<span class="badge badge-secondary">Отправленно</span>';
			}elseif($payment['status'] == 'canceled'){
				$status = '<span class="badge badge-dark">Отменён</span>';
			}


			if( $payment['type'] == 'outgo' ){
				$type = '<span class="badge badge-warning">Расход</span>';
			}elseif($payment['type'] == 'income'){
				$type = '<span class="badge badge-success">Приход</span>';
			}

			if( $payment['method']      == 'courier' ){
				$method = 'Курьером';
			}elseif( $payment['method'] == 'cash' ){
				$method = 'Нал.';
			}elseif( $payment['method'] == 'cashless' ){
				$method = 'Безнал';
			}elseif( $payment['method'] == 'card' ){
				$method = 'Карта';
			}elseif( $payment['method'] == 'installer' ){
				$method = 'Монтажник';
			}




			
			$this->wrapped .="<tr>";
			$this->wrapped .="	<td><a href=/order/".$payment['order_id'].">".$payment['order_id']."</a></td>";
			$this->wrapped .="	<td>".$type."</td>";
			$this->wrapped .="	<td>".date_format($date_create,"d.m.Y")."</td>";
			$this->wrapped .="	<td>".$date_receiving."</td>";
			$this->wrapped .="	<td>".$method."</td>";
			$this->wrapped .="	<td>".$payment['amount']."</td>";
			$this->wrapped .="	<td>".$status."</td>";
			$this->wrapped .="</tr>";
		}
		return $this;
	}
}
