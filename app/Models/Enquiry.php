<?php

namespace AppM;

class Enquiry extends Model
{
	public function getEnquiries($sort_by = '', $limit, $offset = "")
	{
		// dd($offset);
		$satatus = "";
		if( $sort_by !== '' ){
			if( $sort_by == 'no_status' ){
				$satatus = "where status = ''";
			}else{
				$satatus = "where status = '$sort_by'";
			}
		}elseif( $sort_by == 'all' ){ $satatus = ""; }

		$offset = " OFFSET ".$offset; 

		$sql ="select leads.*, c.name as client_name from `leads` left join clients as c on (leads.client_id = c.id)
			$satatus order by id desc limit $limit $offset";
		// dd($sql);
		return $this->db->row($sql);
	}

	public function getEnquiry($id)
	{
		$sql ="select leads.*, c.name as client_name from `leads` left join clients as c on (leads.client_id = c.id)
			where leads.id = $id order by leads.id desc  ";
		$res = $this->db->row($sql);
		if(!empty( $res )){
			return $this->db->row($sql)[0];
		}else {return false;}
		// return $this->db->row($sql)[0];
	}

	public function getTotalEnquiries($sort_by = '')
	{
		$satatus = "";
		if( $sort_by !== '' ){
			if( $sort_by == 'no_status' ){
				$satatus = "where status = ''";
			}else{
				$satatus = "where status = '$sort_by'";
			}
		}elseif( $sort_by == 'all' ){ $satatus = ""; }

		$sql ="SELECT COUNT(*) as a FROM `leads` $satatus ";
		return (int) $this->db->row($sql)[0]['a'];
	}

	public function getClientEnquiry($client_id)
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
		$res = $this->db->query("INSERT INTO `clients` (`name`, `phone`, `phone2`, `address`,`comment`, `email`, `viber`, `viber_is`, `who_added_user_id`) 
			VALUES (
				'".$data['fio']."', 
				'".$data['phone_1']."', 
				'".$data['phone_2']."', 
				'".$address."', 
				'".$comment."', 
				'".$data['email']."', 
				'',
				'".$data['viber_is']."',
				".intval($data['who_added_id']).") ");
			return (int) $this->db->lastId();
	}

	public function checkClientByPhone($phone)
	{
		$sql = "SELECT * from  clients WHERE phone = $phone OR phone2 = $phone";
		return $this->db->row($sql);
	}


	public function setLead($last_client_id, $data)
	{
		$res = $this->db->query("INSERT INTO `leads` (`client_id`, `address`, `comment`, `source`, `date`, `status`, `who_added_user_id`) 
			VALUES (
				'".$last_client_id."', 
				'".$data['address']."', 
				'".$data['comment']."', 
				'".$data['source']."',
				now(),
				'".$data['status']."',
				".intval($data['who_added_id']).") ");
		return (int) $this->db->lastId();
	}
	public function updateStatus($id, $status)
	{
		return $this->db->update("UPDATE `leads`  SET `status` = '".$status."' 
			WHERE `id`='".$id."' ");
	}
	public function delete($id)
	{
		return $this->db->update("DELETE FROM `leads` WHERE `id`='".$id."' ");
	}

	public function getENUMoptions($column_name)
	{
		$result = $this->db->query("SHOW COLUMNS FROM `leads` LIKE '$column_name' ");
		$row = $result->fetch();
		$type = $row['Type'];
		preg_match('/enum\((.*)\)$/', $type, $matches);
		$vals = explode(',', $matches[1]);
		$trimmedvals = [];
		foreach($vals as $key => $value) {
			$value=trim($value, "'");
			$trimmedvals[] = $value;
		}
		return $trimmedvals;
	}
	public function updateLeadMain($id, $val, $column)
	{
		if( $id==='' || $column==='' ){
			return "There is no id or column name passed in ".__FUNCTION__;
		}
		if( $val === '' ){
			$val = "NULL";
		}else{$val = "'$val'";}
		return $this->db->update("UPDATE `leads` SET `".$column."` = $val 
			WHERE id='".$id."' ");
	}
}
