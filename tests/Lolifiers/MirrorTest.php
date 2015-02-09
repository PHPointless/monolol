<?php

namespace Monolol\Lolifiers;

class MirrorTest extends \PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $this->assertTrue((new Mirror())->isHandling(array()));
    }

    /**
     * @dataProvider providerTestMirror
     */
    public function testMirror($expected, $message)
    {
        $record = array('message' => $message, 'datetime' => new \DateTime());

        $lolified = (new Mirror())->lolify($record);

        $this->assertSame($expected, $lolified['message']);
    }

    public function providerTestMirror()
    {
        return array(
            array('ynop', 'pony'),
            array('muspi merol', 'lorem ipsum'),
            array('rorre revres lanretnI', 'Internal server error'),
        );
    }
}
