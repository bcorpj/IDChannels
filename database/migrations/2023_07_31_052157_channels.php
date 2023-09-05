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
            $table->foreignId('channel_type_id')->nullable();
            $table->foreignId('traffic_type_id')->nullable();
            $table->foreignId('transmission_type_id')->nullable();
            $table->foreignId('direction_level_id')->nullable();
            $table->foreignId('type_id')->nullable();
            $table->string('bandwidth')->nullable();
            $table->timestamps();
//            $table->softDeletes();

            $table->foreign('channel_type_id')->references('id')->on('channel_types')->nullOnDelete();
            $table->foreign('traffic_type_id')->references('id')->on('traffic_types')->nullOnDelete();
            $table->foreign('transmission_type_id')->references('id')->on('transmission_types')->nullOnDelete();
            $table->foreign('direction_level_id')->references('id')->on('direction_levels')->nullOnDelete();
            $table->foreign('type_id')->references('id')->on('types')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
};
