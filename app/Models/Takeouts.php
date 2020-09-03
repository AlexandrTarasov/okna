<?php

namespace AppM;

class Takeouts extends Model
{
	public function getTakeoutOrders()
	{
	return $this->db->row('SELECT * FROM `orders` WHERE removal_date = CURDATE()');
	}
}
