<?php

use Monolol\Lolifiers\QuoteProviders;
use Monolol\Lolifiers\QuoteProviders\Collection;

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
        $merlin = new QuoteProviders\Kaamelott\Merlin();
        $kadoc = new QuoteProviders\Kaamelott\Kadoc();

        $collectionA = new Collection();
        $collectionA->add($perceval)->add($karadoc);

        $collectionB = new Collection();
        $collectionB->add($merlin)->add($kadoc);
        
        return array(
            'Empty + Empty' => array(array(), array($emptyProvider, $emptyProvider)),
            'Same class, different instance' => array($perceval->getQuotes(), array($perceval, $perceval2)),
            'Perceval + Empty' => array($perceval->getQuotes(), array($perceval, $emptyProvider)),
            'Empty + Perceval' => array($perceval->getQuotes(), array($emptyProvider, $perceval)),
            'Empty + Karadoc + Empty' => array($karadoc->getQuotes(), array($emptyProvider, $karadoc, $emptyProvider)),
            'Perceval + Karadoc' => array(array_merge($perceval->getQuotes(), $karadoc->getQuotes()), array($perceval, $karadoc)),
            'Perceval + Perceval + Karadoc' => array(array_merge($perceval->getQuotes(), $karadoc->getQuotes()), array($perceval, $perceval, $karadoc)),
            'Collection + empty' => array($collectionA->getQuotes(), array($collectionA, $emptyProvider)),
            'Collection + Kadoc' => array(array_merge($collectionA->getQuotes(), $kadoc->getQuotes()), array($collectionA, $kadoc)),
            'Collection + Collection' => array(array_merge($collectionA->getQuotes(), $collectionB->getQuotes()), array($collectionA, $collectionB)),
        );
    }
}