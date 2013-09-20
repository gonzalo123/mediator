<?php

namespace G;

class Mediator
{
    private $signals = [];

    public function connect($event, callable $callback)
    {
        $this->signals[$event][] = $callback;
    }

    public function disconnect($event)
    {
        unset($this->signals);
    }

    public function trigger($event, array $parameters = [])
    {
        if (isset($this->signals[$event]) && is_array($this->signals[$event]) && count($this->signals[$event]) > 0) {
            foreach ($this->signals[$event] as $callback) {
                call_user_func_array($callback, $parameters);
            }
        }
    }
}