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
            $table->string('client_provider_name')->nullable();
            $table->string('start_connection_point')->nullable();
            $table->string('end_connection_point')->nullable();
            $table->string('intermediate_connection')->nullable();
            $table->string('using_device')->nullable();
            $table->date('connection_date')->nullable();
            $table->string('length')->nullable();
            $table->string('testing')->nullable();
            $table->string('connection_line')->nullable();
            $table->text('reason')->nullable();
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
