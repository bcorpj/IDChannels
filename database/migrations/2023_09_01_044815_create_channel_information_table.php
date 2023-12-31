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
        Schema::create('channel_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->nullable();
            $table->json('repeater')->nullable();
            $table->text('markdown')->nullable();

            $table->timestamps();
            $table->foreign('channel_id')->references('id')->on('channels')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channel_information');
    }
};
