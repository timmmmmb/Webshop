<?php

class Dispatcher
{
    public static function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = strtok($uri, '?');           //Erstes ? und alles danach abschneiden
        $uri = trim($uri, '/');             //Alle / am anfang und am Ende der URI abschneiden
        $uriFragments = explode('/', $uri); //In einzelteile zerlegen
        $controllerName = 'DefaultController';
        if (!empty($uriFragments[0])) {
            $controllerName = $uriFragments[0];
            $controllerName = ucfirst($controllerName); //Erstes Zeichen grossschreiben
            $controllerName .= 'Controller';            //"Controller" anhängen
        }
        
        $method = 'index';
        if (!empty($uriFragments[1])) {
            $method = $uriFragments[1];
        }
        require_once "src/controller/$controllerName.php";

        $controller = new $controllerName();
        $controller->$method();
    }
}
