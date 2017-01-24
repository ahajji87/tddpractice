<?php

namespace App\Wrapper;

class WrapWord
{
    public function wrap($string, $number)
    {
        if (strlen($string) < $number) {
            return $string;
        }

        $wrapped = substr($string, 0, $number);

        $remain = substr($string, $number);

        $result = $wrapped . '\n';

        if (strlen($remain) <= $number) {
            $result += $remain;
        } else {
            $result += substr($remain, 0, $number) . '\n'
                . substr($remain, 0, $number);
        }

        return $result;
    }

    private function wrapWord($string, $number)
    {
        $split = str_split($string, $number);

        return implode('\n', $split);
    }

    private function wrapSintense($string, $number)
    {

    }
}