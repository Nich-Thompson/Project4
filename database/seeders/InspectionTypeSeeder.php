<?php

namespace Database\Seeders;

use App\Models\Icon;
use App\Models\InspectionType;
use Illuminate\Database\Seeder;

class InspectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Icon::create([
            'name' => 'cog'
        ]);
        Icon::create([
            'name' => 'fire-extinguisher'
        ]);
        Icon::create([
            'name' => 'wrench'
        ]);
        Icon::create([
            'name' => 'wifi'
        ]);
        Icon::create([
            'name' => 'sitemap'
        ]);
        Icon::create([
            'name' => 'plug'
        ]);
        Icon::create([
            'name' => 'bolt'
        ]);
        Icon::create([
            'name' => 'magnet'
        ]);
        Icon::create([
            'name' => 'folder'
        ]);
        Icon::create([
            'name' => 'file'
        ]);
        Icon::create([
            'name' => 'fire'
        ]);
        Icon::create([
            'name' => 'battery-half'
        ]);
        Icon::create([
            'name' => 'bluetooth'
        ]);

        InspectionType::create([
            'name' => 'Brandblussers',
            'description' => 'Alle brandblussers moeten niet over de datum zijn.',
            'color' => '#FF3333',
            'icon_id' => '2'
        ]);
        InspectionType::create([
            'name' => 'Wifi',
            'description' => 'De wifi moet het doen.',
            'color' => '#4dff58',
            'icon_id' => '4'
        ]);
        InspectionType::create([
            'name' => 'Bedrading',
            'description' => 'De bedrading moet kloppen',
            'color' => '#335BFF',
            'icon_id' => '5'
        ]);
    }
}
