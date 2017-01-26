<?php

namespace App\Parser;

interface RemoveAccentInterface
{
    /**
     * @param string $string
     * @return array
     */
    public function parse($string);
}