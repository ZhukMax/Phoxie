<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Phoxie\Models' => APP_PATH . '/common/models/',
    'Phoxie'        => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Phoxie\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'Phoxie\Modules\Backend\Module'  => APP_PATH . '/modules/backend/Module.php',
    'Phoxie\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
