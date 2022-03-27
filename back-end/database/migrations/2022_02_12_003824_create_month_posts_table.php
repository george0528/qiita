<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('month_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('post_id');
            $table->text('post_url');
            $table->text('title');
            $table->text('user_image_url');
            $table->text('user_name');
            $table->integer('likes_count');
            $table->boolean('is_new')->default(false);
            $table->integer('rank');
            $table->date('created_at');
            $table->json('tags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('month_posts');
    }
}
