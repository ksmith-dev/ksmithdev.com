<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table');
            $table->string('column');
            $table->string('type')->nullable();
            $table->text('list')->nullable();
            $table->string('attribute')->nullable();
            $table->string('validation')->nullable();
            $table->string('aria_described_by')->nullable();
            $table->boolean('protected')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form');
    }
}
