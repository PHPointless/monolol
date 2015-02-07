<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;
use Monolog\Logger;

class Yolo implements Lolifier
{
    private
        $acceptedLevels;
        
    public function __construct()
    {
        $this->acceptedLevels = array(
            Logger::DEBUG,
            Logger::INFO,
        );
    }    
        
    public function isHandling(array $record)
    {
        $this->ensureLevelKeyExists($record);
            
        return in_array($record['level'], $this->acceptedLevels);
    }
    
    private function ensureLevelKeyExists(array $record)
    {
        if(! array_key_exists('level', $record))
        {
            throw new \RuntimeException('No level found in record');
        }
    }
    
    public function lolify(array $record)
    {
        return $record;
    }
}

