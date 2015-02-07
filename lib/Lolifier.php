<?php

namespace Monolol;

interface Lolifier
{
    public function isHandling(array $record);
    
    public function lolify(array $record);
}
