<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Tourette implements Lolifier
{
    private
        $swearWordsProvider;
    
    public function __construct(SwearWordsProvider $swearWordsProvider)
    {
        $this->swearWordsProvider = $swearWordsProvider;
    }
    
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        $messageArray = explode(' ', $record['message']);
        $badWords = $this->swearWordsProvider->getSwearWords();
        
        $iterations = rand(1, 3);
        for($i = 0; $i < $iterations; $i++)
        {
            $badWord = $this->chooseBadWordRandomly($badWords);
            $this->insertSwearWordIntoMessage($messageArray, $badWord);
        }
        
        $record['message'] = implode(' ', $messageArray);
        
        return $record;
    }
    
    private function chooseBadWordRandomly(array $badWords)
    {
        $index = array_rand($badWords);
        
        return $badWords[$index];
    }
    
    private function insertSwearWordIntoMessage(array &$messageArray, $badWord)
    {
        array_splice($messageArray, rand(0, count($messageArray)), 0, $badWord);
    }
}
