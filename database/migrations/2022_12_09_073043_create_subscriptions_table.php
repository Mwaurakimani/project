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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('house_id');
            $table->boolean('recurring');
            $table->string('recurring_period');
            $table->string('recurring_units');
            $table->string('unit_price');
            $table->text('note');
            $table->date('subscription_start_date');
            $table->date('subscription_end_date');
            $table->timestamps();


            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('house_id')->references('id')->on('houses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
