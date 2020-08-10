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
		return $this->db->row("SELECT id, username FROM users WHERE role_id = '".$role_id."' ");
	}
	
}
