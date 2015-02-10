<?php

namespace Monolol\Lolifiers\QuoteProviders;

use Monolol\Lolifiers\QuoteProvider;

class Collection implements QuoteProvider
{
    private
        $providers;

    public function __construct()
    {
        $this->providers = array();
    }

    public function getQuotes()
    {
        $quotes = array();

        foreach($this->providers as $provider)
        {
            $quotes = array_merge($quotes, $provider->getQuotes());
        }

        return $quotes;
    }

    public function add(QuoteProvider $provider)
    {
        if(! in_array($provider, $this->providers))
        {
            $this->providers[] = $provider;
        }

        return $this;
    }
}
