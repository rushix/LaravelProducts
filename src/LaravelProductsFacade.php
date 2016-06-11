<?php

namespace Rushix\LaravelProducts;

use Illuminate\Support\Facades\Facade;

class LaravelProductsFacade extends Facade
{
    protected static function getFacadeAccessor() { 
        return 'rushi-products';
    }
}
