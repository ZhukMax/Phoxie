<?php

namespace Phoxie\Modules\Backend\Controllers;

class PagesController extends ControllerBase
{
    /**
     * List of pages.
     */
    public function indexAction()
    {
        $this->response->setJsonContent(array("status" => "ok"));
        $this->response->send();
    }

    /**
     * Add new page.
     */
    public function addAction()
    {
        $this->response->setJsonContent(array("status" => "ok"));
        $this->response->send();
    }
}
