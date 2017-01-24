<?php

namespace App\Tests\Validator;

use App\Validator\PasswordValidator;
use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function password_is_correct()
    {
        $validator = new PasswordValidator();
        $this->assertTrue($validator->isValid('AaBb_77'));
    }

    /**
     * @test
     */
    public function password_contains_at_least_an_underscore()
    {
        $validator = new PasswordValidator();
        $this->assertFalse($validator->isValid('AaBb77'));
    }

    /**
     * @test
     */
    public function password_contains_at_least_a_number()
    {
        $validator = new PasswordValidator();
        $this->assertFalse($validator->isValid('AaBb_Cc'));
    }

    /**
     * @test
     */
    public function password_contains_at_least_a_lowercase()
    {
        $validator = new PasswordValidator();
        $this->assertFalse($validator->isValid('AABB_77'));
    }

    /**
     * @test
     */
    public function password_contains_at_least_a_uppercase()
    {
        $validator = new PasswordValidator();
        $this->assertFalse($validator->isValid('aabb_77'));
    }

    /**
     * @test
     */
    public function password_is_long_enough()
    {
        $validator = new PasswordValidator();
        $this->assertFalse($validator->isValid('Aa_7'));
    }
}