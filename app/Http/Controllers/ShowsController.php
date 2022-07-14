<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowsFormRequest;
use App\Mail\ShowCreated;
use App\Models\Show;
use App\Models\User;
use App\Repositories\ShowsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $show = $this->repository->add($request);
        
        $userList = User::all();
        foreach ($userList as $user) {
            $email = new ShowCreated(
                $show->name,
                $show->id,
                $request->seasonsQty,
                $request->episodesPerSeason,
            );
            Mail::to($user)->send($email);
            sleep(2);
        }

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
