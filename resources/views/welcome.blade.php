@extends('layouts.front')
@section('content')
<div class="row" style="margin-bottom: 25px">
    @foreach ($products as $key => $item)
    <div class="col-md-4">
        <div class="card" style="max-width: 100%">
            @if ($item->photos->count())
            <img src="{{asset('storage/'.$item->photos->first()->image)}}" class="card-img-top">
            @else

            <img src="{{asset('assets/no-photo.jpg')}}" class="card-img-top">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{$item->name}}</h2>
                <p class="card-text">{{$item->description}}</p>
                <h3>
                    R$ {{number_format($item->price, '2', ',', '.')}}
                </h3>
                <a href="{{route('product.single', ['slug' => $item->slug])}}" class="btn btn-success">
                    Ver produto
                </a>
            </div>
        </div>
    </div>
    @if (($key + 1) % 3 == 0)
</div>
<div class="row" style="margin-bottom: 25px">
    @endif
    @endforeach
</div>
<div class="row">
    <div class="col-md-12">
        <h2>Lojas destaques</h2>
        <hr>
    </div>
    @foreach ($stores as $store)
    <div class="col-md-4">
        @if ($store->logo)
        <img src="{{asset('storage/'.$store->logo)}}" alt="Logo loja {{$store->name}}" class="img-fluid">
        @else
        <img src="https://via.placeholder.com/600X300.png?text=logo" alt="Loja sem logo" class="img-fluid">
        @endif
        <h3>{{$store->name}}</h3>
        <p>{{$store->description}}</p>
        <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-link">Ver loja</a>
    </div>
    @endforeach
</div>
@endsection
