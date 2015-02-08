<?php

namespace Monolol\Referentials;

use Monolog\Logger;

class MonologLevel
{
    public static function getLevels()
    {
        return array(
            'DEBUG' => Logger::DEBUG,
            'INFO' => Logger::INFO,
            'NOTICE' => Logger::NOTICE,
            'WARNING' => Logger::WARNING,
            'ERROR' => Logger::ERROR,
            'CRITICAL' => Logger::CRITICAL,
            'ALERT' => Logger::ALERT,
            'EMERGENCY' => Logger::EMERGENCY,
        );
    }
}
