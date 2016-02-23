<?php
/**
 *  Ph2x Configuration file
 */
 
// Global Paths
define('CORE_PATH', BASE_PATH . 'core/');
define('ControllersDir', CORE_PATH . 'controllers/');
define('ModelsDir', CORE_PATH . 'models/');
define('ViewsDir', CORE_PATH . 'view/');
define('PluginsDir', CORE_PATH . 'classes/');
define('AdminDir', 'admin');

// Data Base
define('DB_HOST', 'localhost');
define('DB_USER', 'phox');
define('DB_PASS', '4q915jmwX0Yk');
define('DB_NAME', 'phox');
define('DB_PREFIX', 'ph_');

define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('SITE_HOST', $_SERVER['HTTP_HOST']);
define('SITE_NAME', 'Phoxie');

?>