<?php

namespace Monolol\Lolifiers;

class GeekTimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerGeekTime
     */
    public function testGeekTime($expected, $message, $time)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $time);
        $record = array('message' => $message, 'datetime' => $dateTime);

        $lolifier = new GeekTime();

        $this->assertSame($expected, $lolifier->isHandling($record));
        $this->assertSame($message, $record['message']);
    }

    public function providerGeekTime()
    {
        return array(
            array(false, 'Internal Server Error', '1970-01-01 00:00:00'),
            array(true, 'Internal Server Error', '1970-01-01 13:37:00'),
            array(false, '', '2015-09-12 19:13:37'),
            array(true, '', '2015-09-12 13:37:00'),
            array(false, '', '2666-12-31 13:00:37'),
        );
    }
}
