<?php

namespace Arrilot\Tests\Logs;

use Arrilot\Logs\EchoLogger;
use PHPUnit_Framework_TestCase;
use Psr\Log\LogLevel;

class EchoLoggerTest extends PHPUnit_Framework_TestCase
{
    public function test_it_can_echo_errors()
    {
        $logger = new EchoLogger();
        $logger->log(LogLevel::ERROR, 'error_message_here');

        $this->expectOutputRegex('/\[(.*?)\] error: error_message_here/s');
    }
}
