<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContestTables2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->string('contractor_location_district')->nullable()->after('contractor_location_state');
        });

        Schema::create('architect_contestresult', function (Blueprint $table) {
            $table->bigInteger('id', false, true)->primary();
            $table->foreignId('contestresult_id')->constrained();
            $table->foreignId('architect_id')->constrained();
            $table->char('type', 1)->nullable();
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
        Schema::dropIfExists('architect_contestresult');

        Schema::table('contests', function (Blueprint $table) {
            $table->dropColumn('contractor_location_district');
        });
    }
}
