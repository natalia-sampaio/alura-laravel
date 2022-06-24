<x-layout title="{{__('messages.app_name')}}">
    <a href="{{route('shows.create')}}" class="btn btn-dark mb-2">Adicionar</a>

    @isset($successMessage)
    <div class="alert alert-success">
        {{$successMessage}}
    </div>
    @endisset

    <ul class="list-group">
        @foreach ($shows as $show)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{route('seasons.index', $show->id)}}">
                {{$show->name}}
            </a>
            <span class="d-flex">
                <a href="{{route('shows.edit', $show->id)}}" class="btn btn-outline-secondary btn-sm me-2">
                    Editar
                </a>
                <form action="{{route('shows.destroy', $show->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">
                        X
                    </button>
                </form>
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>