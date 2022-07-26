<?php

namespace App\Http\Controllers;

use App\Events\ShowCreated as EventsShowCreated;
use App\Http\Requests\ShowsFormRequest;
use App\Jobs\DestroyCoverImage;
use App\Models\Show;
use App\Repositories\ShowsRepository;
use Illuminate\Http\Request;

class ShowsController extends Controller
{
    public function __construct(private ShowsRepository $repository)
    {
        $this->middleware('auth')->except('index');
    }
    
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
        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('shows_covers', 'public')
            : null;
        $request->coverPath = $coverPath;
        $show = $this->repository->add($request);
        EventsShowCreated::dispatch (
            $show->name,
            $show->id,
            $request->seasonsQty,
            $request->episodesPerSeason
        );

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
        DestroyCoverImage::dispatch($show->cover);

        return to_route('shows.index')
            ->with('success.message', "Série '{$show->name}' removida com sucesso");
    }
}
