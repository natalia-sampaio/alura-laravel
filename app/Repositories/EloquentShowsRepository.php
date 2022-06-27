<?php

namespace App\Repositories;

use App\Http\Requests\ShowsFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Show;
use DB;

class EloquentShowsRepository implements ShowsRepository
{
    public function add(ShowsFormRequest $request): Show
    {
        return DB::transaction(function () use ($request) {
            $show = Show::create($request->all());
            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'show_id' => $show->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);

            $episodes = [];
            foreach ($show->seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j,
                    ];
                }
            }
            Episode::insert($episodes);

            return $show;
        });
    }
}