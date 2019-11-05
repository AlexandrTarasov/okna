<?php
	
	$string = "<?php 	

	\$menu['main'][] = array('type' => 'item', 'link' => MODULES_URL.'$module_name_right', 'title' => '$module_name', 'active' => (\$this->uri->segment(3) == '$module_name_right'), 'icon' => '');

?>
";

echo $string;

?>