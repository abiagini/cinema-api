<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movies\StoreRequest;
use App\Http\Requests\Movies\UpdateRequest;
use App\Models\Movie;
use App\Repositories\Movies\MovieRepository;
use Illuminate\Http\Request;

final class MovieController extends Controller
{
    protected $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json($this->repository->all(), 200);
    }

    public function store(StoreRequest $request)
    {
        $movie = new Movie($request->validated());

        $this->repository->save($movie);

        return response()->json($movie, 201);
    }

    public function update(Movie $movie, UpdateRequest $request)
    {
        $movie->fill($request->validated());

        $this->repository->save($movie);

        return response()->json(null, 204);
    }
}
