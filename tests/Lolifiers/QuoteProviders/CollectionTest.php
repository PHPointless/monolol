<?php

use Monolol\Lolifiers\QuoteProviders;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerTestProviderCollection
     */
    public function testProviderCollection(array $expected, array $providers)
    {
        $providerCollection = new QuoteProviders\Collection();

        foreach($providers as $provider)
        {
            $providerCollection->add($provider);
        }

        $this->assertSame($expected, $providerCollection->getQuotes());
    }

    public function providerTestProviderCollection()
    {
        $emptyProvider = new QuoteProviders\EmptyQuoteProvider();
        $perceval = new QuoteProviders\Kaamelott\Perceval();
        $perceval2 = new QuoteProviders\Kaamelott\Perceval();
        $karadoc = new QuoteProviders\Kaamelott\Karadoc();

        return array(
            'Empty + Empty' => array(array(), array($emptyProvider, $emptyProvider)),
            'Same class, different instance' => array($perceval->getQuotes(), array($perceval, $perceval2)),
            'Perceval + Empty' => array($perceval->getQuotes(), array($perceval, $emptyProvider)),
            'Empty + Perceval' => array($perceval->getQuotes(), array($emptyProvider, $perceval)),
            'Empty + Karadoc + Empty' => array($karadoc->getQuotes(), array($emptyProvider, $karadoc, $emptyProvider)),
            'Perceval + Karadoc' => array(array_merge($perceval->getQuotes(), $karadoc->getQuotes()), array($perceval, $karadoc)),
            'Perceval + Perceval + Karadoc' => array(array_merge($perceval->getQuotes(), $karadoc->getQuotes()), array($perceval, $perceval, $karadoc)),
        );
    }
}