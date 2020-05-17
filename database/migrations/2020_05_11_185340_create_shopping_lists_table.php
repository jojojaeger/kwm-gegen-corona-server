<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('Einkaufsliste');
            $table->datetime('due_date');
            $table->float('total_price')->nullable();
            $table->boolean('done')->default(false);
            $table->integer('volunteer_id')->unsigned()->nullable();
            $table->foreign('volunteer_id')->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->integer('helpseeker_id')->unsigned()->nullable();
            $table->foreign('helpseeker_id')->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('shopping_lists');
    }
}
