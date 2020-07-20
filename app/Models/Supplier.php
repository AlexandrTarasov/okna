<?php

namespace AppM;

class Supplier extends Model
{
	public function getSuppliers()
	{
		// $params = [
		// 	'mail' => $mail,
		// ];
		return $this->db->row('SELECT * FROM `suppliers` ORDER BY id DESC');
	}

	public function getSupplier($id)
	{
		return $this->db->row('SELECT * FROM `suppliers` WHERE id = '.$id.'');
	}

	public function getSupplierOrders($id)
	{
		return $this->db->row('SELECT * FROM `orders` WHERE supplier_id = '.$id.' 
			ORDER BY id DESC ');
	}

	public function getSupplierPayment($id, $order_id)
	{
		$res = $this->db->row("SELECT * FROM `orders_payments` 
			WHERE `user_type` = 'supplier' AND type = 'outgo' 
			AND order_id = '".$order_id."' LIMIT 1");
		return ($res ? $res[0]['amount'] : 0);
	}

	public function getSupplierPayments($user_id)
	{
		return $this->db->row("SELECT * FROM `orders_payments` 
			WHERE `user_type` = 'supplier' AND user_id = '".$user_id."' ");
	}
}
