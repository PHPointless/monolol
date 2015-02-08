<?php

namespace Monolol\Referentials;

use Monolog\Logger;

class MonologLevel
{
    public static function getLevels()
    {
        return array(
            'debug' => Logger::DEBUG,
            'info' => Logger::INFO,
            'notice' => Logger::NOTICE,
            'warning' => Logger::WARNING,
            'error' => Logger::ERROR,
            'critical' => Logger::CRITICAL,
            'alert' => Logger::ALERT,
            'emergency' => Logger::EMERGENCY,
        );
    }
}
