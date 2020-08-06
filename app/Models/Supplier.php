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

	public function setSupplier($data)
	{
		// dd($data);
		$res = $this->db->query("INSERT INTO `suppliers` (`company_name`, `manager_name`, `manager_phone`, `manager_email`, `address`,  `comment`, `viber_is`) 
			VALUES (
				'".$data['company_name']."', 
				'".$data['manager_name']."', 
				'".$data['manager_phone']."', 
				'".$data['manager_email']."',
				'".$data['address']."',
				'".$data['comment']."',
				'".$data['viber_is']."')");
		return (int) $this->db->lastId();
	}
}
