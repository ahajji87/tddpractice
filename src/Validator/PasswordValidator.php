<?php

namespace App\Validator;


class PasswordValidator
{
    const MIN_LENGTH = 6;

    public function isValid($password)
    {
        return $this->hasUnderscore($password)
            && $this->hasNumber($password)
            && $this->hasLowerCase($password)
            && $this->hasUpperCase($password)
            && $this->isLongEnough($password);
    }

    /**
     * @param $password
     * @return bool
     */
    private function hasUnderscore($password)
    {
        return strpos($password, '_') !== false;
    }

    /**
     * @param $password
     * @return int
     */
    private function hasNumber($password)
    {
        $pattern = '~[0-9]~';

        return $this->containsPattern($password, $pattern);
    }

    /**
     * @param $password
     * @return int
     */
    private function hasLowerCase($password)
    {
        $pattern = '~[a-z]~';

        return $this->containsPattern($password, $pattern);
    }

    /**
     * @param $password
     * @return int
     */
    private function hasUpperCase($password)
    {
        $pattern = '~[A-Z]~';

        return $this->containsPattern($password, $pattern);
    }

    private function isLongEnough($password)
    {
        return strlen($password) >= self::MIN_LENGTH;
    }

    /**
     * @param $password
     * @param $pattern
     * @return int
     */
    private function containsPattern($password, $pattern)
    {
        return preg_match($pattern, $password);
    }

}