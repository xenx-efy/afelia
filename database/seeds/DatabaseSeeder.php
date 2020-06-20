<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(ComposerSeeder::class);
         $this->call(CompositionSeeder::class);
         $this->call(TagSeeder::class);
         $this->call(CompositionTagSeeder::class);
    }
}
