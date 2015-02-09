<?php

namespace Monolol\Lolifiers;

use Monolog\Logger;

class HashTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider testHandlingProvider
     */
    public function testHandling($level, $expected)
    {
        $record = array('level' => $level);

        $lolifier = new Hash();

        $this->assertSame($expected, $lolifier->isHandling($record));
    }

    public function testHandlingProvider()
    {
        return array(
            'debug' => array(Logger::DEBUG, true),
            'info' => array(Logger::INFO, true),
            'notice' => array(Logger::NOTICE, true),
            'warning' => array(Logger::WARNING, true),
            'error' => array(Logger::ERROR, true),
            'critical' => array(Logger::CRITICAL, true),
            'alert' => array(Logger::ALERT, true),
            'emergency' => array(Logger::EMERGENCY, true),
        );
    }

    public function testHash()
    {
        $record = array('message' => 'my littlest pony', 'datetime' => new \DateTime());

        $lolifier = new Hash();
        $lolified = $lolifier->lolify($record);

        $this->assertNotSame($record, $lolified);
    }
}
