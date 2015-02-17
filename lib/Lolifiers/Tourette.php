<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Tourette implements Lolifier
{
    private
        $badWordsProvider;
    
    public function __construct(BadWordsProvider $badWordsProvider)
    {
        $this->badWordsProvider = $badWordsProvider;
    }
    
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        $messageArray = explode(' ', $record['message']);
        $badWords = $this->badWordsProvider->getBadWords();
        
        $iterations = rand(1, 3);
        for($i = 0; $i < $iterations; $i++)
        {
            $badWord = $this->chooseBadWordRandomly($badWords);
            $this->insertBadWordIntoMessage($messageArray, $badWord);
        }
        
        $record['message'] = implode(' ', $messageArray);
        
        return $record;
    }
    
    private function chooseBadWordRandomly(array $badWords)
    {
        $index = array_rand($badWords);
        
        return $badWords[$index];
    }
    
    private function insertBadWordIntoMessage(array &$messageArray, $badWord)
    {
        array_splice($messageArray, rand(0, count($messageArray)), 0, $badWord);
    }
}
