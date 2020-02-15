<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('companyName');
            $table->string('narrative')->nullable();
            $table->string('address1')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('contactPerson')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('mobileNo')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('apiKey')->nullable();
            $table->string('apiSecret')->nullable();
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
        Schema::dropIfExists('providers');
    }
}
