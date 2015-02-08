<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;
use Monolol\Referentials\MonologLevel;

class Confuse implements Lolifier
{
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        $this->ensureLevelKeyExists($record);    
        
        $availableLevels = $this->filterMonologLevels($record);
        $randomKey = array_rand($availableLevels);
        
        $record['level'] = $availableLevels[$randomKey];
        $record['level_name'] = $randomKey;
            
        return $record;
    }
    
    private function ensureLevelKeyExists(array $record)
    {
        if(! array_key_exists('level', $record))
        {
            throw new \RuntimeException('No level found in record');
        }
    }
    
    private function filterMonologLevels(array $record)
    {
        return array_filter(MonologLevel::getLevels(), function($level) use ($record) {
            return $record['level'] !== $level;
        });
    }
}
