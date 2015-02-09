<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;
use Monolog\Logger;

class NotGiveAFuck implements Lolifier
{
    const
        MESSAGE = "It seems that your application has encountered an issue. But as we don't give a fuck, we will not tell you what is the problem. Have a good day.";
    
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        $this->ensureLevelKeyExists($record);
            
        if($record['level'] > Logger::INFO)
        {
            $record['message'] = self::MESSAGE;
        }
        
        return $record;
    }
    
    private function ensureLevelKeyExists(array $record)
    {
        if(! array_key_exists('level', $record))
        {
            throw new \RuntimeException('No level found in record');
        }
    }
}
