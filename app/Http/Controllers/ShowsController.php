<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowsFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Show;
use Illuminate\Http\Request;

class ShowsController extends Controller
{
    public function index(Request $request)
    {
        $shows = Show::all();
        $successMessage = $request->session()->get('success.message');
        
        return view('shows.index')
            ->with('shows', $shows)
            ->with('successMessage', $successMessage);
    }

    public function create()
    {
        return view('shows.create');
    }

    public function store(ShowsFormRequest $request)
    {
        $show = Show::create($request->all());
        /* this way I have less queries */
        $seasons = [];
        for($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'show_id' => $show->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($show->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes [] = [
                    'season_id' => $season->id,
                    'number' => $j,
                ];
            }
        }
        Episode::insert($episodes);


        return to_route('shows.index')
            ->with('success.message', "Série '{$show->name}' adicionada com sucesso");
    }

    public function edit(Show $show)
    {
        return view('shows.edit', ['show' => $show]);
    }

    public function update(Show $show, ShowsFormRequest $request)
    {
        $show->fill($request->all());
        $show->save();

        return to_route('shows.index')
        ->with('success.message', "Série '{$show->name}' atualizada com sucesso");
    }

    public function destroy (Show $show)
    {
        $show->delete();

        return to_route('shows.index')
            ->with('success.message', "Série '{$show->name}' removida com sucesso");
    }
}
