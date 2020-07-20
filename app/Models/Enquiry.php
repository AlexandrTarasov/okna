<?php

namespace AppM;

class Enquiry extends Model
{
	public function getEnquiries()
	{
		$sql ="SELECT leads.*, c.name as client_name FROM `leads` LEFT JOIN clients as c ON (leads.client_id = c.id)
			WHERE status != 'accepted' ORDER BY id DESC";
		return $this->db->row($sql);
	}

	public function getTotalEnquiries()
	{
		$sql ="SELECT * FROM `leads` ";
		return $this->db->row($sql);
	}
}
