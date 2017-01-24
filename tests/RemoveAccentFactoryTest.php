<?php

namespace App\Tests;

use App\Parser\Parser;
use App\Parser\RemoveAccentES;
use App\Parser\RemoveAccentFactory;
use App\Parser\RemoveAccentXX;
use PHPUnit\Framework\TestCase;

class RemoveAccentFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function creates_instance_for_locale_es()
    {
        $factory = new RemoveAccentFactory();

        $this->assertInstanceOf(RemoveAccentES::class, $factory->create(Parser::LOCALE_ES));
    }

    /**
     * @test
     */
    public function creates_instance_for_locale_xx()
    {
        $factory = new RemoveAccentFactory();

        $this->assertInstanceOf(RemoveAccentXX::class, $factory->create(Parser::LOCALE_XX));
    }
}