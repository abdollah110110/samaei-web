<?php
require_once __DIR__ . '/config.php';

spl_autoload_register(function($className){
	$file = __DIR__ . '/includes/class.' . strtolower($className) . '.php';
	if(file_exists($file)){
		require_once $file;
	}
	else{
		exit('Not found the class: ' . $className);
	}
});

