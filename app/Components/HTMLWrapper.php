<?php

namespace AppComp;

class HTMLWrapper
{
	public $wrapped;
	private $to_wrap;

	public function __construct(array $arr_to_wrap)
	{
		if(!empty($arr_to_wrap)) {
			$this->to_wrap = $arr_to_wrap;
		}
		// else{ throw new \Exception("array is empty"); }
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
		if( empty($this->to_wrap )){
			return $this;
		}
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

	public function makeOptionsList($selected_num = 0, array $names_of_fields) 
	{
		foreach($this->to_wrap as $opt){
			$selected = ( $selected_num == $opt[$names_of_fields[0]] ) ? ' selected ': ''; 
			$this->wrapped .= '<option '.$selected.' value="'.$opt[$names_of_fields[0]].'">'.$opt[$names_of_fields[1]].'</option>';
		}
		return $this;
	}
	public function makeThlist()
	{
		$temp_arr = [];
		foreach($this->to_wrap as $arr){
			foreach($arr as $key => $val){
				if( $key === 'type' ){
					if( $val === 'income' ){
						$temp_arr[0] = '<th>'.$this->wrapInBadge($val, 'success').'</th>';
					}
					if( $val === 'outgo' ){
						$temp_arr[0] = '<th>'.$this->wrapInBadge($val, 'danger').'</th>';
					}
				}

				if( $key === 'user_type' ){
					if( $val =='gauger' ){ $val = 'Замерщик';}
					if( $val =='client' ){ $val = 'Клиент';}
					if( $val =='installer' ){ $val = 'Установщик';}
					if( $val =='supplier' ){ $val = 'Поставщик';}
					$temp_arr[1] = '<th>'.$val.'</th>';
				}
				if( $key === 'date_create' ){
					$temp_arr[2]= '<th><input class="form-control" type="datetime" value="'.$val.'"></th>';
				}
				if( $key === 'amount' ){
					$temp_arr[3]= '<th>'.$val.'</th>';
				}
				if( $key === 'status' ){
					if( $val === 'sent' ){
						$val = 'Отправлен';
						$temp_arr[4] = '<th>'.$this->wrapInBadge($val, 'warning').'</th>';
					}
					if( $val === 'received' ){
						$val = 'Получен';
						$temp_arr[4] = '<th>'.$this->wrapInBadge($val, 'success').'</th>';
					}
					if( $val === 'canceled' ){
						$val = 'Отменён';
						$temp_arr[4] = '<th>'.$this->wrapInBadge($val, 'secondary').'</th>';
					}
				}
				if( $key === 'id' ){
					if($_SESSION['user_role'] == '3'){
						$temp_arr[5] = '<th><a href="/payment_edit/'.$val.'" class=""><i class="fas fa-edit"></i></a></th>';
					}else {
						$temp_arr[5] = '<th><a href="/payment_info/'.$val.'" class=""><i class="fas fa-info"></i></a></th>';
					}
				}
			}

			ksort($temp_arr);
			$this->wrapped .= "<tr>".implode($temp_arr)."<tr>";

		}
		return $this;
	}
	public function makeThOrdersList()
	{
		$temp_arr = [];
		foreach($this->to_wrap as $arr){
			foreach($arr as $key => $val){
				if( $key === 'id' ){
					$temp_arr[0]= '<th><a href="/order/'.$val.'" class="">'.$val.'</a></th>';
				}
				if( $key === 'contract_number' ){
					$temp_arr[1]= '<th><a href="/order/'.$val.'" class="">'.$val.'</a></th>';
				}
				if( $key === 'readiness_date' ){
					$temp_arr[2]= '<th>'.$val.'</th>';
				}
				if( $key === 'inst_name' ){
					$temp_arr[3]= '<th>'.$val.'</th>';
				}
				if( $key === 'address' ){
					$temp_arr[4]= '<th>'.$val.'</th>';
				}
				if( $key === 'status' ){
					$temp_arr[5]= '<th>'.$val.'</th>';
				}
			}
			ksort($temp_arr);
			$this->wrapped .= "<tr>".implode($temp_arr)."<tr>";
		}
		return $this;
	}
	/**
	 * can get
	 * @param  'primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'
	 * @return string
	 */
	private function wrapInBadge($val, $type)
	{
		$arr = [
			'primary'  =>'primary'  ,
			'secondary'=>'secondary',
			'success'  =>'success'  ,
			'danger'   =>'danger'   ,
			'warning'  =>'warning'  ,
			'info'	   =>'info'	 ,
			'light'	   =>'light',
			'dark' 	   =>'dark',
		];
		return '<span class="badge badge-'.$arr[$type].'">'.$val.'</span>';
	}
}
