<?php

namespace AppM;

class Installer extends Model
{
	public function getInstallers()
	{
		// $params = [
		// 	'mail' => $mail,
		// ];
		return $this->db->row('SELECT * FROM `users` where role_id = 5  ORDER BY id DESC');
	}

}
