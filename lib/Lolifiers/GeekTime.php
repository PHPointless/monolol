<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class GeekTime implements Lolifier
{
    public function isHandling(array $record)
    {
        $dateTime = $record['datetime'];

        return $this->isGeekTime($dateTime);
    }
    
    public function lolify(array $record)
    {
        return $record;
    }
    
    private function isGeekTime(\Datetime $dateTime)
    {
        if($dateTime->format('H:i') == '13:37')
        {
            return true;
        }
        
        return false;
    }
}
