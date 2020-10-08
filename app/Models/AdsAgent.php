<?php

namespace AppM;

class AdsAgent extends Model
{
	public function getAdsAgentEnquiries($source = '')
	{
		$sql ="select leads.*, c.name as client_name from `leads` left join clients as c on (leads.client_id = c.id)
			 order by id desc limit 130 ";
		return $this->db->row($sql);	
	}
}
