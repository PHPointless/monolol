<?php

namespace Monolol\Lolifiers;

class LaMerNoireTest extends \PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $this->assertTrue((new LaMerNoire())->isHandling(array()));
    }

    /**
     * @dataProvider providerTestLaMerNoire
     */
    public function testLaMerNoire($expected, $message)
    {
        $record = array('message' => $message);

        $lolified = (new LaMerNoire())->lolify($record);

        $this->assertSame($expected, $lolified['message']);
    }

    public function providerTestLaMerNoire()
    {
        return array(
            array(LaMerNoire::LA_MER_NOIRE, ''),
            array(LaMerNoire::LA_MER_NOIRE, 'Pony'),
            array(LaMerNoire::LA_MER_NOIRE, 'Unable to find product 1337'),
            array(LaMerNoire::LA_MER_NOIRE, 'Internal server error'),
        );
    }
}
