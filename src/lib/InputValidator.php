<?php

class InputValidator
{
    /**
     * Creates a new exception and throws it.
     * @param string $error.
     * @throws Exception the new exception that gets thrown.
     */
    static function throwError($error = _ERROR_DEFAULT)
    {
        throw new Exception($error);
    }

    /**
     * Returns the validated int or else throws an error.
     * @param int $int.
     * @throws Exception if int is invalid.
     * @return int
     */
    public function validateIntPost($int)
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
     * Returns validated int.
     * @param int $int.
     * @throws Exception if int is invalid.
     * @return int
     */
    public function validateIntGet($int)
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

    /**
     * Returns the validated string or else throws an error.
     * @param string $string.
     * @throws Exception if string is invalid.
     * @return string
     */
    public function validateString($string)
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
     * Returns the validated email or else throws an error.
     * @param string $email.
     * @throws Exception if email is invalid.
     * @return string
     */
    public function validateEmail($email)
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
     * Returns the validated password that is md5 encrypted.
     * @param string $psw.
     * @param string $pswRepeat.
     * @throws Exception if psw does not match requirements.
     * @return string encrypted password.
     */
    public function validatePassword($psw, $pswRepeat)
    {
        $psw = $this->validateString($psw);
        $pswRepeat = $this->validateString($pswRepeat);

        if($psw != $pswRepeat)
        {
            $this->throwError(_ERROR_PSW_NOT_MATCH);
        }

        $pswMinLength = 8;
        $pswMaxLength = 50;

        if (strlen($psw) < $pswMinLength)
        {
            $this->throwError(_ERROR_PSW_SHORT);
        }
        if(strlen($psw) > $pswMaxLength)
        {
            $this->throwError(_ERROR_PSW_LONG);
        }

        $uppercase = preg_match('@(?=.*[A-Z])@', $psw);
        $lowercase = preg_match('@(?=.*[a-z])@', $psw);
        $number    = preg_match('@(?=.*\d)@', $psw);

        if(!$uppercase || !$lowercase || !$number)
        {
            $this->throwError(_ERROR_PSW_RGX);
        }

        $psw = md5($psw);
        return $psw;
    }

    /**
     * Returns the validated username.
     * @param string $name.
     * @throws Exception if name is invalid.
     * @return string
     */
    public function validateUsername($name)
    {
        $name = $this->validateString($name);
        $nameMinLength = 4;
        $nameMaxLength = 50;

        if (strlen($name) < $nameMinLength)
        {
            $this->throwError(_ERROR_NAME_SHORT);
        }
        if (strlen($name) > $nameMaxLength)
        {
            $this->throwError(_ERROR_NAME_LONG);
        }
        if (!preg_match("@^[a-zA-Z]+$@", $name))
        {
            $this->throwError(_ERROR_NAME_NUMBERS);
        }

        return $name;
    }
}