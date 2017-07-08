<?php

namespace Arrilot\Tests\Logs;

use Arrilot\Logs\Logs;

class DummyClass
{
    use Logs;

    public function foo()
    {
        $this->logger()->error('error_here');
    }
}