<?php

use App\Models\Composer;
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
        factory(Composer::class, 30)->create();
    }
}
