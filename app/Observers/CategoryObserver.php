<?php

namespace App\Observers;

use Cache;

class CategoryObserver
{
    /**
     * Heandle the User "created" event
     */
    public function created()
    {
        Cache::delete("categories");
    }
}
