<?php
/**
 *  Ph2x Router config-file
 */

$router = new Phalcon\Mvc\Router();

$router->addGet("/", array(
	'controller' => 'index',
	'action' => 'index'
));
$router->addGet("/([a-zA-Z0-9\_\-]+)", array(
	'controller' => 'index',
	'action' => 'index',
	'alias' => 1
));
$router->addPost("/([a-zA-Z0-9\_\-]+)", array(
	'controller' => 'ajax',
	'action' => 'index',
	'route' => 1
));
$router->add("/ajax/([a-zA-Z0-9\_\-]+)", array(
	'controller' => 'ajax',
	'action' => 'html',
	'route' => 1
));
/**
 *
 * For 301 redirect
*/
$router->add("/", array(
	'controller' => 'system',
	'action' => 'redirect'
))->setHostName('www.'.SITE_HOST);
$router->addGet("/([a-zA-Z0-9\_\-]+).html", array(
	'controller' => 'system',
	'action' => 'redirect',
	'alias' => 1
));
$router->addGet("/index", array(
	'controller' => 'system',
	'action' => 'redirect'
));
$router->addGet("/([a-zA-Z0-9\_\-]+)/", array(
	'controller' => 'system',
	'action' => 'redirect',
	'alias' => 1
));
/**
 *
 * For 404 error
*/
$router->notFound(
    array(
        "controller" => "system",
        "action"     => "notfound"
    )
);
/**
 *
 * Google Sitemap
*/
$router->addGet("/sitemap.xml", array(
	'controller' => 'system',
	'action' => 'sitemap'
));
/**
 *
 * Robots.txt
*/
$router->addGet("/robots.txt", array(
	'controller' => 'system',
	'action' => 'robots'
));
/**
 *
 * Admin Panel
*/
$router->addGet("/".AdminDir, array(
	'controller' => 'admin',
	'action' => 'index'
));
$router->add("/".AdminDir."/([a-zA-Z0-9\_\-]+)", array(
	'controller' => 'admin',
	'action' => 1
));
$router->add("/".AdminDir."/page/([a-zA-Z0-9]+)", array(
	'controller' => 'admin',
	'action' => 'index',
	'pageID' => 1
));