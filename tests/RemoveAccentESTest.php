<?php

namespace App\Tests;

use App\Parser\Parser;
use App\Parser\RemoveAccentES;
use PHPUnit\Framework\TestCase;

class RemoveAccentESTest extends TestCase
{
    /**
     * @test
     */
    public function removes_accents_from_words_for_locale_es()
    {
        $parser = new RemoveAccentES();

        $this->assertEquals(
            'cocinero',
            $parser->parse('cócinero', Parser::LOCALE_ES)
        );
    }
}