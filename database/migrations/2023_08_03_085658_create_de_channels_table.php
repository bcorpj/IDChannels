<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('de_channels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id');
            $table->string('client_provider_name');
            $table->string('start_connection_point');
            $table->string('end_connection_point');
            $table->string('intermediate_connection');
            $table->string('using_device');
            $table->date('connection_date');
            $table->string('length');
            $table->string('testing');
            $table->string('connection_line');
            $table->string('reason');
            $table->timestamps();

            $table->foreign('channel_id')->references('id')->on('channels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('de_channels');
    }
};
