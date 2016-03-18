<?php
/**
 *  Ph2x Loader file
 */

	/*
	* Autoloader register
	*/
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        ControllersDir,
        ModelsDir,
		ClassesDir
    ))->register();
	
	$loader->registerNamespaces(
		array(
		   "Phoxie\Classes"      => ClassesDir
		)
	);
	
	require CORE_PATH . 'config/services.inc.php';
?>