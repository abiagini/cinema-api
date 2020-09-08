<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

final class MoviesApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        Passport::actingAs(
            factory(User::class)->create()
        );
    }

    /** @test */
    public function it_should_return_a_list_of_movies_in_json()
    {
        $movies = factory(Movie::class, 50)->create();

        $response = $this->get('api/movies');

        $response->assertExactJson($movies->toArray());

    }

    /** @test */
    public function it_should_return_a_empty_json_list_when_there_are_no_movies()
    {
        $response = $this->get('api/movies');

        $response->assertJsonCount(0)
            ->assertJson([]);

    }


}
