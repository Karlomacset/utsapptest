<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middleName')->nullable();
            $table->string('motherMaidenName')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('state')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('country')->nullable();
            $table->string('landline')->nullable();
            $table->string('mobileNo')->nullable();
            $table->string('email')->nullable();
            $table->string('companyName')->nullable();
            $table->string('position')->nullable();
            $table->string('companyAddress1')->nullable();
            $table->string('companyAddress2')->nullable();
            $table->string('companyCity')->nullable();
            $table->string('companyProvince')->nullable();
            $table->string('companyState')->nullable();
            $table->string('companyZipCode')->nullable();
            $table->string('companyCountry')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
