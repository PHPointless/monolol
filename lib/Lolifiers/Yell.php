<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Yell implements Lolifier
{
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        $record['message'] = strtoupper($record['message']);
        
        return $record;
    }
}
