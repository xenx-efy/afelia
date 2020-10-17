<?php

namespace Tests\Feature\Compositions;

use App\Models\Composer;
use App\Models\Composition;
use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateCompositionTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    private string $uri = '/async/tracks';

    /**
     * @test
     */
    public function create_track(): void
    {
        $trackTitle = $this->faker->title;
        $tags = Tag::inRandomOrder()->limit(3)->get()->map->id->toArray();
        $response = $this->json('POST', $this->uri, [
            'title' => $trackTitle,
            'composerId' => Composer::inRandomOrder()->first()->id,
            'tags' => $tags
        ]);

        $response->assertStatus(201);

        $testTrack = Composition::where('title', $trackTitle)->get();

        self::assertNotEmpty($testTrack);
    }

    /**
     * @test
     */
    public function create_track_with_wrong_title(): void
    {
        $trackTitle = Str::random(2);
        $tags = Tag::inRandomOrder()->limit(3)->get()->map->id->toArray();
        $response = $this->json('POST', $this->uri, [
            'title' => $trackTitle,
            'composerId' => Composer::inRandomOrder()->first()->id,
            'tags' => $tags
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error',
            'errors' => []
        ]);

        $testTrack = Composition::where('title', $trackTitle)->get();

        self::assertEmpty($testTrack);
    }
}
