<?php

namespace App\Repositories;

use App\Http\Requests\ShowsFormRequest;
use App\Models\Show;

interface ShowsRepository
{
    public function add(ShowsFormRequest $request): Show;
}