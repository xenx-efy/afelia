<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'title' => 'Печальная'
        ]);

        DB::table('tags')->insert([
            'title' => 'Веселая'
        ]);

        DB::table('tags')->insert([
            'title' => 'Нейтральная'
        ]);

        DB::table('tags')->insert([
            'title' => 'Вроде норм'
        ]);
    }
}
