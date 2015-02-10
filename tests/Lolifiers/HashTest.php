<?php

namespace Monolol\Lolifiers;

use Monolog\Logger;

class HashTest extends \PHPUnit_Framework_TestCase
{
    public function testHandling()
    {
        $this->assertTrue((new Hash())->isHandling(array()));
    }

    public function testHash()
    {
        $record = array('message' => 'my littlest pony');

        $lolifier = new Hash();
        $lolified = $lolifier->lolify($record);

        $this->assertNotSame($record, $lolified);
    }
}
