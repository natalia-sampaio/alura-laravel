<x-layout title="Edição de título">
    <form action="{{route('shows.update', $show->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$show->name}}">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</x-layout>