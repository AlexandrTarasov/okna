<?php

namespace AppM;

class User extends Model
{
	public function getUsers()
	{
		// $params = [
		// 	'mail' => $mail,
		// ];
		return $this->db->row('SELECT u.*, ui.str as pa_str FROM `users` AS u 
		   LEFT JOIN u_i AS ui ON (u.id = ui.id)	
			ORDER BY id DESC');
	}

	public function getRoles()
	{
		return $this->db->row('SELECT * FROM atom_roles');
	}

	public function getUsersByRole($role_id)
	{
		// dd($role_id);
		return $this->db->row("SELECT id, name, username FROM users WHERE role_id = '".$role_id."' ");
	}

	public function getRoleByid($role_id)
	{
		// dd($role_id);
		return $this->db->row("SELECT description FROM atom_roles WHERE id = '".$role_id."' ");
	}
	
	public function delUser($id)
	{
		$this->db->query("DELETE FROM `u_i` WHERE `u_i`.`id` = $id ");
		return $this->db->query("DELETE FROM `users` WHERE `users`.`id` = $id ");
	}
	public function updateUserMain($id, $val, $column)
	{
			// dd($val);
		if( $id==='' || $column==='' ){
			return "There is no id or column name passed in ".__FUNCTION__;
		}
		if( $val === '' ){
			$val = "NULL";
		}else{$val = "'$val'";}
		// dd($val);
		return $this->db->update("UPDATE `users` SET `".$column."` = $val 
			WHERE id='".$id."' ");
	}
	public function setUser($data)
	{
		$rand_pass = $this->randomPassword();
		$res = $this->db->query("INSERT INTO `users` (`username`,  `role_id`, `email`, `name`, `phone`, `comment`,`password`, `login_errors`, `viber_is`) 
			VALUES (
				'".$data['username']."', 
				'1',
				'".$data['email']."', 
				'".$data['name']."', 
				'".$data['phone']."',
				'".$data['comment']."',
				'".password_hash($rand_pass, PASSWORD_DEFAULT)."',
				'0',
				'".$data['viber_is']."')");
		return [ (int) $this->db->lastId(), $rand_pass];
	}

	public function set_u_i($id_pass_arr)
	{
		/*TODO make 2 chars shift*/
		$this->db->query("INSERT INTO `u_i` (`id`,  `str`) VALUES ('".$id_pass_arr[0]."', '".$id_pass_arr[1]."') ");

	}

	private function randomPassword(): string
	{
		$alphabet = '_-)!\@#$%^&*abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = [];
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);
	}
}
