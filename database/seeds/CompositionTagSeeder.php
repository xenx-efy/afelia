<?php

use App\Models\Composition;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompositionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Composition::all() as $composition) {
            DB::table('composition_tag')->insert([
                'composition_id' => $composition->id,
                'tag_id' => Tag::inRandomOrder()->first()->id
            ]);
            DB::table('composition_tag')->insert([
                'composition_id' => $composition->id,
                'tag_id' => Tag::inRandomOrder()->first()->id
            ]);
            DB::table('composition_tag')->insert([
                'composition_id' => $composition->id,
                'tag_id' => Tag::inRandomOrder()->first()->id
            ]);
        }
    }
}
