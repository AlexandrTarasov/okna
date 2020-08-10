<?php

namespace AppM;

class Client extends Model
{
	public function getClients()
	{
		// $params = [
		// 	'mail' => $mail,
		// ];
		return $this->db->row('SELECT * FROM `clients` ORDER BY id DESC');
	}

	public function getClient($id)
	{
		return $this->db->row('SELECT * FROM `clients` WHERE id = '.$id.'');
	}

	public function getClientsOrders($id)
	{
		return $this->db->row('SELECT co.*, i.name as instal_name FROM `orders` as co
			LEFT JOIN installers as i ON (i.id = co.installer_id) WHERE co.client_id = '.$id.'');
	}

	public function getIncomeSum($order_id, $client_id)
	{
		$sum_client_payments = 0;
		$client_payments = $this->db->row('SELECT amount FROM `orders_payments` WHERE user_id = '.$client_id.'
			AND order_id = '.$order_id.' AND type = "income" ');

		if( !empty($client_payments )){
			array_walk_recursive($client_payments, 
				function($item, $key) use (&$sum_client_payments){
				$sum_client_payments += $item;
			});
		} 
		return $sum_client_payments;
	}

	public function getClientPayments($id)
	{
		return $this->db->row('SELECT * FROM `orders_payments` WHERE `user_id` = '.$id.' ORDER BY `order_id` DESC');
	}
	public function updateClientComment($id, $val)
	{
		return $this->db->update("UPDATE `clients` SET `comment` = '".$val."'
			WHERE id='".$id."' ");
	}
}
