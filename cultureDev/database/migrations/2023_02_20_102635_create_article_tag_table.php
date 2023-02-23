<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')  
                    ->nullable();
            $table->unsignedBigInteger('tag_id')  
                    ->nullable();
            $table->foreign('article_id')  
                    ->references('id')  
                    ->on('articles')  
                    ->onDelete('cascade');  
            $table->foreign('tag_id')  
                    ->references('id')  
                    ->on('tags')  
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
        Schema::dropIfExists('article_tag');
    }
};  