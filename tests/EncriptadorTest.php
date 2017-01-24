<?php
namespace App\Tests;

class EncriptadorTest extends \PHPUnit\Framework\TestCase
{
    /** @var  \App\Encriptor\Encriptador */
    private $encriptor;

    public function setUp()
    {
        parent::setUp();

        $this->encriptor = new \App\Encriptor\Encriptador();
    }

    /**
     * @expectedException Exception
     */
    public function testEncriptadorMethodCryptWordShouldThrowExceptionWhenFoundSpace()
    {
        $word = "hola mundo";

        $this->encriptor->cryptWord($word);
    }

    public function testEncriptadorMethodCryptWordShouldCryptGivenWord()
    {
        $word = 'holamundo';

        $this->assertEquals('jqncowpfq', $this->encriptor->cryptWord($word));
    }

    /**
     * @expectedException Exception
     */
    public function testEncriptadorMethodCryptWordToNumbersShouldThrowExceptionWhenFoundSpace()
    {
        $word = "hola mundo";

        $this->encriptor->cryptWordToNumbers($word);
    }

    public function testEncriptadorMethodCryptWordToNumbersShouldCryptGivenWord()
    {
        $word = 'holamundo';

        $this->assertEquals('10611311099111119112102113', $this->encriptor->cryptWordToNumbers($word));
    }

    public function testEncriptadorMethodCryptSentenceShouldCryptGivenSentence()
    {
        $word = 'soy una frase';

        $this->assertEquals('uq{"wpc"htcug', $this->encriptor->cryptSentence($word));
    }

    /**
     * @expectedException Exception
     */
    public function testEncriptadorMethodCryptWordPartiallyShouldThrowExceptionWhenFoundSpace()
    {
        $word = "hola mundo";

        $this->encriptor->cryptWordPartially($word, 'a');
    }

    public function testEncriptadorMethodCryptWordPartiallyShouldReturnNullWhenCharsToReplaceIsNull()
    {
        $word = "holamundo";

        $this->assertEquals('', $this->encriptor->cryptWordPartially($word, ''));
    }

    public function testEncriptadorMethodCryptWordPartiallyShouldNotCryptWhenCharsToReplaceIsNotMatched()
    {
        $word = "holamundo";

        $this->assertEquals('holamundo', $this->encriptor->cryptWordPartially($word, 'x'));
    }

    public function testEncriptadorMethodCryptWordPartiallyShouldCryptWhenCharsToReplaceIsMatch()
    {
        $word = "holamundo";

        $this->assertEquals('jolamundo', $this->encriptor->cryptWordPartially($word, 'h'));
    }

    public function testEncriptadorMethodGetWordsShouldReturnArrayOfWordsFromGivenSentence()
    {
        $sentence = "hola mundo mundial";

        $array = ["hola", "mundo", "mundial"];

        $this->assertEquals($array, $this->encriptor->getWords($sentence));
    }

    public function testEncriptadorMethodPrintWordsShouldPrintWordsFromGivenSentence()
    {
        $sentence = "hola mundo mundial";

        $output = '<hola><mundo><mundial>';

        $this->encriptor->printWords($sentence);
        $this->expectOutputString($output);
    }


}