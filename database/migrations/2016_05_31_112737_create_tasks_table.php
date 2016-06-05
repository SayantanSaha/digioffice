<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
			$table->string('subject');
			$table->string('to');
			$table->string('fileno')->unique();
			$table->integer('to_id')->references('id')->on('users')->nullable();
			$table->date('enddate');
			$table->text('details')->nullable();
			$table->boolean('file')->default(0);
			$table->string('file_extension')->nullable();
			$table->boolean('closed')->default(0);
			$table->integer('created_by')->references('id')->on('users');
			$table->softDeletes();
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
        Schema::drop('tasks');
    }
}
