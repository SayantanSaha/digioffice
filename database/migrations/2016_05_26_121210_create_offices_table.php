<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('name_local')->nullable();
			$table->string('district')->nullable();
			$table->string('district_local')->nullable();
			$table->string('subdivision')->nullable();
			$table->string('subdivision_local')->nullable();
			$table->string('circle')->nullable();
			$table->string('circle_local')->nullable();
			$table->string('head');
			$table->string('head_local')->nullable();
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
        Schema::drop('offices');
    }
}
