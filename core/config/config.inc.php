<?php
/**
 *  Ph2x Configuration file
 */
 
// Global Paths
define('CORE_PATH', BASE_PATH . 'core/');
define('ControllersDir', CORE_PATH . 'controllers/');
define('ModelsDir', CORE_PATH . 'models/');
define('ViewsDir', CORE_PATH . 'view/');
define('ClassesDir', CORE_PATH . 'classes/');
define('AdminDir', 'admin');

// Data Base
define('DB_HOST', 'localhost');
define('DB_USER', 'phoxie');
define('DB_PASS', 'Yx2-ih3CkVl7');
define('DB_NAME', 'phoxie');
define('DB_PREFIX', 'ph_');

define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/');
define('SITE_HOST', $_SERVER['HTTP_HOST']);
define('SITE_NAME', 'Phoxie');

?>