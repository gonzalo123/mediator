<?php

use G\Mediator;

class MediatorTest extends \PHPUnit_Framework_TestCase
{
    public function testSignal()
    {
        $mediator = new Mediator();

        $isTriggered = false;

        $mediator->connect('hello', function() use (&$isTriggered)
        {
            $isTriggered = true;
        });

        $this->assertFalse($isTriggered);
        $mediator->trigger('hello');
        $this->assertTrue($isTriggered);
    }

    public function testSignalWithParamenters()
    {
        $mediator = new Mediator();

        $isTriggered['gonzalo'] = false;

        $mediator->connect('hello', function($name) use (&$isTriggered)
        {
            $isTriggered['gonzalo'] = true;
        });

        $this->assertFalse($isTriggered['gonzalo']);
        $mediator->trigger('hello', ['name' => 'Gonzalo']);
        $this->assertTrue($isTriggered['gonzalo']);
    }

    public function testDisconnectSignals()
    {
        $mediator = new Mediator();

        $isTriggered = false;

        $mediator->connect('hello', function() use (&$isTriggered)
        {
            $isTriggered = true;
        });

        $this->assertFalse($isTriggered);
        $mediator->trigger('hello');
        $this->assertTrue($isTriggered);
        
        $isTriggered = false;
        $mediator->disconnect('hello');
        $mediator->trigger('hello');
        $this->assertFalse($isTriggered);
    }
}