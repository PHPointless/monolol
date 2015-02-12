<?php

namespace Monolol\Lolifiers;

class TouretteTest extends \PHPUnit_Framework_TestCase
{
    private
        $badWordsProvider;
    
    protected function setUp()
    {
        $this->badWordsProvider = new BadWordsProviders\DefaultProvider();
    }
    
    public function testHandling()
    {
        $this->assertTrue((new Tourette($this->badWordsProvider))->isHandling(array()));
    }

    /**
     * @dataProvider providerTestTourette
     */
    public function testTourette($message)
    {
        $record = array('message' => $message);

        $lolified = (new Tourette($this->badWordsProvider))->lolify($record);

        $this->assertNotSame($message, $lolified['message']);
        
        $messageArray = explode(' ', $lolified['message']);
        $badWordsFound = array_intersect($this->badWordsProvider->getBadWords(), $messageArray);
        
        $this->assertFalse(empty($badWordsFound));
    }

    public function providerTestTourette()
    {
        return array(
            array(''),
            array('Pony'),
            array('Unable to find product 1337'),
            array('Internal server error'),
        );
    }
}
