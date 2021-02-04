<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
</head>
<body>
    @section("menu")
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="{{ $page == "Главная" ? "nav-link active"  : "nav-link" }}" href="{{url('/topic')}}">Главная</a>
                <a class="{{ $page == "Добавление нового раздела" ? "nav-link active"  : "nav-link" }}" href="{{url('topic/create')}}">Разделы</a>
                <a class="{{ $page == "Добавить новый блок" ? "nav-link active"  : "nav-link" }}" href="{{url('block/create')}}">Управление контентом</a>
                {{-- <a class="nav-link" href="{{url('create')}}">Управление контентом</a> --}}
            </div>
        </div>
    </nav>
    @show
    <div class="container col-12">
        @yield('content')
    </div>

</body>
</html>
