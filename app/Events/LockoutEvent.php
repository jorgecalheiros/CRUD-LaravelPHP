<?php

namespace App\Events;

class LockoutEvent
{
    public $key;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($key)
    {
        $this->key = $key;
    }
}
