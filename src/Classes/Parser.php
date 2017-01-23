<?php

namespace App\Classes;

class Parser
{
    /**
     * @param string $string
     * @return array
     */
    public function parse($string)
    {
        $result = [];

        foreach (explode(' ', $string) as $word) {
            $result[] = $this->normalize($word);
        }

        return $result;
    }

    private function normalize($string)
    {
        $noAccentsString = $this->removeAccents($string);
        $noSpecialCharsString = $this->removeSpecialChars($noAccentsString);
        $upperCaseString = strtoupper($noSpecialCharsString);

        return $this->toSingle($upperCaseString);
    }

    private function removeAccents($string)
    {
        $originalChars = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $editedChars = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = utf8_decode($string);
        $string = strtr($string, utf8_decode($originalChars), $editedChars);
        $string = strtolower($string);

        return utf8_encode($string);
    }

    private function removeSpecialChars($string)
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    /**
     * @param $word
     * @return array
     */
    private function toSingle($word)
    {
        return rtrim($word, 'S');
    }
}