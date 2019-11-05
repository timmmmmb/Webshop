<?php

require_once 'src/model/DefaultModel.php';

/**
 * URL name: / (Root or Home page)
 * This controller is invoked at https://servername/ by the Dispatcher.
 */
class DefaultController
{
    /**
     * This method gets called by the Dispatcher.
     */
    public function index() 
    {  
        $defaultModel = new DefaultModel();
        $view = new View('default_index');
        $view->title = _HOME;
        $view->heading = _HOME;
        $view->banner = 'banner_home.jpg';
        $view->products = $defaultModel->readAll();
        $view->display();
    }
}