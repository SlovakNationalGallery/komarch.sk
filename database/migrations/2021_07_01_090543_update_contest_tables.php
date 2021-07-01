<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContestTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->renameColumn('subject', 'perex');
            $table->date('results_published_at')->nullable()->change();
            $table->dropColumn('goal');
        });

        Schema::create('rewards', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('contest_id')->constrained();
            $table->char('type', 1)->nullable();
            $table->tinyInteger('order')->nullable();
            $table->string('name')->nullable();
            $table->float('amount', 10, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('contestresults', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('reward_id')->constrained();
            $table->string('subject_name')->nullable();
            $table->longText('jury_comment')->nullable();
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
        Schema::dropIfExists('contestresults');
        Schema::dropIfExists('rewards');
        Schema::table('contests', function (Blueprint $table) {
            $table->string('goal')->nullable();
            $table->string('results_published_at')->nullable()->change();
            $table->renameColumn('perex', 'subject');
        });
    }
}
