<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Mirror implements Lolifier
{
    public function isHandling(array $record)
    {
        return true;
    }

    public function lolify(array $record)
    {
        $record['message'] = strrev($record['message']);

        return $record;
    }
}
