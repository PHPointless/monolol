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
        return in_array($record['level'], $this->acceptedLevels);
    }
    
    public function lolify(array $record)
    {
        return $record;
    }
}

