<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name')->nullable();
            $table->string('studio')->nullable();
            $table->string('location_country')->nullable();
            $table->string('location_district')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_street')->nullable();
            $table->string('location_register_number')->nullable();
            $table->string('location_descriptive_number')->nullable();
            $table->string('location_postal_code')->nullable();
            $table->float('location_lat', 10, 6)->nullable();
            $table->float('location_lng', 10, 6)->nullable();
            $table->year('date_design_start')->nullable();
            $table->year('date_design_ending')->nullable();
            $table->year('date_construction_start')->nullable();
            $table->year('date_construction_ending')->nullable();
            $table->string('webpage')->nullable();
            $table->longText('annotation')->nullable();
            $table->string('reg_number')->nullable();
            $table->boolean('has_public_investor')->nullable(false);
            $table->boolean('has_public_location')->nullable(false);
            $table->boolean('has_valuable_social_function')->nullable(false);
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
        Schema::dropIfExists('works');
    }
}
