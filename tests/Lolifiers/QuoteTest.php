<?php

namespace Monolol\Lolifiers;

use Monolol\Referentials\MonologLevel;
use Monolol\Lolifiers\Quote;
use Monolol\Lolifiers\QuoteProviders;
use Monolog\Logger;

class QuoteTest extends \PHPUnit_Framework_TestCase
{
    private
        $confuse;

    /**
     *
     * @dataProvider providerTestHandling
     */
    public function testHandling($level)
    {
        $record = array('level' => $level);

        $lolifier = new Quote(new QuoteProviders\EmptyQuoteProvider());

        $this->assertTrue($lolifier->isHandling($record));
    }

    public function providerTestHandling()
    {
        return array(
            'debug' => array(Logger::DEBUG),
            'info' => array(Logger::INFO),
            'notice' => array(Logger::NOTICE),
            'warning' => array(Logger::WARNING),
            'error' => array(Logger::ERROR),
            'critical' => array(Logger::CRITICAL),
            'alert' => array(Logger::ALERT),
            'emergency' => array(Logger::EMERGENCY),
        );
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
            'Kadoc'    => array(new QuoteProviders\Kaamelott\Merlin(), 'Internal Rabbit Error'),
        );
    }
}
