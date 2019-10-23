<?php
class InputValidation
{
    /**
     * Returns the validated int or else throws an error
     */
    public function intInputValidationPost($int, $value){
        $int = htmlspecialchars($int);
        $int = filter_var($int, FILTER_VALIDATE_INT);
        if (empty($int)) {
            $this->throwError("this value is empty: " . $value, 901);
        } else if ($int === false) {
            $this->throwError("this value is not an integer: " . $value, 902);
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->throwError("wrong request method expected POST", 903);
        }
        return $int;
    }

    /**
     * Returns the validated string or else throws an error
     */
    public function stringInputValidationPost($string, $value){
        $string = htmlspecialchars($string);
        $string = filter_var($string, FILTER_SANITIZE_STRING);
        if (empty($string)) {
            $this->throwError("this value is empty: " . $value, 904);
        } else if ($string === false) {
            $this->throwError("this value is not an String: " . $value, 905);
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->throwError("wrong request method expected POST", 906);
        }
        return $string;
    }

    /**
     * creates a new exception and throws it.
     * @param string $error the error description
     * @param int $errorCode the errorcode
     * @throws Exception the new exception that gets thrown
     */
    static function throwError($error = 'Error In Processing', $errorCode = 0){
        throw new Exception($error, $errorCode);
    }

    /**
     * Returns the validated email or else throws an error
     */
    public function emailInputValidationPost($email, $value){
        $email = htmlspecialchars($email);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (empty($email)) {
            $this->throwError("this value is empty: " . $value, 904);
        } else if ($email === false) {
            $this->throwError("this value is not an email: " . $value, 905);
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->throwError("wrong request method expected POST", 906);
        }
        return $email;
    }

    /**
     * Returns the validated password that is md5 encrypted or else throws an error
     */
    public function passwordInputValidationPost($psw, $value){
        $psw = $this->stringInputValidationPost($psw, $value);
        if(strlen($psw)<5){
            $this->throwError("this value is not long enough: ".$value." expected at least 5 but the value is only ".strlen($psw) , 907);
        }
        $psw = md5($psw);
        return $psw;
    }

    /**
     * Returns the validated password that is md5 encrypted or else throws an error
     */
    public function nameInputValidationPost($name, $value){
        $name = $this->stringInputValidationPost($name, $value);
        if(strlen($name)<4){
            $this->throwError("this value is not long enough: ".$value." expected at least 4 but the value is only ".strlen($name) , 907);
        }
        return $name;
    }

    public function intInputValidationGet($int, $value){
        $int = htmlspecialchars($int);
        $int = filter_var($int, FILTER_VALIDATE_INT);
        if (empty($int)) {
            $this->throwError("this value is empty: " . $value, 901);
        } else if ($int === false) {
            $this->throwError("this value is not an integer: " . $value, 902);
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->throwError("wrong request method expected GET", 903);
        }
        return $int;
    }
}

?>