<?php

use App\Models\Composition;
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
        factory(Composition::class, 1000)->create();
    }
}
