<?php

namespace AppM;

class Account extends Model
{
	public function getUserLoginInfo($mail)
	{
		$params = [
			'mail' => $mail,
		];
		return $this->db->row('SELECT id, password, role_id, email, username FROM `users` WHERE email = :mail LIMIT 1', $params);
	}

}
