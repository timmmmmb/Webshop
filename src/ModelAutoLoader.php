<?php
function my_autoloader($class_name){

	// Directories to look in
	// (relative to the current file)
	$dirs = [
		'./model/',
		'./lib/'
	];

	// Try to load class
	foreach($dirs as $dir) {
		$file = __DIR__."/$dir$class_name.php";
		if(file_exists($file)) {
			require_once($file);
			break;
		}
	}
}

spl_autoload_register('my_autoloader');
