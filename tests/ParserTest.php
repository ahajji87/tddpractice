<?php

namespace App\Tests;

use App\Classes\Parser;
use App\Classes\RemoveAccentFactory;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /** @var  Parser */
    private $parser;

    public function setUp()
    {
        parent::setUp();

        $this->parser = new Parser(new RemoveAccentFactory());
    }

    /**
     * @test
     */
    public function is_not_case_sensitive()
    {
        $list = $this->parser->parse('cocinero');

        $this->assertCount(1, $list);
        $this->assertEquals('COCINERO', $list[0]);
    }

    /**
     * @test
     */
    public function accepts_multi_words()
    {
        $this->assertEquals(
            ['COCINERO', 'FONTANERO'],
            $this->parser->parse('cocinero fontanero')
        );
    }

    /**
     * @test
     */
    public function removes_accents_from_words_for_locale_es()
    {
        $this->assertEquals(
            'COCINERO',
            $this->parser->parse('cócinero', Parser::LOCALE_ES)[0]
        );
    }

    /**
     * @test
     */
    public function removes_accents_from_words_for_locale_xx()
    {
        $this->assertEquals(
            'CÓCINERO',
            $this->parser->parse('cócinero', Parser::LOCALE_XX)[0]
        );
    }

    /**
     * @test
     */
    public function removes_plural_endings_from_words_for_locale_es()
    {
        $this->assertEquals(
            'COCINERO',
            $this->parser->parse('cocineros', Parser::LOCALE_ES)[0]
        );
    }

    /**
     * @test
     */
    public function removes_plural_endings_from_words_for_locale_xx()
    {
        $this->assertEquals(
            'COCINERO',
            $this->parser->parse('cocinerox', Parser::LOCALE_XX)[0]
        );
    }
}