<?php

use App\Models\ChannelType;
use App\Traits\DefaultMigrationDataCreator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use DefaultMigrationDataCreator;

    public array $columns = [
        'name', 'alias'
    ];

    public array $defaults = [
        ['Провайдерский', 'P'],
        ['Клиентский', 'C'],
        ['сервисный/служебный', 'S'],
        ['Резервный', 'R'],
        ['Операторский', 'O'],
    ];

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('channel_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->timestamps();
        });
        $this->create(ChannelType::class);
    }

    public function down()
    {
        Schema::dropIfExists('channel_types');
    }
};
