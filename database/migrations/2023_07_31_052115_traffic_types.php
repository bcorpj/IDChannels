<?php

use App\Models\TrafficType;
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
        ['телефония', 'T'],
        ['интернет/ПД', 'I'],
        ['мультисервисный', 'M'],
        ['IP VPN', 'IP VPN'],
    ];

    public function up()
    {
        Schema::create('traffic_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->timestamps();
        });
        $this->create(TrafficType::class);
    }

    public function down()
    {
        Schema::dropIfExists('traffic_types');
    }
};
