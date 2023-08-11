<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('site.settings') as $settings) {
            Setting::create([
                'meta_key' => $settings,
                'meta_value' => null,
            ]);
        }
    }
}
