<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePostsTranslatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function ($table) {
            $table->json('title_json')->after('title');
            $table->json('text_json')->nullable()->after('text');

            $table->dropColumn('title');
            $table->dropColumn('text');
        });

        Schema::table('posts', function ($table) {
            $table->renameColumn('title_json', 'title');
            $table->renameColumn('text_json', 'text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function ($table) {
            $table->string('title')->nullable()->change();
            $table->string('text')->nullable()->change();
        });
    }
}
