<?php

namespace Tests\Feature;

use App\Models\Composition;
use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CompositionsTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_tracks_by_composer_name()
    {
        $response = $this->json('GET', '/async/tracks?title=Бах');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [],
            'meta' => [],
            'links' => [],
        ]);
    }


    public function test_get_tracks_by_title()
    {
        $track = factory(Composition::class, 3)
            ->create()
            ->each(function($track) {
                /** @var $track Composition */
                $track->tags()->attach(Tag::inRandomOrder()->first()->id);
                $track->tags()->attach(Tag::inRandomOrder()->first()->id);
                $track->tags()->attach(Tag::inRandomOrder()->first()->id);
            })->first();

        $response = $this->json('GET', '/async/tracks?title=' . $track->title);

        $trackName = $response->getData()->data[0]->title;
        $trackFound = is_int(strpos($trackName, $track->title));

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [],
            'meta' => [],
            'links' => [],
        ])->assertJsonCount(1, 'data');

        $this->assertTrue($trackFound, 'Трек не был найден.');
    }
}
