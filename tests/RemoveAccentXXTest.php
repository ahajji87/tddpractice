<?php

namespace App\Tests;

use App\Parser\Parser;
use App\Parser\RemoveAccentXX;
use PHPUnit\Framework\TestCase;

class RemoveAccentXXTest extends TestCase
{

    /**
     * @test
     */
    public function removes_accents_from_words_for_locale_xx()
    {
        $parser = new RemoveAccentXX();

        $this->assertEquals(
            'cócinero',
            $parser->parse('cócinero', Parser::LOCALE_XX)
        );
    }
}