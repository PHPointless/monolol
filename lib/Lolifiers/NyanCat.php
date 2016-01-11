<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class NyanCat implements Lolifier
{
    public function isHandling(array $record)
    {
        return true;
    }

    public function lolify(array $record)
    {
        $record['message'] = preg_replace("/[A-Za-zÀ-ÿ0-9]+/", "nya", $record['message']);

        return $record;
    }
}
