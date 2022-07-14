@component('mail::message')
# {{$showName}} criada

A série {{$showName}} com {{$seasons}} temporadas e {{$episodesPerSeason}} episódios por temporada foi criada.

Acesse aqui:
@component('mail::button', ['url' => route('seasons.index', $showId)])
Ver série
@endcomponent
@endcomponent
