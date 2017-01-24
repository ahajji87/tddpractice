<?php

namespace App\Parser;


class RemoveAccentXX implements RemoveAccentInterface
{

    public function parse($string)
    {
        return $string;
    }
}