<?php

namespace Phoxie\Modules\Backend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\View;

class ControllerBase extends Controller
{
    public $request;
    public  $response;

    public function initialize()
    {
        $this->request   = new Request();
        $this->response  = new Response();
        $this->response->setStatusCode(200, "OK");

        /**
         * Only ajax without views
         */
        $this->view->setRenderLevel(
            View::LEVEL_NO_RENDER
        );
    }
}