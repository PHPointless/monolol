<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Shuffle implements Lolifier
{
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        if($this->countDifferentWordsInMessage($record['message']) <= 1)
        {
            return $record;
        }
        
        $record['message'] = $this->shuffleMessage($record['message']);
        
        return $record;
    }
    
    private function countDifferentWordsInMessage($message)
    {
        $messageArray = $this->convertStringToArray($message);
        $messageArray = array_unique($messageArray);
            
        return count($messageArray);
    }
    
    private function convertStringToArray($message)
    {
        return explode(' ', $message);
    }
    
    private function convertArrayToString(array $array)
    {
        return implode(' ', $array);
    }
    
    private function shuffleMessage($message)
    {
            
        $messageArray = $this->convertStringToArray($message);
        
        do
        {
            $shuffledMessageArray = $this->shuffleArray($messageArray);
        }
        while($messageArray === $shuffledMessageArray);
        
        return $this->convertArrayToString($shuffledMessageArray);
    }
    
    private function shuffleArray(array $array)
    {
        shuffle($array);
        
        return $array;
    }
}
