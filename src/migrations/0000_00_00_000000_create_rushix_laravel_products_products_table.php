<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRushixLaravelProductsProductsTable extends Migration
{
    public function up()
    {
        Schema::create('rushix_laravelproducts_products', function(Blueprint $t)
        {
            $t->increments('id')->unsigned();
            $t->string('art', 225)->unique();
            $t->string('name', 225);
            $t->softDeletes();
            $t->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('rushix_laravelproducts_products');
    }
}
