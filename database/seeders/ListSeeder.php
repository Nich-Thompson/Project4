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
            'name' => 'BCO2',
            'list_model_id' => '1'
        ]);
        ListValue::create([
            'name' => 'Blusstof 1',
            'list_model_id' => '2'
        ]);
        ListValue::create([
            'name' => 'Blusstof 2',
            'list_model_id' => '2'
        ]);
        ListValue::create([
            'name' => 'Blustype 1',
            'list_model_id' => '3'
        ]);
        ListValue::create([
            'name' => 'Blustype 2',
            'list_model_id' => '3'
        ]);
    }
}
