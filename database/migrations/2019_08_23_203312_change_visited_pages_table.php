<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVisitedPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visited_pages', function (Blueprint $table) {
            $table->index('visitor_id');
            $table->foreign('visitor_id')->references('id')->on('visitors')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visited_pages', function (Blueprint $table) {
            $table->dropForeign('visited_pages_visitor_id_foreign');
            $table->dropIndex('visited_pages_visitor_id_index');
        });
    }
}
