<?php

namespace AppM;

class Enquiry extends Model
{
	public function getEnquiries()
	{
		$sql ="select leads.*, c.name as client_name from `leads` left join clients as c on (leads.client_id = c.id)
			where status != 'accepted' order by id desc limit 30 ";
		return $this->db->row($sql);
	}

	public function getTotalEnquiries()
	{
		$sql ="SELECT * FROM `leads` ";
		return $this->db->row($sql);
	}

	public function getEnquiry($client_id)
	{
		$sql ="SELECT * FROM `leads` WHERE client_id = $client_id";
		return $this->db->row($sql)[0];
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
	public function updateStatus($id, $status)
	{
		return $this->db->update("UPDATE `leads`  SET `status` = '".$status."' 
			WHERE `id`='".$id."' ");
	}
}
