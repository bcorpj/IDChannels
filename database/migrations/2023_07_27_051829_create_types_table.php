<?php

use App\Models\Type;
use App\Traits\DefaultMigrationDataCreator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use DefaultMigrationDataCreator;

    public $columns = [
        'name', 'alias'
    ];
    public $defaults = [
        ['первичный', 'P'],
        ['вторичный', 'S'],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->timestamps();
        });
        $this->create(Type::class);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
