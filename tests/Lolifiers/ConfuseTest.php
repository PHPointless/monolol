<?php

namespace Monolol\Lolifiers;

use Monolol\Referentials\MonologLevel;

class ConfuseTest extends \PHPUnit_Framework_TestCase
{
    private
        $confuse;
    
    protected function setUp()
    {
        $this->confuse = new Confuse();
    }
    
    public function testHandling()
    {
        $this->assertTrue($this->confuse->isHandling(array()));
    }
    
    /**
     * @dataProvider testLevelConfuseProvider
     */
    public function testLevelConfuse($level)
    {
        $record = array('level' => $level);
        $confusedRecord = $this->confuse->lolify($record);
        
        $this->assertNotSame($level, $confusedRecord['level']);
        $this->assertTrue(in_array($confusedRecord['level'], MonologLevel::getLevels()));
    }
    
    public function testLevelConfuseProvider()
    {
        $providedTests = array();
        
        foreach(MonologLevel::getLevels() as $label => $level)
        {
            $providedTests[$label] = array($level);
        }
        
        return $providedTests;
    }
    
    /**
     * @expectedException \RuntimeException
     */
    public function testInvalidRecord()
    {
        $record = array();
        
        $this->confuse->lolify($record);
    }
}
