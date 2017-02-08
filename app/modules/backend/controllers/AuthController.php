<?php

namespace Phoxie\Modules\Backend\Controllers;

class AuthController extends ControllerBase
{
    public function indexAction()
    {}

    public function loginAction()
    {
        $this->response->setJsonContent(array("status" => "ok"));
        $this->response->send();
    }

    public function signupAction()
    {}
}
