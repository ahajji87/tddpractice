<?php

namespace App\Classes;

use Exception;

class Encriptador
{
    public function cryptWord($word)
    {
        $this->validateWord($word);
        $wordArray = $this->getCharsArrayForWord($word);

        $newWord = $this->cryptString($wordArray);

        return $newWord;
    }

    public function cryptWordToNumbers($word)
    {
        $this->validateWord($word);

        $wordArray = $this->getCharsArrayForWord($word);
        $newWord = "";
        for ($i = 1; $i < count($wordArray) -1; $i++)
        {
            $charValue = ord($wordArray[$i]);
            $newWord = $newWord . ($charValue + 2);
        }
        return $newWord;
    }

    public function cryptSentence($word)
    {
        $wordArray = $this->getCharsArrayForWord($word);

        return $this->cryptString($wordArray);
    }

    public function cryptWordPartially($word, $charsToReplace)
    {
        $this->validateWord($word);

        $wordArray = $this->getCharsArrayForWord($word);
        $replacement = preg_split('//', $charsToReplace, -1);

        $newWord = "";
        for ($i = 1; $i < count($wordArray) -1; $i++)
        {
            for ($j = 1; $j < count($replacement) -1; $j++)
            {
                if ($replacement[$j] == $wordArray[$i]) {
                    $newWord = $this->convertChar($wordArray[$i], $newWord);
                } else {
                    $newWord = $newWord . $wordArray[$i];
                }
            }
        }
        return $newWord;
    }

    public function getWords($sentence)
    {
        return explode(" ", $sentence);
    }

    public function printWords($sentence)
    {
        $words = $this->getWords($sentence);
        for ($i = 0; $i < count($words); $i++)
        {
            echo "<" . $words[$i] . ">";
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
     * @param $wordArray
     * @return string
     */
    private function cryptString($wordArray)
    {
        $newWord = "";
        for ($i = 1; $i < count($wordArray) - 1; $i++) {
            $newWord = $this->convertChar($wordArray[$i], $newWord);
        }
        return $newWord;
    }

    /**
     * @param $wordArray
     * @param $i
     * @param $newWord
     * @return string
     */
    private function convertChar($char, $newWord)
    {
        $charValue = ord($char);

        return $newWord . chr($charValue + 2);
    }


}