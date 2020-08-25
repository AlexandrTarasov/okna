<?php

namespace AppM;

class Order extends Model
{
	public function getOrders()
	{
		$sql ="SELECT orders.*, installers.name as inst_name, clients.name AS client_name FROM `orders` 
			LEFT JOIN  clients ON (clients.id = orders.client_id)
			LEFT JOIN  installers ON (installers.id = orders.installer_id) 
			WHERE status != 'archive'
			ORDER BY montage_date DESC";
		return $this->db->row($sql);
	}

	public function getOrdersOfOneClient($client_id, $current_order_id)
	{
		$sql ="SELECT orders.*, installers.name as inst_name, clients.name AS client_name FROM `orders` 
			LEFT JOIN  clients ON (clients.id = orders.client_id)
			LEFT JOIN  installers ON (installers.id = orders.installer_id) 
			WHERE orders.client_id = $client_id AND orders.id != $current_order_id";
		return $this->db->row($sql);
	}

	public function getOrder($id)
	{
		$sql ="SELECT orders.*, installers.name as inst_name, clients.name AS client_name FROM `orders` 
			LEFT JOIN  clients ON (clients.id = orders.client_id)
			LEFT JOIN  installers ON (installers.id = orders.installer_id) 
			WHERE orders.id = '".$id."' ";
		return $this->db->row($sql);
	}

	public function getClient($id)
	{
		$sql ="SELECT * FROM `clients` WHERE `id` = '".$id."' ";
		return $this->db->row($sql);
	}

	public function getAllOrders()
	{
		$sql = "SELECT * from `orders`";
		return $this->db->row($sql);
	}

	public function getLastOne()
	{
		$sql = "SELECT id from `orders` Order BY id DESC limit 1";
		return $this->db->row($sql)[0];
	}

	public function getOrdersBy($param)
	{
		$sql ="SELECT orders.*, installers.name as inst_name, clients.name AS client_name FROM `orders` 
			LEFT JOIN  clients ON (clients.id = orders.client_id)
			LEFT JOIN  installers ON (installers.id = orders.installer_id) 
			WHERE status = '".$param."' 
			ORDER BY montage_date DESC";
		return $this->db->row($sql);
	}

	public function getUsersByRoleID($id)
	{
		$user_model = new User();
		return $user_model->getUsersByRole($id);
	}

	public function getSuppliers()
	{
		$user_model = new Supplier();
		return $user_model->getSuppliers();
	}

	public function updateOrderMain($id, $val, $column)
	{
		// dd($val);
		if( $id==='' || $column==='' ){
			return "There is no id or column name passed in ".__FUNCTION__;
		}
		if( $val === '' ){
			$val = "NULL";
		}else{$val = "'$val'";}
		// dd($val);
		return $this->db->update("UPDATE `orders` SET `".$column."` = $val 
			WHERE id='".$id."' ");
	}

	public function setOrder($lead_id, $client_id, $address )
	{
		$last_order_id = $this->getLastOne()['id'];
		$res = $this->db->query("INSERT INTO `orders` (
		`lead_id`,
		`client_id`, 
		`contract_number`,
		`vendor_number`,
		`address`,
		`discount`,
		`square_meters`,
		`create_date`,
		`removal_request_sent`,
		`total_price`,
		`montage_price`,
		`prepaid`,
		`additional_price`,
		`measuring_price`,
		`gazda_price`,
		`balance`,
		`calculation_link`,
		`status`) 
		VALUES (
			'".$lead_id."',
			'".$client_id."', 
			'".$last_order_id."',
			'".$last_order_id."', 
			'".$address."',
			0,
			0,
			NOW(),
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			'',
			'new')");
		return (int) $this->db->lastId();

	}

	public function addPayment($order_id, $user_id, $user_type, $method,
		$amount, $type, $comment, $date_create, $status)
	{
		$res = $this->db->query("INSERT INTO `orders_payments` (
			`order_id`,
			`user_id`,
			`user_type`,
			`method`,
			`amount`,
			`type`,
			`comment`, 
			`date_create`, 
			`status`) 
		VALUES (
			'".$order_id."',
			'".$user_id."',
			'".$user_type."',
			'".$method."',
			'".$amount."',
			'".$type."',
			'".$comment."',
			'".$date_create."',
			'".$status."')");
		return (int) $this->db->lastId();
	}

	public function getOrderPayments($id)
	{
		$sql = "SELECT * from `orders_payments` WHERE `order_id` = $id Order BY id DESC";
		return $this->db->row($sql);
	}
}
