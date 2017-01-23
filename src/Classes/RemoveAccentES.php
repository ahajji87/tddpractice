<?php

namespace App\Classes;


class RemoveAccentES implements RemoveAccentInterface
{

    public function parse($string)
    {
        $originalChars = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $editedChars = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = utf8_decode($string);
        $string = strtr($string, utf8_decode($originalChars), $editedChars);
        $string = strtolower($string);

        return utf8_encode($string);
    }
}