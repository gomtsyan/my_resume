<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitedPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visited_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('visitor_id')->unsigned();
            $table->string('page')->nullable();
            $table->string('additional_data')->nullable();
            $table->integer('count')->unsigned()->default(1);
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
        Schema::dropIfExists('visited_pages');
    }
}
