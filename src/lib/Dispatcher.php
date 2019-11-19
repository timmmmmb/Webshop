<?php

/**
 * Dispatcher handles URL calls.
 */
class Dispatcher
{
    /**
     * Define root folder.
     */
    function __construct()
    {
        $conf = require 'config.php';
        define("_ROOT", $conf['root']);
    }

    /**
     * Dispatch method scans URL: https://servername/controller/method
     * First URL fragment (/controller) => instantiates corresponding Controller.
     * Second URL fragment (/method) => calls corresponding method.
     */
    public function dispatch()
    {
        //Analyze URL
        //-----------
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');           //Remove URL values after '?'
        $uri = substr($uri, strlen(_ROOT)); //Remove root folder
        $uri = trim($uri, '/');             //Remove both '/' from left and right 
        $uriFragments = explode('/', $uri); //Split URL into array
        $offset = 0;
        $lang = require 'src/view/languages/lang_config.php';
        

        //Define language
        //---------------
        $_SESSION['lang'] = $lang['en'];
        if(array_key_exists($uriFragments[$offset], $lang)) 
        {
            $_SESSION['lang'] = $lang[$uriFragments[$offset]];
            $offset++;
        }
        require "src/view/languages/".$_SESSION['lang']['file'];
        
        //Define controller
        //-----------------
        $controllerName = 'DefaultController';
        if (!empty($uriFragments[$offset])) 
        {
            $controllerName = $uriFragments[$offset];
            $controllerName = ucfirst($controllerName); //Capitalize first letter
            $controllerName .= 'Controller';            //Add "Controller"
        }
        
        //Define controller method
        //------------------------
        $method = 'index';
        if (!empty($uriFragments[$offset + 1])) 
        {
            $method = $uriFragments[$offset + 1];
        }

        //Exception handling
        //------------------
        $controllerClass = "src/controller/$controllerName.php";
        if (!file_exists($controllerClass)) 
        {
            Dispatcher::redirect();
        }
        require_once $controllerClass;
        if (!method_exists($controllerName, $method))
        {
            Dispatcher::redirect();
        }
        
        //Execute
        //-------
        $controller = new $controllerName();
        $controller->$method();
    }

    /**
     * Returns url with language fragment.
     * @param string $lang
     * @return string
     */
    public static function getURL($lang) 
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/'); 
        $uriFragments = explode('/', $uri);

        $languages = require 'src/view/languages/lang_config.php';
        if(array_key_exists($uriFragments[0], $languages)) 
        {
            $uriFragments = array_slice($uriFragments, 1);
        }
        
        foreach($uriFragments as $uriFragment)
        {
            $lang .= '/'.$uriFragment;
        }
        
        return _ROOT.$lang;
    }

    /**
     * Redirect to main page.
     */
    private static function redirect() 
    {
        header("Location: /".$_SESSION['lang']['name']);
        die();
    }    
}