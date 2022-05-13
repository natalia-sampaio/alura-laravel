<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Phan\AST\TolerantASTConverter\Shim;

use function Sabre\Event\Promise\all;

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
        Show::create($request->all());
    

        return to_route('series.index');
    }
}
