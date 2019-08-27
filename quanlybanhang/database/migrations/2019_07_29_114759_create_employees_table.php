<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username', 191);
            $table->string('last_name', 255);
            $table->string('first_name', 255);
            $table->string('email', 191);
            $table->string('avatar', 500)->nullable();
            $table->string('password', 500);
            $table->string('job_title', 255)->nullable();
            $table->integer('manager_id')->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('address1', 500)->nullable();
            $table->string('address2', 500)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('postal_code', 15)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->string('active_code', 255)->nullable();
            $table->tinyInteger('status');
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
