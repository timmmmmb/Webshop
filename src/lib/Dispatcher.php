<?php

/**
 * Dispatcher handles URL calls.
 */
class Dispatcher
{
    /**
     * Dispatch method scans URL: https://servername/controller/method
     * 1. URL fragment (/controller) => instantiates corresponding Controller.
     * 2. URL fragment (/method) => calls corresponding method.
     */
    public static function dispatch()
    {
        //Analyze URL
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');           //Remove URL values after '?'
        $uri = trim($uri, '/');             //Remove both '/' from left and right 
        $uriFragments = explode('/', $uri); //Split URL into array
        $offset = 0;
        $lang = require 'src/view/languages/lang_config.php';

        //Define language
        $_SESSION['lang'] = $lang['en'];
        if(array_key_exists($uriFragments[$offset], $lang)) 
        {
            $_SESSION['lang'] = $lang[$uriFragments[$offset]];
            $offset++;
        }
        require "src/view/languages/".$_SESSION['lang']['file'];
        
        //Define controller
        $controllerName = 'DefaultController';
        if (!empty($uriFragments[$offset])) 
        {
            $controllerName = $uriFragments[$offset];
            $controllerName = ucfirst($controllerName); //Capitalize first letter
            $controllerName .= 'Controller';            //Add "Controller"
        }
        
        //Define controller method
        $method = 'index';
        if (!empty($uriFragments[$offset + 1])) 
        {
            $method = $uriFragments[$offset + 1];
        }
        require_once "src/controller/$controllerName.php";

        //Execute
        $controller = new $controllerName();
        $controller->$method();
    }

    /**
     * Returns url with language fragment.
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
        
        return '/'.$lang;
    }
}