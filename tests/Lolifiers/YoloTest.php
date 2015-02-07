<?php

namespace Monolol\Lolifiers;

use Monolog\Logger;

class YoloTest extends \PHPUnit_Framework_TestCase
{
    private
        $yolo;
    
    protected function setUp()
    {
        $this->yolo = new Yolo();
    }
    
    /**
     * @dataProvider testHandlingProvider
     */
    public function testHandling($level, $expected)
    {
        $record = array('level' => $level);
        
        $this->assertSame($expected, $this->yolo->isHandling($record));
    }
    
    public function testHandlingProvider()
    {
        return array(
            'debug' => array(Logger::DEBUG, true),
            'info' => array(Logger::INFO, true),
            'notice' => array(Logger::NOTICE, false),
            'warning' => array(Logger::WARNING, false),
            'error' => array(Logger::ERROR, false),
            'critical' => array(Logger::CRITICAL, false),
            'alert' => array(Logger::ALERT, false),
            'emergency' => array(Logger::EMERGENCY, false),
        );
    }
    
    public function testLolify()
    {
        $record = array('message' => 'my littlest pony', 'datetime' => new \DateTime());
        
        $this->assertSame($record, $this->yolo->lolify($record));
    }
    
    /**
     * @expectedException \RuntimeException
     */
    public function testInvalidRecord()
    {
        $record = array();
        
        $this->yolo->isHandling($record);
    }
}
