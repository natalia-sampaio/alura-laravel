<?php

namespace App\Providers;

use App\Repositories\EloquentShowsRepository;
use App\Repositories\ShowsRepository;
use Illuminate\Support\ServiceProvider;

class ShowsRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        ShowsRepository::class => EloquentShowsRepository::class
    ];
}
