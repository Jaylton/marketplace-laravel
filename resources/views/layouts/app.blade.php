<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos laravel 6</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 20px;">
        <a class="navbar-brand" href="{{route('home')}}">MarketPlace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
                    <a class="nav-link" href="{{route('admin.orders.index')}}">Pedidos</a>
                </li>
                <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                    <a class="nav-link" href="{{route('admin.stores.index')}}">Loja <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                </li>
                <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                </li>
            </ul>
            <div class=" my-2 my-lg-0">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <span class="nav-link">
                            {{auth()->user()->name}}
                        </span>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.notification.index')}}" class="nav-link">
                            <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                            <i class="fa fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="cursor: pointer;"
                            onclick="event.preventDefault() ;document.querySelector('form.logout').submit();">Sair</a>
                        <form style="display: none;" action="{{route('logout')}}" class="logout" method="POST">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
</body>

</html>
