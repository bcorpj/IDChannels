<?php

use App\Models\DirectionLevel;
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
        ['международный', 'I'],
        ['междугородний', 'IC'],
        ['местный', 'L'],
    ];

    public function up()
    {
        Schema::create('direction_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->timestamps();
        });
        $this->create(DirectionLevel::class);
    }

    public function down()
    {
        Schema::dropIfExists('direction_levels');
    }
};
