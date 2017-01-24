<?php

namespace App\Wrapper;

class WrapWord
{
    public function wrap($string, $number)
    {
        if (strpos($string, ' ') !== false) {
            $result = wordwrap($string, $number, '\n');
        } else {
            $result = wordwrap($string, $number, '\n', true);
        }

        return $result;
    }
}