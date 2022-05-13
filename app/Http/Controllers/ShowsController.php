<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowsController extends Controller
{
    public function index()
    {
        $shows = Show::query()->orderBy('name')->get();

        return view('shows.index')->with('shows', $shows);
    }

    public function create()
    {
        return view('shows.create');
    }

    public function store(Request $request)
    {
        $showName = $request->input('name');
        $show = new Show();
        $show->name = $showName;
        $show->save();

        return redirect('/shows');
    }
}
