<?php

namespace Monolol\Lolifiers;

class NyanCatTest extends \PHPUnit_Framework_TestCase
{
    private
        $nyanCat;

    protected function setUp()
    {
        $this->nyanCat = new NyanCat();
    }

    public function testIsHandling()
    {
        $this->assertTrue($this->nyanCat->isHandling(array()));
    }

    /**
     * @dataProvider nyanCatLolifyProvider
     */
    public function testLolify($expected, $message)
    {
        $record = array('message' => $message);

        $lolified = $this->nyanCat->lolify($record);

        $this->assertSame($expected, $lolified['message']);
    }

    public function nyanCatLolifyProvider()
    {
        return array(
            array('', ''),
            array('   ', '   '),
            array('nya nya nya nya', 'I am a cat'),
            array('nya nya\'nya nya nya, nya nya, nya.', 'I don\'t care about, you know, punctuation.'),
            array('nya nya nya nya', 'Àccéènts arê mÿ frùends'),
            array('nya-nya ` nya +nya nya| nya !!! :(', 'I-hate ` all +those weird| symbols !!! :('),
        );
    }
}
