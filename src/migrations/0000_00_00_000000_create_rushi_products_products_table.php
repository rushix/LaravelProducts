<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRushiProductsProductsTable extends Migration
{
    public function up()
    {
        Schema::create('rushi_products_products', function(Blueprint $t)
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
        Schema::drop('rushi_products_products');
    }
}
