<?php

class InputValidation
{
    /**
     * Returns the validated int or else throws an error
     */
    public function intInputValidationPost($int)
    {
        $int = htmlspecialchars($int);
        $int = filter_var($int, FILTER_VALIDATE_INT);

        if (empty($int)) 
        {
            $this->throwError(_ERROR_VALUE_EMPTY);
        } 
        else if ($int === false) 
        {
            $this->throwError(_ERROR_NOT_INT);
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            $this->throwError(_ERROR_NOT_POST);
        }
        return $int;
    }

    /**
     * Returns the validated string or else throws an error
     */
    public function stringInputValidationPost($string)
    {
        $string = htmlspecialchars($string);
        $string = filter_var($string, FILTER_SANITIZE_STRING);

        if (empty($string)) 
        {
            $this->throwError(_ERROR_VALUE_EMPTY);
        } 
        else if ($string === false) 
        {
            $this->throwError(_ERROR_NOT_STRING);
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            $this->throwError(_ERROR_NOT_POST);
        }
        return $string;
    }

    /**
     * Creates a new exception and throws it.
     * @param string $error the error description
     * @throws Exception the new exception that gets thrown
     */
    static function throwError($error = _ERROR_DEFAULT)
    {
        throw new Exception($error);
    }

    /**
     * Returns the validated email or else throws an error
     */
    public function emailInputValidationPost($email)
    {
        $email = htmlspecialchars($email);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $this->throwError(_ERROR_NOT_EMAIL);
        }
        else if ($email === false) 
        {
            $this->throwError(_ERROR_NOT_EMAIL);
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            $this->throwError(_ERROR_NOT_POST);
        }
        return $email;
    }

    /**
     * Returns the validated password that is md5 encrypted or else throws an error
     */
    public function passwordInputValidationPost($psw)
    {
        $psw = $this->stringInputValidationPost($psw);

        if (strlen($psw) < 4)
        {
            $this->throwError(_ERROR_PSW_SHORT);
        }

        $psw = md5($psw);
        return $psw;
    }

    /**
     * Returns the validated password that is md5 encrypted or else throws an error
     */
    public function nameInputValidationPost($name)
    {
        $nameMinLength = 4;
        $nameMaxLength = 50;
        $name = $this->stringInputValidationPost($name);

        if(strlen($name) < $nameMinLength)
        {
            $this->throwError(_ERROR_NAME_SHORT);
        }
        else if(strlen($name) > $nameMaxLength)
        {
            $this->throwError(_ERROR_NAME_LONG);
        }
        return $name;
    }

    public function intInputValidationGet($int)
    {
        $int = htmlspecialchars($int);
        $int = filter_var($int, FILTER_VALIDATE_INT);

        if (empty($int)) 
        {
            $this->throwError(_ERROR_VALUE_EMPTY);
        } 
        else if ($int === false) 
        {
            $this->throwError(_ERROR_NOT_INT);
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') 
        {
            $this->throwError(_ERROR_NOT_GET);
        }
        return $int;
    }
}