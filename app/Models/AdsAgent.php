<?php

namespace AppM;

class AdsAgent extends Model
{
	public function getAdsAgentEnquiries()
	{
		$sql ="select leads.*, c.name as client_name from `leads` left join clients as c on (leads.client_id = c.id)
			where source = 'dear-agent' order by id desc limit 30 ";
		return $this->db->row($sql);	
	}
}
