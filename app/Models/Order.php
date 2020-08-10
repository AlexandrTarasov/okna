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

	public function getOrdersBy($param)
	{
		$sql ="SELECT orders.*, installers.name as inst_name, clients.name AS client_name FROM `orders` 
			LEFT JOIN  clients ON (clients.id = orders.client_id)
			LEFT JOIN  installers ON (installers.id = orders.installer_id) 
			WHERE status = '".$param."' 
			ORDER BY montage_date DESC";
		return $this->db->row($sql);
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

}
