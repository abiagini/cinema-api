<?php

namespace Tests\Feature\Movies;

use App\Models\Movie;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

final class StoreMovieTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $movieTitle;
    protected $movieDescription;
    protected $movieRating;
    protected $movieImageUrl;

    protected function setUp(): void
    {
        parent::setUp();

        Passport::actingAs(
            factory(User::class)->create()
        );

        $this->movieTitle       = $this->faker->sentence;
        $this->movieDescription = $this->faker->paragraph;
        $this->movieImageUrl    = $this->faker->imageUrl();
        $this->movieRating      = $this->faker->numberBetween(
            Movie::MIN_RATING,
            Movie::MAX_RATING
        );
    }

    /** @test */
    public function it_should_create_a_movie()
    {
        $response = $this->postJson('api/movies', [
            'title'       => $this->movieTitle,
            'description' => $this->movieDescription,
            'rating'      => $this->movieRating,
            'image_url'   => $this->movieImageUrl,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'title'       => $this->movieTitle,
                'description' => $this->movieDescription,
                'rating'      => $this->movieRating,
                'image_url'   => $this->movieImageUrl
            ]);

        $this->assertDatabaseCount(Movie::TABLE, 1);
    }

    /** @test */
    public function request_should_fail_when_a_movie_title_is_not_provided()
    {
        $response = $this->postJson('api/movies', [
            'description' => $this->movieDescription,
            'rating'      => $this->movieRating,
            'image_url'   => $this->movieImageUrl
        ]);

        $response->assertJsonValidationErrors([
            'title'
        ]);

        $this->assertDatabaseCount(Movie::TABLE, 0);
    }

    /** @test */
    public function request_should_fail_when_a_movie_description_is_not_provided()
    {
        $response = $this->postJson('api/movies', [
            'title'       => $this->movieTitle,
            'rating'      => $this->movieRating,
            'image_url'   => $this->movieImageUrl
        ]);

        $response->assertJsonValidationErrors([
            'description'
        ]);

        $this->assertDatabaseCount(Movie::TABLE, 0);
    }

    /** @test */
    public function request_should_fail_when_a_movie_rating_is_not_provided()
    {
        $response = $this->postJson('api/movies', [
            'title'       => $this->movieTitle,
            'description' => $this->movieDescription,
            'image_url'   => $this->movieImageUrl
        ]);

        $response->assertJsonValidationErrors([
            'rating'
        ]);

        $this->assertDatabaseCount(Movie::TABLE, 0);
    }

    /** @test */
    public function request_should_fail_when_a_movie_rating_is_lower_than_max_valid_value()
    {
        $response = $this->postJson('api/movies', [
            'title'       => $this->movieTitle,
            'rating'      => Movie::MIN_RATING - 1,
            'description' => $this->movieDescription,
            'image_url'   => $this->movieImageUrl
        ]);

        $response->assertJsonValidationErrors([
            'rating'
        ]);

        $this->assertDatabaseCount(Movie::TABLE, 0);
    }

    /** @test */
    public function request_should_fail_when_a_movie_rating_is_greater_than_max_valid_value()
    {
        $response = $this->postJson('api/movies', [
            'title'       => $this->movieTitle,
            'rating'      => Movie::MAX_RATING + 1,
            'description' => $this->movieDescription,
            'image_url'   => $this->movieImageUrl
        ]);

        $response->assertJsonValidationErrors([
            'rating'
        ]);

        $this->assertDatabaseCount(Movie::TABLE, 0);
    }

    /** @test */
    public function request_should_fail_when_a_movie_rating_is_not_numeric()
    {
        $response = $this->postJson('api/movies', [
            'title'       => $this->movieTitle,
            'rating'      => $this->faker->word,
            'description' => $this->movieDescription,
            'image_url'   => $this->movieImageUrl
        ]);

        $response->assertJsonValidationErrors([
            'rating'
        ]);

        $this->assertDatabaseCount(Movie::TABLE, 0);
    }

    /** @test */
    public function request_should_fail_when_a_movie_image_url_is_not_provided()
    {
        $response = $this->postJson('api/movies', [
            'title'       => $this->movieTitle,
            'rating'      => $this->movieRating,
            'description' => $this->movieDescription,
        ]);

        $response->assertJsonValidationErrors([
            'image_url'
        ]);

        $this->assertDatabaseCount(Movie::TABLE, 0);
    }

    /** @test */
    public function request_should_fail_when_a_movie_image_url_is_not_a_valid_url()
    {
        $response = $this->postJson('api/movies', [
            'title'       => $this->movieTitle,
            'rating'      => $this->movieRating,
            'description' => $this->movieDescription,
            'image_url'   => $this->faker->sentence,
        ]);

        $response->assertJsonValidationErrors([
            'image_url'
        ]);

        $this->assertDatabaseCount(Movie::TABLE, 0);
    }
}
