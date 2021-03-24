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
            'name' => 'toolbox'
        ]);
        Icon::create([
            'name' => 'wrench'
        ]);
        Icon::create([
            'name' => 'screwdriver'
        ]);

        Icon::create([
            'name' => 'hammer'
        ]);
        Icon::create([
            'name' => 'toilet'
        ]);
        Icon::create([
            'name' => 'wifi'
        ]);
        Icon::create([
            'name' => 'route'
        ]);
        Icon::create([
            'name' => 'sitemap'
        ]);

        InspectionType::create([
            'name' => 'Brandblussers',
            'description' => 'Alle brandblussers moeten niet over de datum zijn.',
            'color' => '#FF3333',
            'icon_id' => '2'
        ]);
        InspectionType::create([
            'name' => 'Bedrading',
            'description' => 'De bedrading moet kloppen',
            'color' => '#335BFF',
            'icon_id' => '10'
        ]);
    }
}
