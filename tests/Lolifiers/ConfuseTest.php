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
    public function testLevelConfuse($label, $level)
    {
        $record = array(
            'level' => $level,
            'level_name' => $label,
        );
        $confusedRecord = $this->confuse->lolify($record);
        
        $this->assertNotSame($level, $confusedRecord['level']);
        $this->assertNotSame($label, $confusedRecord['level_name']);
        
        $monologLevels = MonologLevel::getLevels();
        
        $this->assertTrue(in_array($confusedRecord['level'], $monologLevels));
        $this->assertTrue(array_key_exists($confusedRecord['level_name'], $monologLevels));
        $this->assertSame($monologLevels[$confusedRecord['level_name']], $confusedRecord['level']);
    }
    
    public function testLevelConfuseProvider()
    {
        $providedTests = array();
        
        foreach(MonologLevel::getLevels() as $label => $level)
        {
            $providedTests[$label] = array($label, $level);
        }
        
        return $providedTests;
    }
}
