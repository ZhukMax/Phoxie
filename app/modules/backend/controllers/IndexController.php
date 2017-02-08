<?php

namespace Phoxie\Modules\Backend\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        /**
         * Add feap-index file.
         */
        $file = BASE_PATH . '/public/assets/feap/assets.json';
        $assets = json_decode(file_get_contents($file), true);
        $this->assets->addJs($assets['index']['js']);
    }
}
