<?php

namespace Database\Seeders;

use App\Enums\EntityEnum;
use App\Library\Common\IdGenerator;
use App\Models\Icon;
use Illuminate\Database\Seeder;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Icon::create([
            'logo' => 'images/income-category/salary.png',
            'icon_usage' => 'income',
            'background_color' => '#ffffff',
            'icon_id' => IdGenerator::generateId(EntityEnum::ICON)
        ]);

        Icon::create([
            'logo' => 'images/income-category/youtube.png',
            'icon_usage' => 'income',
            'background_color' => '#ffffff',
            'icon_id' => IdGenerator::generateId(EntityEnum::ICON)
        ]);
    }
}
