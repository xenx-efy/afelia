<?php

namespace Tests\Feature\Compositions;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GetCompositionsTest extends TestCase
{

    use DatabaseTransactions;

    private string $uri = '/async/tracks';

    /**
     * @test
     *
     * @return void
     */
    public function get_tracks(): void
    {
        $response = $this->json('GET', $this->uri);

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [],
            'links' => [],
            'meta' => []
        ]);

        $content = $response->getContent();

        self::assertNotFalse($content);

        $content = json_decode($content);

        self::assertNotEmpty($content->status, 'Status property is empty');
        self::assertNotEmpty($content->data, 'Data property is empty');
        self::assertNotEmpty($content->links, 'Links property is empty');
        self::assertNotEmpty($content->meta, 'Meta property is empty');
    }

    /**
     * @test
     */
    public function get_tracks_sorted_by_title_composer_asc()
    {
        $response = $this->json('GET', $this->uri . '?title=Бах');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [],
            'links' => [],
            'meta' => []
        ]);

        $content = $response->getContent();

        self::assertNotFalse($content, 'Response error.');

        $content = json_decode($content);

        self::assertNotEmpty($content->status, 'Status property is empty');
        self::assertNotEmpty($content->data, 'Data property is empty');
        self::assertNotEmpty($content->links, 'Links property is empty');
        self::assertNotEmpty($content->meta, 'Meta property is empty');

        $sortedTracks = $content->data;
        usort($sortedTracks, static function ($a, $b) {
            return $a->title > $b->title;
        });

        self::assertEquals($sortedTracks, $content->data);
    }


    /**
     * @test
     */
    public function get_tracks_sorted_by_title_asc()
    {
        $response = $this->json('GET', $this->uri . '?title=Ada');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [],
            'links' => [],
            'meta' => []
        ]);

        $content = $response->getContent();

        self::assertNotFalse($content, 'Response error.');

        $content = json_decode($content);

        self::assertNotEmpty($content->status, 'Status property is empty');
        self::assertNotEmpty($content->data, 'Data property is empty');
        self::assertNotEmpty($content->links, 'Links property is empty');
        self::assertNotEmpty($content->meta, 'Meta property is empty');

        $sortedTracks = $content->data;
        usort($sortedTracks, static function ($a, $b) {
            return $a->title > $b->title;
        });

        self::assertEquals($sortedTracks, $content->data);
    }
}

