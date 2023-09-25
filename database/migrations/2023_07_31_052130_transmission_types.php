<?php

use App\Models\TransmissionType;
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
        ['наземный', 'L'],
        ['спутниковый', 'S'],
        ['комбинированный', 'C'],
        ['РРЛ и прочие', 'R'],
    ];

    public function up()
    {
        Schema::create('transmission_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->timestamps();
        });
        $this->create(TransmissionType::class);
    }

    public function down()
    {
        Schema::dropIfExists('transmission_types');
    }
};
