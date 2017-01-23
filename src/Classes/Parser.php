<?php

namespace App\Classes;

class Parser
{
    const LOCALE_ES = 'es';
    const LOCALE_XX = 'xx';
    
    const PLURAL_ENDING = [
        self::LOCALE_ES => 'S',
        self::LOCALE_XX => 'X'
    ];

    /**
     * @param string $string
     * @param string $locale
     * @return array
     */
    public function parse($string, $locale = self::LOCALE_ES)
    {
        $result = [];

        foreach (explode(' ', $string) as $word) {
            $result[] = $this->normalize($word, $locale);
        }

        return $result;
    }

    /**
     * @param string $string
     * @param string $locale
     * @return array
     */
    private function normalize($string, $locale)
    {
        $noAccentsString = $this->removeAccents($string, $locale);
        $upperCaseString = mb_strtoupper($noAccentsString);

        return $this->toSingle($upperCaseString, $locale);
    }

    /**
     * @param string $string
     * @param string $locale
     * @return string
     */
    private function removeAccents($string, $locale)
    {
        if ($locale !== self::LOCALE_ES) {
            return $string;
        }

        $originalChars = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $editedChars = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = utf8_decode($string);
        $string = strtr($string, utf8_decode($originalChars), $editedChars);
        $string = strtolower($string);

        return utf8_encode($string);
    }

    /**
     * @param string $word
     * @return array
     */
    private function toSingle($word, $locale)
    {
        return rtrim($word, self::PLURAL_ENDING[$locale]);
    }
}