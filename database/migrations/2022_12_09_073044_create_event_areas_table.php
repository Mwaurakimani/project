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
        Schema::create('event_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invite_id');
            $table->unsignedBigInteger('arrears_id');
            $table->timestamps();

            $table->foreign('invite_id')->references('id')->on('invites');
            $table->foreign('arrears_id')->references('id')->on('arrears');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_areas');
    }
};
