<?php

namespace Monolol\Lolifiers;

class HangmanTest extends \PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $this->assertTrue((new Hangman())->isHandling(array()));
    }

    /**
     * @dataProvider providerTestHangman
     */
    public function testHangman($expected, $message)
    {
        $record = array('message' => $message);

        $lolified = (new Hangman())->lolify($record);

        $this->assertSame($expected, $lolified['message']);
    }

    public function providerTestHangman()
    {
        return array(
            array('',''),
            array('p___y', 'poney'),
            array('l___m i___m', 'lorem ipsum'),
            array('I______l s____r e___r!', 'Internal server error!'),
            array('Do n_t b_____e c_____e, it m___s y_u c___h','Do not breathe compote, it makes you cough'),
            array('E____y #5_9 n_t f___d', 'Entity #589 not found'),
            array('b____r-p__y-u_____n', 'burger-pony-unicorn')
        );
    }
}
