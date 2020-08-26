<?php

namespace AppM;

class User extends Model
{
	public function getUsers()
	{
		// $params = [
		// 	'mail' => $mail,
		// ];
		return $this->db->row('SELECT * FROM `users` 
			ORDER BY id DESC');
	}

	public function getRoles()
	{
		return $this->db->row('SELECT * FROM atom_roles');
	}

	public function getUsersByRole($role_id)
	{
		// dd($role_id);
		return $this->db->row("SELECT id, name, username FROM users WHERE role_id = '".$role_id."' ");
	}
	
	public function delUser($id)
	{
		return $this->db->query("DELETE FROM `users` WHERE `users`.`id` = $id ");
	}
	public function setUser()
	{
		//
	}
}
