@extends('layouts.front')
@section('content')
<div class="row" style="margin-bottom: 25px">
    <div class="col-md-12">
        <h2>{{$store->name}}</h2>
        <hr>
    </div>
    <div class="col-md-12">
        <h3>Produtos</h3>
    </div>
    @if ($store->products->count())
    @foreach ($store->products as $key => $item)
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
    @else
    <div class="col-md-12">
        <h3 class="alert alert-warning">
            Nenhum produto encontrado para esta loja...
        </h3>
    </div>
    @endif
</div>
@endsection
