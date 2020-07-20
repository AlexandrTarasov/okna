<?php
namespace AppM;

use AppComp\DB as DB;

class Model {
	public $db;
	
	public function __construct() {
		$this->db = new Db;
	}
}
