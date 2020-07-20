<?php

namespace AppM;

class Installer extends Model
{
	public function getInstallers()
	{
		// $params = [
		// 	'mail' => $mail,
		// ];
		return $this->db->row('SELECT * FROM `installers` ORDER BY id DESC');
	}

}
