<?php

namespace Database\Seeders;

use App\Models\ListModel;
use App\Models\ListValue;
use Illuminate\Database\Seeder;

class listSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListModel::create([
            'name' => 'Blus - Merken'
        ]);
        ListModel::create([
            'name' => 'Blus - Blusstoffen',
            'list_model_id' => '1'
        ]);
        ListModel::create([
            'name' => 'Blus - Types',
            'list_model_id' => '2'
        ]);

        ListValue::create([
            'name' => 'BCO',
            'list_model_id' => '1'
        ]);
        ListValue::create([
            'name' => 'Ajax',
            'list_model_id' => '1'
        ]);
        ListValue::create([
            'name' => 'Schuim',
            'list_model_id' => '2',
            'list_value_id' => '1'
        ]);
        ListValue::create([
            'name' => 'Poeder',
            'list_model_id' => '2'
        ]);
        ListValue::create([
            'name' => 'EPS6',
            'list_model_id' => '3',
            'list_value_id' => '3'
        ]);
    }
}
