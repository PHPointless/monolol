<?php

namespace Monolol\Lolifiers;

use Monolog\Logger;

class HashTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider testHandlingProvider
     */
    public function testHandling($level)
    {
        $record = array('level' => $level);

        $lolifier = new Hash();

        $this->assertTrue($lolifier->isHandling($record));
    }

    public function testHandlingProvider()
    {
        return array(
            'debug' => array(Logger::DEBUG),
            'info' => array(Logger::INFO),
            'notice' => array(Logger::NOTICE),
            'warning' => array(Logger::WARNING),
            'error' => array(Logger::ERROR),
            'critical' => array(Logger::CRITICAL),
            'alert' => array(Logger::ALERT),
            'emergency' => array(Logger::EMERGENCY),
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
