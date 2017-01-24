<?php

namespace App\Wrapper;

use PHPUnit\Framework\TestCase;

class WordWrapTest extends TestCase
{
    /**
     * @test
     */
    public function wrap_word()
    {
        $wrapper = new WrapWord();
        $this->assertEquals('la\nla\nla', $wrapper->wrap('lalala', 2));
    }

    /**
     * @test
     */
    public function wrap_words_with_spaces()
    {
        $wrapper = new WrapWord();
        $this->assertEquals('hola\nmund\no', $wrapper->wrap('hola mundo', 7));
    }
}