<?php defined('BASEPATH') || exit('No direct script access allowed');



if (! function_exists('config_array_output')) {

    function config_array_output($array, $numTabs = 1)
    {
        if (! is_array($array)) {
            return false;
        }

        $tval = 'array(';

        // Allow for two-dimensional arrays.
        $arrayKeys = array_keys($array);

        // Check whether they are basic numeric keys.
        if (is_numeric($arrayKeys[0]) && $arrayKeys[0] == 0) {
            $tval .= "'" . implode("','", $array) . "'";
        } else {
            // Non-numeric keys.
            $tabs = "";
            for ($num = 0; $num < $numTabs; $num++) {
                $tabs .= "\t";
            }

            foreach ($array as $key => $value) {
                $tval .= "\n{$tabs}'{$key}' => ";
                if (is_array($value)) {
                    $numTabs++;
                    $tval .= config_array_output($value, $numTabs);
                } else {
                    $tval .= "'{$value}'";
                }
                $tval .= ',';
            }
            $tval .= "\n{$tabs}";
        }

        $tval .= ')';

        return $tval;
    }
}



if (! function_exists('write_config')) {

    function write_config($file = '', $settings = null, $module = '', $apppath = APPPATH)
    {
        if (empty($file) || ! is_array($settings)) {
            return false;
        }

        $configFile = "config/{$file}";

        // Look in module first.
        $found = false;


        if ($module) {
            $configFile = MODULES_DIR."{$module}/$configFile";
            $found = true;
    	}


        // Fall back to application directory.
        if (! $found) {
            $configFile = "{$apppath}{$configFile}";
            $found = is_file($configFile . '.php');
        }

        // Load the file and loop through the lines.
        if ($found) {
            $contents = file_get_contents($configFile . '.php');
            $empty = false;
        } else {
            // If the file was not found, create a new file.
            $contents = '';
            $empty = true;
        }
		
        foreach ($settings as $name => $val) {
            // Is the config setting in the file?
            $start  = strpos($contents, '$config[\'' . $name . '\']');
            $end    = strpos($contents, ';', $start);
            $search = substr($contents, $start, $end - $start + 1);

            // Format the value to be written to the file.
            if (is_array($val)) {
                // Get the array output.
                $val = config_array_output($val);
            } elseif (! is_numeric($val)) {
                $val = "\"$val\"";
            }

            // For a new file, just append the content. For an existing file, search
            // the file's contents and replace the config setting.
            //
            // @todo Don't search new files at the beginning of the loop?

            if ($empty) {
                $contents .= '$config[\'' . $name . '\'] = ' . $val . ";\n";
            } else {
                $contents = str_replace(
                    $search,
                    '$config[\'' . $name . '\'] = ' . $val . ';',
                    $contents
                );
            }
        }

        // Backup the file for safety.
        $source = $configFile . '.php';
        $dest = ($module == '' ? "{$apppath}/config/{$file}" : $configFile)
            . '.php.bak';

        if ($empty === false) {
            copy($source, $dest);
        }

        // Make sure the file still has the php opening header in it...
        if (strpos($contents, '<?php') === false) {
            $contents = "<?php defined('BASEPATH') || exit('No direct script access allowed');\n\n{$contents}";
        }

        // Write the changes out...
        if (! function_exists('write_file')) {
            get_instance()->load->helper('file');
        }
        $result = write_file("{$configFile}.php", $contents);

        return $result !== false;
    }
}
