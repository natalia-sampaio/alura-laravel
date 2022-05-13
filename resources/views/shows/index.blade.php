<x-layout title="Séries">
    <a href="{{route('shows.create')}}" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach ($shows as $show)
        <li class="list-group-item">{{$show->name}}</li>
        @endforeach
    </ul>
</x-layout>