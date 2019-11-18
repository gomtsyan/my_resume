<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('title', 100)->after('name');
            $table->text('sub_title')->nullable()->after('img');
            $table->text('keywords')->nullable()->after('sub_title');
            $table->text('meta_desc')->nullable()->after('keywords');
            $table->enum('is_active', array(0, 1))->default(0)->after('meta_desc');
            $table->integer('order')->default(1)->unsigned()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('sub_title');
            $table->dropColumn('keywords');
            $table->dropColumn('meta_desc');
            $table->dropColumn('is_active');
            $table->dropColumn('order');
        });
    }
}
