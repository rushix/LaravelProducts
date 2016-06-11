<?php

namespace Rushi\Products;

use Illuminate\Support\Facades\Facade;

class ProductsFacade extends Facade
{
    protected static function getFacadeAccessor() { 
        return 'rushi-products';
    }
}
