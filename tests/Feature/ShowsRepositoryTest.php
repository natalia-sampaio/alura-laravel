<?php

namespace Tests\Feature;

use App\Http\Requests\ShowsFormRequest;
use App\Repositories\ShowsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowsRepositoryTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created()
    {
        //Arrange
        /** @var ShowsRepository $repository */
        $repository = $this->app->make(ShowsRepository::class);
        $request = new ShowsFormRequest();
        $request->name = 'Nome da serie';
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;

        //Act
        $repository->add($request);

        //Assert
        $this->assertDatabaseHas('shows', ['name' => 'Nome da serie']);
        $this->assertDatabaseHas('seasons', ['number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);
    }
}
