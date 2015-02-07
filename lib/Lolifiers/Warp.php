<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Warp implements Lolifier
{
    const
        MIN_INTERVAL = 1,
        MAX_INTERVAL = 5;
        
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        $this->ensureDateTimeKeyExists($record);
        $this->travelIntoWarp($record['datetime']);
        
        return $record;
    }
    
    private function ensureDateTimeKeyExists(array $record)
    {
        if(! array_key_exists('datetime', $record))
        {
            throw new \RuntimeException('No datetime found in record');
        }
    }
    
    private function travelIntoWarp(\DateTime $datetime)
    {
        foreach($this->getMeasuresOfTime() as $measure => $prefix)
        {
            $interval = rand(self::MIN_INTERVAL, self::MAX_INTERVAL);
            
            $datetime->add(new \DateInterval($prefix . $interval . $measure));
        }
    }
    
    private function getMeasuresOfTime()
    {
        return array(
            'S' => 'PT',
            'M' => 'PT',
            'H' => 'PT',
            'D' => 'P',
            'M' => 'P',
        );
    }
}
