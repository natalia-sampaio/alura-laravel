<?php

namespace App\Http\Controllers;

use App\Models\Show;

class SeasonsController extends Controller
{
    public function index(Show $show)
    {
        $seasons = $show->seasons()->with('episodes')->get();
        return view('seasons.index')->with('seasons', $seasons)->with('show', $show);
    }
}
