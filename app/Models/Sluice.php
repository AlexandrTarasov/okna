<?php

namespace AppM;

class Sluice extends Model
{
	public function setSupplierCompanyName($id, $name)
	{
		return $this->db->update("UPDATE suppliers SET `company_name` = '".$name."' 
			WHERE id = '".$id."' ");
	}
	public function setSupplierManagerName($id, $name)
	{
		return $this->db->update("UPDATE suppliers SET `manager_name` = '".$name."' 
			WHERE id = '".$id."' ");
	}

	public function setSupplierManager1Phone($id, $phone)
	{
		return $this->db->update("UPDATE suppliers SET `manager_phone` = '".$phone."' 
			WHERE id = '".$id."' ");
	}
}
