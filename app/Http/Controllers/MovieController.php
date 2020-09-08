<?php

namespace App\Http\Controllers;

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
}
