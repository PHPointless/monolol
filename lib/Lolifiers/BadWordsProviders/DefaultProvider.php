<?php

namespace Monolol\Lolifiers\BadWordsProviders;

use Monolol\Lolifiers\BadWordsProvider;

class DefaultProvider implements BadWordsProvider
{
    public function getBadWords()
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
