<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComposerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('composers')->insert([
            'id' => 1,
            'composer_name' => 'Иоганн Себастьян Бах'
        ]);

        DB::table('composers')->insert([
            'id' => 2,
            'composer_name' => 'Вольфганг Амадей Моцарт'
        ]);

        DB::table('composers')->insert([
            'id' => 3,
            'composer_name' => 'Томазо Альбинони'
        ]);
    }
}
