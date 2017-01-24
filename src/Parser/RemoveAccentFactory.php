<?php

namespace App\Parser;

class RemoveAccentFactory
{
    private $remover = [
        Parser::LOCALE_ES => RemoveAccentES::class,
        Parser::LOCALE_XX => RemoveAccentXX::class
    ];

    /**
     * @param $locale
     * @return mixed
     */
    public function create($locale)
    {
        return  new $this->remover[$locale]();
    }
}