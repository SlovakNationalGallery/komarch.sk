<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->default(0);
            $table->json('title');
            $table->string('slug');
            $table->json('text');
            $table->string('wp_post_name')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('author')->default('komarch');
            $table->integer('menu_order')->default(0);
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
        Schema::dropIfExists('pages');
    }
}
