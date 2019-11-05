<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once MODULES_DIR.'atom/controllers/Atom.php';

class Admin extends Atom
{
		
    function __construct()
    {
        parent::__construct();
		if(!$this->auth->check_permission('Sysinfo')) redirect('/atom');
	}

    public function index()
    {
	    $this->load->helper('inflector');

		$data['main'] = array(
            'sysinfo_version_ci'   => CI_VERSION,
            'sysinfo_version_php'  => phpversion(),
            'sysinfo_time_server'  => date('G:i Y-m-d'),
            'sysinfo_time_local'   => date('G:i Y-m-d', time()),
            'sysinfo_db_name'      => $this->db->database,
            'sysinfo_db_server'    => $this->db->platform(),
            'sysinfo_db_version'   => $this->db->version(),
            'sysinfo_db_charset'   => $this->db->char_set,
            'sysinfo_db_collation' => $this->db->dbcollat,
            'sysinfo_basepath'     => BASEPATH,
            'sysinfo_apppath'      => APPPATH,
            'sysinfo_site_url'     => site_url(),
            'sysinfo_environment'  => ENVIRONMENT,
        );
	        
        $data['php'] = $this->parse_phpinfo();
        
		
        $data['header']['title'] = 'System Information';
		$this->renderer->view('atom', 'lists/sysinfo', $data);        
    }
    
    
    
    private function parse_phpinfo() {
	    ob_start(); phpinfo(INFO_MODULES); $s = ob_get_contents(); ob_end_clean();
	    $s = strip_tags($s, '<h2><th><td>');
	    $s = preg_replace('/<th[^>]*>([^<]+)<\/th>/', '<info>\1</info>', $s);
	    $s = preg_replace('/<td[^>]*>([^<]+)<\/td>/', '<info>\1</info>', $s);
	    $t = preg_split('/(<h2[^>]*>[^<]+<\/h2>)/', $s, -1, PREG_SPLIT_DELIM_CAPTURE);
	    $r = array(); $count = count($t);
	    $p1 = '<info>([^<]+)<\/info>';
	    $p2 = '/'.$p1.'\s*'.$p1.'\s*'.$p1.'/';
	    $p3 = '/'.$p1.'\s*'.$p1.'/';
	    for ($i = 1; $i < $count; $i++) {
	        if (preg_match('/<h2[^>]*>([^<]+)<\/h2>/', $t[$i], $matchs)) {
	            $name = trim($matchs[1]);
	            $vals = explode("\n", $t[$i + 1]);
	            foreach ($vals AS $val) {
	                if (preg_match($p2, $val, $matchs)) { // 3cols
	                    $r[$name][trim($matchs[1])] = array(trim($matchs[2]), trim($matchs[3]));
	                } elseif (preg_match($p3, $val, $matchs)) { // 2cols
	                    $r[$name][trim($matchs[1])] = trim($matchs[2]);
	                }
	            }
	        }
	    }
	    return $r;
	}

    
}



/* Sysinfo module */
/* Developed by Perepelitsa Web Production */