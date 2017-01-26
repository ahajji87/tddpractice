<?php

namespace App\Encriptor;

use Exception;

class Encriptador
{
    /**
     * @param string $word
     * @return string
     */
    public function cryptWord($word)
    {
        $this->validateWord($word);
        $wordArray = $this->getCharsArrayForWord($word);

        return $this->crypt($this->getCharCrypter(), $wordArray);
    }

    /**
     * @param string $word
     * @return string
     */
    public function cryptWordToNumbers($word)
    {
        $this->validateWord($word);
        $wordArray = $this->getCharsArrayForWord($word);
        $function = function($response, $charValue) {
            return $response . ($charValue + 2);
        };

        return $this->crypt($function, $wordArray);
    }

    /**
     * @param string $word
     * @return string
     */
    public function cryptSentence($word)
    {
        $wordArray = $this->getCharsArrayForWord($word);

        return $this->crypt($this->getCharCrypter(), $wordArray);
    }

    /**
     * @param string $word
     * @param string $charsToReplace
     * @return string
     */
    public function cryptWordPartially($word, $charsToReplace)
    {
        $this->validateWord($word);

        $wordArray = $this->getCharsArrayForWord($word);
        $replacement = $this->getCharsArrayForWord($charsToReplace);

        $newWord = "";

        for ($i = 1; $i < count($wordArray) -1; $i++) {
            for ($j = 1; $j < count($replacement) -1; $j++) {
                $newWord = $newWord . $this->encryptPartialy($replacement[$j], $wordArray[$i]);
            }
        }

        return $newWord;
    }

    /**
     * @param string $sentence
     * @return array
     */
    public function getWords($sentence)
    {
        return explode(" ", $sentence);
    }

    /**
     * @param string $sentence
     */
    public function printWords($sentence)
    {
        $words = $this->getWords($sentence);
        foreach ($words as $word) {
            echo "<" . $word . ">";
        }
    }

    /**
     * @param string $word
     * @throws Exception
     */
    private function validateWord($word)
    {
        if (substr_count($word, " ") > 0) {
            throw new Exception("Invalid word");
        }
    }

    /**
     * @param string $word
     * @return array
     */
    private function getCharsArrayForWord($word)
    {
        return preg_split('//', $word, -1);
    }

    /**
     * @param $function
     * @param $wordArray
     * @return string
     */
    private function crypt($function, $wordArray)
    {
        $newWord = "";
        for ($i = 1; $i < count($wordArray) - 1; $i++) {
            $charValue = ord($wordArray[$i]);
            $newWord = $function($newWord, $charValue);
        }

        return $newWord;
    }

    /**
     * @return \Closure
     */
    private function getCharCrypter()
    {
        return function ($response, $charValue) {
            return $response . chr($charValue + 2);
        };
    }

    /**
     * @param string $replacement
     * @param string $word
     * @return string
     */
    private function encryptPartialy($replacement, $word)
    {
        if ($replacement == $word) {
            $charValue = ord($word);
            $word = chr($charValue + 2);
        }

        return $word;
    }
}