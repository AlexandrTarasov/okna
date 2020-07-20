<?php

namespace AppM;

class User extends Model
{
	public function getUsers()
	{
		// $params = [
		// 	'mail' => $mail,
		// ];
		return $this->db->row('SELECT * FROM `atom_users` 
			ORDER BY id DESC');
	}

	public function getRoles()
	{
		return $this->db->row('SELECT * FROM atom_roles');
	}

}
