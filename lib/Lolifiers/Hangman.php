<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;

class Hangman implements Lolifier
{
    public function isHandling(array $record)
    {
        return true;
    }
    
    public function lolify(array $record)
    {
        $record['message'] = preg_replace_callback('~\b(\w{1})(\w+)(\w{1})\b~u', function($matches) {
            return $matches[1] . str_pad('', strlen($matches[2]), '_') . $matches[3];
        }, $record['message']);
        
        return $record;
    }
}
