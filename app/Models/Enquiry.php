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

	public function setClient($data, $only='')
	{
		/*TODO viber fiels have to take it away farther*/
		$address = '';
		$comment = '';
		if( $only === 'only' ){
			$address = $data['address'];
			$comment = $data['comment'];
		}
		$res = $this->db->query("INSERT INTO `clients` (`name`, `phone`, `phone2`, `address`,`comment`, `email`, `viber`, `viber_is`) 
			VALUES (
				'".$data['fio']."', 
				'".$data['phone_1']."', 
				'".$data['phone_2']."', 
				'".$address."', 
				'".$comment."', 
				'".$data['email']."', 
				'',
				'".$data['viber_is']."') ");
		return (int) $this->db->lastId();
	}

	public function checkClientByPhone($phone)
	{
		$sql = "SELECT * from  clients WHERE phone = $phone OR phone2 = $phone";
		return $this->db->row($sql);
	}

	public function setLead($last_client_id, $data)
	{
		$res = $this->db->query("INSERT INTO `leads` (`client_id`, `address`, `comment`, `source`, `date`, `status`) 
			VALUES (
				'".$last_client_id."', 
				'".$data['address']."', 
				'".$data['comment']."', 
				'".$data['source']."',
				now(),
				'".$data['status']."')");
		return (int) $this->db->lastId();
	}
}
