<?php

namespace App\Traits;


/**
 * @property array $columns
 * @property array $defaults
 */
trait DefaultMigrationDataCreator
{

    public function create(string $model): void
    {
        $data = array_map(function ($row)  {
            return array_combine($this->columns, $row);
        }, $this->defaults);

        $model::upsert($data, []);
        print "-> with a default data seeding ($model)";
    }
}
