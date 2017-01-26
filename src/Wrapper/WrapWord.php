<?php

namespace App\Wrapper;

class WrapWord
{
    public function wrap($string, $number)
    {
        if (strpos($string, ' ') !== false) {
            return wordwrap($string, $number, '\n');
        }

        return wordwrap($string, $number, '\n', true);
    }
}