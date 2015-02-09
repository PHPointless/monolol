<?php

namespace Monolol\Lolifiers\QuoteProviders;

use Monolol\Lolifiers\QuoteProvider;

class EmptyQuoteProvider implements QuoteProvider
{
    public function getQuotes()
    {
        return array();
    }
}
