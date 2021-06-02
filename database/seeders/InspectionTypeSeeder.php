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
            'name' => 'cog',
            'unicode' => 'f013'
        ]);
        Icon::create([
            'name' => 'fire',
            'unicode' => 'f06d'
        ]);
        Icon::create([
            'name' => 'fire-extinguisher',
            'unicode' => 'f134'
        ]);
        Icon::create([
            'name' => 'wrench',
            'unicode' => 'f0ad'
        ]);
        Icon::create([
            'name' => 'wifi',
            'unicode' => 'f1eb'
        ]);
        Icon::create([
            'name' => 'sitemap',
            'unicode' => 'f0e8'
        ]);
        Icon::create([
            'name' => 'plug',
            'unicode' => 'f1e6'
        ]);
        Icon::create([
            'name' => 'bolt',
            'unicode' => 'f0e7'
        ]);
        Icon::create([
            'name' => 'magnet',
            'unicode' => 'f076'
        ]);
        Icon::create([
            'name' => 'folder',
            'unicode' => 'f07b'
        ]);
        Icon::create([
            'name' => 'file',
            'unicode' => 'f15b'
        ]);
        Icon::create([
            'name' => 'battery-half',
            'unicode' => 'f242'
        ]);
        Icon::create([
            'name' => 'bluetooth',
            'unicode' => 'f293'
        ]);

        InspectionType::create([
            'name' => 'blusmiddelen',
            'description' => 'Blusmiddelen moeten niet over de datum zijn.',
            'color' => '#FF3333',
            'icon_id' => '3'
        ]);
        InspectionType::create([
            'name' => 'Keerkleppen',
            'description' => '',
            'color' => '#4dff58',
            'icon_id' => '5'
        ]);
        InspectionType::create([
            'name' => 'Noodverlichting',
            'description' => 'Verlichting moet werken',
            'color' => '#335BFF',
            'icon_id' => '6'
        ]);
    }
}
