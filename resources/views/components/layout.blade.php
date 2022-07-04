<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="{{route('shows.index')}}" class="navbar-brand">Home</a>

            @auth
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="btn btn-link">
                    Sair
                </button>
            </form>
            @endauth

            @guest
            <a href="{{route('login')}}" class="me-2">Entrar</a>
            @endguest
        </div>
    </nav>
    <div class="container">
        <h1>{{$title}}</h1>

        @isset($successMessage)
        <div class="alert alert-success">
            {{$successMessage}}
        </div>
        @endisset

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{$slot}}
    </div>

</body>

</html>