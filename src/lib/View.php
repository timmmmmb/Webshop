<?php

/**
 * Displays a site between footer and header.
 * and extracts related values to be displayed by the viewfile.
 */
class View
{
    private $viewfile;
    private $properties = array();

    /**
     * Set viewfile in constructor.
     * @param viewfile php file.
     */
    public function __construct($viewfile)
    {
        $this->viewfile = "src/view/$viewfile.php";
    }

    /**
     * Object value setter.
     */
    public function __set($key, $value)
    {
        if (!isset($this->$key)) 
        {
            $this->properties[$key] = $value;
        }
    }

    /**
     * Object value getter.
     */
    public function __get($key)
    {
        if (isset($this->properties[$key])) 
        {
            return $this->properties[$key];
        }
    }

    /**
     * Display in html.
     */
    public function display()
    {
        extract($this->properties);

        $languageFile = "lang_en.php";
        if(isset($_SESSION['lang']))
        {
            $languageFile = "lang_".$_SESSION['lang'].".php";
        }

        require "src/view/languages/".$languageFile;
        require 'src/view/header.php';
        require $this->viewfile;
        require 'src/view/footer.php';
    }
}