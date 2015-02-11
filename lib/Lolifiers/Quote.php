<?php

namespace Monolol\Lolifiers;

use Monolol\Lolifier;
use Monolol\Lolifiers\QuoteProvider;

class Quote implements Lolifier
{
    private
        $provider;

    public function __construct(QuoteProvider $provider)
    {
        $this->provider = $provider;
    }

    public function isHandling(array $record)
    {
        return true;
    }

    public function lolify(array $record)
    {
        $quote = $this->getRandomQuote();

        $record['message'] = $quote;

        return $record;
    }

    private function getRandomQuote()
    {
        $quotes = $this->provider->getQuotes();

        if(empty($quotes))
        {
            return null;
        }

        return $quotes[array_rand($quotes)];
    }
}
