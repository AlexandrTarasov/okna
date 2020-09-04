<?php

namespace AppM;

class User extends Model
{
	public function getUsers()
	{
		// $params = [
		// 	'mail' => $mail,
		// ];
		return $this->db->row('SELECT * FROM `users` 
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
	
	public function delUser($id)
	{
		return $this->db->query("DELETE FROM `users` WHERE `users`.`id` = $id ");
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
				'".$rand_pass."',
				'0',
				'".$data['viber_is']."')");
		return [ (int) $this->db->lastId(), $rand_pass];
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
