<?php

namespace Monolol\Lolifiers;

use Monolol\Referentials\MonologLevel;
use Monolol\Lolifiers\Quote;
use Monolol\Lolifiers\QuoteProviders;
use Monolog\Logger;

class QuoteTest extends \PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $this->assertTrue((new Quote(new QuoteProviders\EmptyQuoteProvider()))->isHandling(array()));
    }

    /**
     * @dataProvider providerTestQuote
     */
    public function testQuote(QuoteProvider $provider, $logMessage)
    {
        $record = array('message' => $logMessage, 'datetime' => new \DateTime());

        $lolifier = new Quote($provider);

        $lolilfiedRecord = $lolifier->lolify($record);

        $this->assertTrue(in_array($lolilfiedRecord['message'], $provider->getQuotes()));
    }

    public function providerTestQuote()
    {
        return array(
            'Perceval' => array(new QuoteProviders\Kaamelott\Perceval(), 'Internal Burger Error'),
            'Karadoc'  => array(new QuoteProviders\Kaamelott\Karadoc(), 'Internal Pony Error'),
            'Merlin'   => array(new QuoteProviders\Kaamelott\Merlin(), 'Internal Unicorn Error'),
            'Kadoc'    => array(new QuoteProviders\Kaamelott\Kadoc(), 'Internal Rabbit Error'),
        );
    }

    public function testEmptyQuotes()
    {
        $record = array('message' => 'Lorem ipsum dolor sit amet', 'datetime' => new \DateTime());

        $provider = new QuoteProviders\EmptyQuoteProvider();

        $lolifier = new Quote($provider);

        $lolilfiedRecord = $lolifier->lolify($record);

        $this->assertSame($lolilfiedRecord['message'], null);
    }
}
