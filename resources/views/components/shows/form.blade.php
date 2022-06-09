<form action="{{$action}}" method="POST">
    @csrf

    @if($update)
    @method('PUT')
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Nome:</label>
        <input 
        type="text" 
        name="name" 
        id="name" 
        class="form-control" 
        @isset($name)value="{{$name}}"@endisset>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>