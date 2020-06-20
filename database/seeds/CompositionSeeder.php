<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compositions')->insert([
            'id' => 1,
            'title' => 'Adajio',
            'composer_id' => 1,
        ]);

        DB::table('compositions')->insert([
            'id' => 2,
            'title' => 'Шутка',
            'composer_id' => 2,
        ]);

        DB::table('compositions')->insert([
            'id' => 3,
            'title' => 'Ария',
            'composer_id' => 3,
        ]);
    }
}
