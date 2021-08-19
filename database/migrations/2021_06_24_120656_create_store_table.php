<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->string('name_fantasy', 100)->nullable();
            $table->string('cnpj', 100)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('number', 10)->nullable();
            $table->string('complement', 40)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 10)->nullable();
            $table->string('cellphone', 20)->nullable();
            $table->string('site', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store');
    }
}
