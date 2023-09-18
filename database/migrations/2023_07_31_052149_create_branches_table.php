<?php

use App\Models\Branch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public array $defaultBranches = [
        ['Провайдерский', 'Провайдерский', 0, 99],
        ['Межфилиальский', 'Межфилиальский', 100, 199],
        ['Западный филиал', 'ЗФ', 200, 299],
        ['Мангистауский филиал', 'МФ', 300, 399],
        ['Уральский филиал', 'УФ', 400, 499],
        ['Актюбинский филиал', 'АФ', 500, 599],
        ['Восточный филиал', 'ВФ', 600, 699],
        ['Астанинский филиал', 'АС', 700, 799],
        ['Южный филиал', 'ЮФ', 800, 899],
        ['Прочие', 'Прочие', 900, 999],
    ];
    public function saveBranches(): void
    {
        foreach ($this->defaultBranches as $key => $value)
        {
            $this->defaultBranches[$key] = ['name' => $value[0], 'alias' => $value[1], 'channel_range_from' => $value[2], 'channel_range_to' => $value[3], ];
        }

        Branch::insert($this->defaultBranches);
    }
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->integer('channel_range_from')->nullable();
            $table->integer('channel_range_to')->nullable();
        });

        $this->saveBranches();


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
