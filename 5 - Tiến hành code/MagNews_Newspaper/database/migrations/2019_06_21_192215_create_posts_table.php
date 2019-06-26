<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_post',300);
            $table->text('content_post');
            $table->mediumText('description_post');
            $table->string('slug_post')->unique();
            $table->integer('view')->default(1);
            $table->string('post_type')->default('text');
            $table->smallInteger('hot')->default(0);
            $table->smallInteger('status')->default(1);
            $table->mediumText("feture")->nullable();
            // Id user - người dùng 
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            // id categories - ko được âm 
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
}
