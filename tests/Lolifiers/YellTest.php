<?php

namespace Monolol\Lolifiers;

class YellTest extends \PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $this->assertTrue((new Yell())->isHandling(array()));
    }

    /**
     * @dataProvider providerTestYell
     */
    public function testYell($expected, $message)
    {
        $record = array('message' => $message);

        $lolified = (new Yell())->lolify($record);

        $this->assertSame($expected, $lolified['message']);
    }

    public function providerTestYell()
    {
        return array(
            array('PONEY', 'poney'),
            array('LOREM IPSUM', 'lorem ipsum'),
            array('INTERNAL SERVER ERROR', 'Internal server error'),
            array('POURQUOI TU VEUX FAIRE CA', 'POURQUOI TU VEUX FAIRE CA'),
        );
    }
}
