<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Models\Season;
use DB;
use Illuminate\Http\Request;

class EloquentEpisodesRepository implements EpisodesRepository
{
    public function update(Request $request, Season $season)
    {
        return DB::transaction(function () use ($request, $season) {
            $watchedEpisodes = $request->episodes;
            $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
                $episode->watched = in_array($episode->id, $watchedEpisodes);
            });
            $season->push();
            return $season;
        });
    }
}
