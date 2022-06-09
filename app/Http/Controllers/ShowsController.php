<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;

class ShowsController extends Controller
{
    public function index(Request $request)
    {
        $shows = Show::query()->orderBy('name')->get();
        $successMessage = $request->session()->get('success.message');
        
        return view('shows.index')
            ->with('shows', $shows)
            ->with('successMessage', $successMessage);
    }

    public function create()
    {
        return view('shows.create');
    }

    public function store(Request $request)
    {
        $show = Show::create($request->all());

        return to_route('shows.index')
            ->with('success.message', "Série '{$show->name}' adicionada com sucesso");
    }

    public function edit(Show $show)
    {
        return view('shows.edit', ['show' => $show]);
    }

    public function update(Show $show, Request $request)
    {
        $name = $request->input('name');
        $show->update(['name' => $name]);

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
