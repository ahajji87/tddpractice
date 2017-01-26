<?php

namespace App\Wrapper;

class WrapWord
{
    /**
     * @param string $string
     * @param int $number
     * @return string
     */
    public function wrap($string, $number)
    {
        if (strpos($string, ' ') !== false) {
            return wordwrap($string, $number, '\n');
        }

        return wordwrap($string, $number, '\n', true);
    }
}