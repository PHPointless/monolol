<?php

namespace Monolol\Lolifiers;

class WarpTest extends \PHPUnit_Framework_TestCase
{
    private
        $warp;
    
    protected function setUp()
    {
        $this->warp = new Warp();
    }
    
    public function testHandling()
    {
        $this->assertTrue($this->warp->isHandling(array()));
    }
    
    public function testWarpTravel()
    {
        $dateTime = new \DateTime();
        $record = array('datetime' => clone $dateTime);
        $lolifiedRecord = $this->warp->lolify($record);
        
        $this->assertInstanceOf('DateTime', $lolifiedRecord['datetime']);
        $this->assertGreaterThan($dateTime->getTimeStamp(), $lolifiedRecord['datetime']->getTimeStamp());
    }
    
    /**
     * @expectedException \RuntimeException
     */
    public function testInvalidRecord()
    {
        $record = array();
        
        $this->warp->lolify($record);
    }
}
