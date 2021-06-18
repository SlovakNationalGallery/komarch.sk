<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->string('title')->nullable();
            $table->string('subject')->nullable();
            $table->string('goal')->nullable();
            $table->string('contractor_business_name')->nullable();
            $table->string('contractor_business_number')->nullable();
            $table->string('contractor_location_street')->nullable();
            $table->string('contractor_location_register_number')->nullable();
            $table->string('contractor_location_descriptive_number')->nullable();
            $table->string('contractor_location_postal_code')->nullable();
            $table->string('contractor_location_city')->nullable();
            $table->string('contractor_location_state')->nullable();
            $table->float('contractor_location_lat', 10, 6)->nullable();
            $table->float('contractor_location_lng', 10, 6)->nullable();
            $table->char('type_purpose', 1)->nullable();
            $table->char('type_participants', 1)->nullable();
            $table->char('type_matter', 1)->nullable();
            $table->tinyInteger('type_round_count')->nullable();
            $table->tinyInteger('announcement_by')->nullable();
            $table->longText('participation_conditions')->nullable();
            $table->longText('note')->nullable();
            $table->string('web_terms')->nullable();
            $table->string('web_results')->nullable();
            $table->date('applied_at')->nullable();
            $table->date('announced_at')->nullable();
            $table->date('approved_at')->nullable();
            $table->date('finished_at')->nullable();
            $table->string('results_published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('jurors', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('contest_id')->constrained();
            $table->tinyInteger('depended');
            $table->char('type', 1);
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('proposals', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('contest_id')->constrained();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('proposals');
        Schema::dropIfExists('jurors');
        Schema::dropIfExists('contests');
    }
}
