<?php

namespace Monolol\Lolifiers;

class TouretteTest extends \PHPUnit_Framework_TestCase
{
    private
        $swearWordsProvider;
    
    protected function setUp()
    {
        $this->swearWordsProvider = new SwearWordsProviders\DefaultProvider();
    }
    
    public function testHandling()
    {
        $this->assertTrue((new Tourette($this->swearWordsProvider))->isHandling(array()));
    }

    /**
     * @dataProvider providerTestTourette
     */
    public function testTourette($message)
    {
        $record = array('message' => $message);

        $lolified = (new Tourette($this->swearWordsProvider))->lolify($record);

        $this->assertNotSame($message, $lolified['message']);
        
        $messageArray = explode(' ', $lolified['message']);
        $swearWordsFound = array_intersect($this->swearWordsProvider->getSwearWords(), $messageArray);
        
        $this->assertFalse(empty($swearWordsFound));
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
