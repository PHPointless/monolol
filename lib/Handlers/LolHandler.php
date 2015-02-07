<?php

namespace Monolol\Handlers;

use Monolog\Handler\AbstractHandler;
use Monolog\Handler\HandlerInterface;
use Monolol\Lolifier;

class LolHandler extends AbstractHandler
{
    private
        $lolifier;
    
    protected
        $handler,
        $bubble;
    
    public function __construct($handler, Lolifier $lolifier, $bubble = true)
    {
        $this->handler = $handler;
        $this->lolifier = $lolifier;
        $this->bubble = $bubble;
        
        if (!$this->handler instanceof HandlerInterface && !is_callable($this->handler)) {
            throw new \RuntimeException("The given handler (".json_encode($this->handler).") is not a callable nor a Monolog\Handler\HandlerInterface object");
        }
    }
    
    public function isHandling(array $record)
    {
        return $this->lolifier->isHandling($record);
    }
    
    public function handle(array $record)
    {
        if (! $this->handler instanceof HandlerInterface) {
            $this->handler = call_user_func($this->handler, $record, $this);
            if (! $this->handler instanceof HandlerInterface) {
                throw new \RuntimeException("The factory callable should return a HandlerInterface");
            }
        }
        
        $record = $this->lolifier->lolify($record);
        
        if ($this->processors) {
            foreach ($this->processors as $processor) {
                $record = call_user_func($processor, $record);
            }
        }
        
        $this->handler->handle($record);
        
        return false === $this->bubble;
    }
}
