<?php
/**
 *  Phoxie Services config-file
 */

    // Dependency Injection
    $di = new Phalcon\DI\FactoryDefault();

	// Add router
	$di->set('router', function()
	{
		require CORE_PATH . 'config/routes.inc.php';
		return $router;
	});
	
	// MySQL setups
	$connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
		"host" => DB_HOST,
		"username" => DB_USER,
		"password" => DB_PASS,
		"dbname" => DB_NAME,
		"options" => array(
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
		)
	));
    $di->set('db', function() use ($connection)
	{
		return $connection;
    });

    // View setups
    $di->set('view', function()
	{
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir(ViewsDir);
        return $view;
    });

	// Session create
	
?>