<x-layout title="Editar série '{!!$show->name!!}'">

    <form action="{{route('shows.update', $show->id)}}" method="POST">
        @csrf

        @if($update)
        @method('PUT')
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$show->name}}" :update="true">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</x-layout>