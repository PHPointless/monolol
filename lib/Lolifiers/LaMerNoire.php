<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;
use Monolol\Referentials\MonologLevel;

class LaMerNoire implements Lolifier
{
    const
        LA_MER_NOIRE = 'La mer noire';

    public function isHandling(array $record)
    {
        return true;
    }

    public function lolify(array $record)
    {
        $record['message'] = self::LA_MER_NOIRE;

        return $record;
    }
}
