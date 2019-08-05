<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors_books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aid')->unsigned();
            $table->integer('bid')->unsigned();

            $table->index('aid');
            $table->index('bid');

            $table->foreign('aid')
                ->references('id')
                ->on('authors')
                ->onDelete('cascade');

            $table->foreign('bid')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors_books');
    }
}
