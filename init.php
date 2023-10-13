<?php
function load_model($class_name)
{
	$path_to_file = 'lib/Models/' . $class_name . '.php';

	if (file_exists($path_to_file)) {
		require $path_to_file;
	}
}

spl_autoload_register('load_model');
?>