<?php

namespace Monolol\Lolifiers;

use Monolog\Logger;

class NotGiveAFuckTest extends \PHPUnit_Framework_TestCase
{
    private
        $notGiveAFuck;
    
    protected function setUp()
    {
        $this->notGiveAFuck = new NotGiveAFuck();
    }
    
    public function testHandling()
    {
        $this->assertTrue($this->notGiveAFuck->isHandling(array()));
    }
    
    /**
     * @dataProvider testNotGiveAFuckProvider
     */
    public function testNotGiveAFuck(array $record, array $expected)
    {
        $lolifiedRecord = $this->notGiveAFuck->lolify($record);
        
        $this->assertSame($expected, $lolifiedRecord);
    }
    
    public function testNotGiveAFuckProvider()
    {
        return array(
            "Debug" => array(
                array('level' => Logger::DEBUG, 'message' => 'debug message'),
                array('level' => Logger::DEBUG, 'message' => 'debug message'),
            ),
            "Info" => array(
                array('level' => Logger::INFO, 'message' => 'info message'),
                array('level' => Logger::INFO, 'message' => 'info message'),
            ),
            "Notice" => array(
                array('level' => Logger::NOTICE, 'message' => 'notice message'),
                array('level' => Logger::NOTICE, 'message' => NotGiveAFuck::MESSAGE),
            ),
            "Warning" => array(
                array('level' => Logger::WARNING, 'message' => 'warning message'),
                array('level' => Logger::WARNING, 'message' => NotGiveAFuck::MESSAGE),
            ),
            "Error" => array(
                array('level' => Logger::ERROR, 'message' => 'error message'),
                array('level' => Logger::ERROR, 'message' => NotGiveAFuck::MESSAGE),
            ),
            "Alert" => array(
                array('level' => Logger::ALERT, 'message' => 'alert message'),
                array('level' => Logger::ALERT, 'message' => NotGiveAFuck::MESSAGE),
            ),
            "Critical" => array(
                array('level' => Logger::CRITICAL, 'message' => 'critical message'),
                array('level' => Logger::CRITICAL, 'message' => NotGiveAFuck::MESSAGE),
            ),
            "Emergency" => array(
                array('level' => Logger::EMERGENCY, 'message' => 'emergency message'),
                array('level' => Logger::EMERGENCY, 'message' => NotGiveAFuck::MESSAGE),
            ),
        );
    }
}
