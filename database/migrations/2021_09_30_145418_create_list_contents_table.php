<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_list_id");
            $table->foreign("product_list_id")->references("id")->on("product_lists")
                ->onDelete("cascade");
            $table->unsignedBigInteger("item_id");
            $table->foreign("item_id")->references("id")->on("items")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_contents');
    }
}
