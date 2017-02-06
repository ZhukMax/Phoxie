<?php

$config  = $di->getConfig();
$router  = $di->get("router");
$backend = [
    "namespace"  => $config->backend->namespace,
    "module"     => $config->backend->name
];

/**
 * Index route for backend
 */
$router->addGet(
    $config->backend->path,
    array_merge($backend, [
        "controller" => "index",
        "action"     => "index"
    ])
)->setName($config->backend->name);

$router->addPost(
    $config->backend->path . "/:controller/:action/:params",
    array_merge($backend, [
        "controller" => 1,
        "action"     => 2
    ])
)->setName($config->backend->name . "-api");

$di->set("router", $router);
