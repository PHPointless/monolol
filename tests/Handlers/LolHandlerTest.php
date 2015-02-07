<?php

namespace Monolol\Handlers;

use Monolol\Lolifiers\NullLolifier;
use Monolog\Logger;
use Monolog\Handler\TestHandler;
use Monolog\TestCase;

class LolHandlerTest extends TestCase
{
    private
        $testHandler,
        $lolHandler;
    
    protected function setUp()
    {
        $this->testHandler = new TestHandler();
        $this->lolHandler = new LolHandler($this->testHandler, new NullLolifier());
    }
    
    public function testHandle()
    {
        $this->lolHandler->handle($this->getRecord(Logger::DEBUG));
        $this->assertTrue($this->testHandler->hasDebugRecords());
        
        $this->lolHandler->handle($this->getRecord(Logger::INFO));
        $this->assertTrue($this->testHandler->hasInfoRecords());
        
        $this->lolHandler->handle($this->getRecord(Logger::NOTICE));
        $this->assertTrue($this->testHandler->hasNoticeRecords());
        
        $this->lolHandler->handle($this->getRecord(Logger::WARNING));
        $this->assertTrue($this->testHandler->hasWarningRecords());
        
        $this->lolHandler->handle($this->getRecord(Logger::ERROR));
        $this->assertTrue($this->testHandler->hasErrorRecords());
        
        $this->lolHandler->handle($this->getRecord(Logger::CRITICAL));
        $this->assertTrue($this->testHandler->hasCriticalRecords());
        
        $this->lolHandler->handle($this->getRecord(Logger::ALERT));
        $this->assertTrue($this->testHandler->hasAlertRecords());
        
        $this->lolHandler->handle($this->getRecord(Logger::EMERGENCY));
        $this->assertTrue($this->testHandler->hasEmergencyRecords());
    }
    
    public function testHandleUsesProcessors()
    {
        $this->lolHandler->pushProcessor(
            function ($record) {
                $record['extra']['foo'] = true;

                return $record;
            }
        );
        
        $this->lolHandler->handle($this->getRecord());
        
        $records = $this->testHandler->getRecords();
        $this->assertTrue($records[0]['extra']['foo']);
    }

    public function testHandleRespectsBubble()
    {
        $this->lolHandler->setBubble(false);
        $this->assertTrue($this->lolHandler->handle($this->getRecord()));
        
        $this->lolHandler->setBubble(true);
        $this->assertFalse($this->lolHandler->handle($this->getRecord()));
    }

    public function testHandleWithCallback()
    {
        $lolHandler = new LolHandler(
            function () {
                return $this->testHandler;
            },
            new NullLolifier
        );
        
        $lolHandler->handle($this->getRecord(Logger::DEBUG));
        $this->assertTrue($this->testHandler->hasDebugRecords());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testHandleWithBadCallbackThrowsException()
    {
        $lolHandler = new LolHandler(
            function () {
                return 'foo';
            },
            new NullLolifier()
        );
        $lolHandler->handle($this->getRecord(Logger::WARNING));
    }
}
