<?php

namespace Monolol\Lolifiers;

use Monolol\Referentials\MonologLevel;

class ShuffleTest extends \PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $shuffle = new Shuffle();
        
        $this->assertTrue($shuffle->isHandling(array()));
    }
    
    /**
     * @dataProvider providerTestMessageShuffle
     */
    public function testMessageShuffle($message)
    {
        $record = array('message' => $message);
        
        $shuffle = new Shuffle();
        $shuffledRecord = $shuffle->lolify($record);
        
        $messageToArray = $this->convertStringToArray($message);
        $shuffledMessageToArray = $this->convertStringToArray($shuffledRecord['message']);
        
        if(count(array_unique($messageToArray)) > 1)
        {
            $this->assertNotSame($message, $shuffledRecord['message']);
        }
        
        foreach($shuffledMessageToArray as $word)
        {
            $this->assertTrue(in_array($word, $messageToArray));
        }
    }
    
    private function convertStringToArray($string)
    {
        return explode(' ', $string);
    }
    
    public function providerTestMessageShuffle()
    {
        return array(
            array(''),
            array('pony'),
            array('burger burger'),
            array('My littlest pony'),
            array('Oops, it seems that there was an error!'),
            array('42 3945 : unicorn ->kawai'),
        );
    }
}
