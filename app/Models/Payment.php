<?php

namespace AppM;

class Payment extends Model
{
	public function getPayments($params = [], $payment_num = 0)
	{

		if( $payment_num !== 0 ){
			$exact_payment_sql = " WHERE op.`id` = $payment_num ";
		} elseif (!empty($params)){
			$exact_payment_sql  = " WHERE op.`status` = '$params[0]' ";
		} else{
			$exact_payment_sql  = " ORDER BY op.id DESC LIMIT 40";
		}

		return $this->db->row("SELECT op.*, o.contract_number as contract_num FROM `orders_payments` AS op
		   LEFT JOIN `orders` as o ON (op.order_id = o.id) 	$exact_payment_sql ");
	}


	public function updatePaymentMain($id, $val, $column)
	{
			// dd($val);
		if( $id==='' || $column==='' ){
			return "There is no id or column name passed in ".__FUNCTION__;
		}
		if( $val === '' ){
			$val = "NULL";
		}else{$val = "'$val'";}
		// dd($val);
		return $this->db->update("UPDATE `orders_payments` SET `".$column."` = $val 
			WHERE id='".$id."' ");
	}

	public function getENUMoptions($status)
	{
		$result = $this->db->query("SHOW COLUMNS FROM `orders_payments` LIKE '$status' ");
		$row = $result->fetch();
		$type = $row['Type'];
		preg_match('/enum\((.*)\)$/', $type, $matches);
		$vals = explode(',', $matches[1]);
		$trimmedvals = [];
		foreach($vals as $key => $value) {
			$value=trim($value, "'");
			$trimmedvals[] = $value;
		}
		return $trimmedvals;
	}
}
