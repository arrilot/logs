<?php

namespace Arrilot\Tests\Logs;

use Arrilot\Logs\EchoLogger;
use Arrilot\Logs\Logs;
use PHPUnit_Framework_TestCase;

class LogsTest extends PHPUnit_Framework_TestCase
{
    public function test_working_without_a_logger()
    {
        $dummy = new DummyClass();
        $dummy->foo();

        $this->assertTrue(true);
    }
    
    public function test_working_with_psr_logger()
    {
        $dummy = new DummyClass();
        $dummy->setLogger(new EchoLogger());
        $dummy->foo();
        
        $this->expectOutputRegex('/\[(.*?)\] (.*?)/s');
    }
    
    public function test_working_with_echo_logger()
    {
        $dummy = new DummyClass();
        $dummy->setEchoLogger();
        $dummy->foo();

        $this->expectOutputRegex('/\[(.*?)\] (.*?)/s');
    }

    public function test_removing_a_logger()
    {
        $dummy = new DummyClass();
        $dummy->setEchoLogger();
        $dummy->removeLogger();
        $dummy->foo();
        
        $this->expectOutputString('');
    }
}
