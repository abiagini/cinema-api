<?php


namespace App\Repositories\Movies;


use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

class EloquentMovieRepository implements MovieRepository
{

    public function all(): Collection
    {
        return Movie::all();
    }

    public function find(int $id): ?Movie
    {
        return Movie::find($id);
    }

    public function save(Movie $movie): void
    {
        $movie->save();
    }

    public function delete(Movie $movie): void
    {
        try {
            $movie->delete();
        } catch (\Exception $e) {
        }
    }
}
