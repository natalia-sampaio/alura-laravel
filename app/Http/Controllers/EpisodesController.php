<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Repositories\EpisodesRepository;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function __construct(private EpisodesRepository $repository)
    {
    }

    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'successMessage' => session('success.message')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        $season = $this->repository->update($request, $season);

        return to_route('episodes.index', $season->id)->with('success.message', 'Episódios marcados como assistidos.');
    }
}