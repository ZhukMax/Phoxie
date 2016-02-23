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
		PluginsDir
    ))->register();
	
	require CORE_PATH . 'config/services.inc.php';
	require CORE_PATH . 'classes/core.class.php';
?>