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
        Schema::create('article_tags', function (Blueprint $table){
            $table->id();
            $table->integer('article_id')  
                    ->unsigned()  
                    ->index();  
            $table->foreign('article_id')  
                    ->references('id')  
                    ->on('articles')  
                    ->onDelete('cascade');  

            $table->integer('tag_id')  
                    ->unsigned()  
                    ->index();  
            $table->foreign('tag_id')  
                    ->references('id')  
                    ->on('tags')  
                    ->onDelete('cascade');  

            $table->primary(['article_id', 'tag_id']);  
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
        Schema::dropIfExists('article_tags');
    }
};  
