<?php

namespace Monolol\Lolifiers\SwearWordsProviders;

use Monolol\Lolifiers\SwearWordsProvider;

class DefaultProvider implements SwearWordsProvider
{
    public function getSwearWords()
    {
        return array(
            'BITCH',
            'FUCK',
            'BASTARD',
            'DICK',
            'SHIT',
            'BOLLOCKS',
            'ASSHOLE',
            'CUNT',
        );
    }
}
