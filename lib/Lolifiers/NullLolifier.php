<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class NullLolifier implements Lolifier
{
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        return $record;
    }
}
