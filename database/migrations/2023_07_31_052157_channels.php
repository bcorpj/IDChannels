<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('channel_number')->nullable();
            $table->string('klm')->nullable();
            $table->foreignId('channel_type_id');
            $table->foreignId('traffic_type_id');
            $table->foreignId('transmission_type_id');
            $table->foreignId('direction_level_id');
            $table->foreignId('type_id');
            $table->string('bandwidth')->nullable();
            $table->timestamps();

            $table->foreign('channel_type_id')->references('id')->on('channel_types');
            $table->foreign('traffic_type_id')->references('id')->on('traffic_types');
            $table->foreign('transmission_type_id')->references('id')->on('transmission_types');
            $table->foreign('direction_level_id')->references('id')->on('direction_levels');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
};
