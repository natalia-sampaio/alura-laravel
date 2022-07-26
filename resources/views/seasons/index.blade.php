<x-layout title="Temporadas de {!!$show->name!!}">
    <div class="d-flex justify-center">
        <img 
            src="{{$show->cover ? asset('storage/' . $show->cover) : asset('storage/shows_covers/no-image-available.png')}}" 
            alt="Capa da série" 
            class="img-fluid"
            style="height:400px"
        >
    </div>
    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{route('episodes.index', $season->id)}}">
                Temporada {{$season->number}}
            </a>

            <span class="badge bg-secondary">
                {{$season->numberOfWatchedEpisodes()}} / {{$season->episodes->count()}}
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>