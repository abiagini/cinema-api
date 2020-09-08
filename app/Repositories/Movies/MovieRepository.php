<?php


namespace App\Repositories\Movies;


use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

interface MovieRepository
{
    public function all(): Collection;

    public function find(int $id): ?Movie;

    public function save(Movie $movie): void;

    public function delete(Movie $movie): void;
}
