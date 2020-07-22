@extends('layouts.front')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Meus Pedidos</h2>
        <hr>
    </div>
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse ($orders as $key => $order)
            <div class="card">
                <div class="card-header" id="nr_{{$key}}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapse_{{$key}}" aria-expanded="true" aria-controls="collapse_{{$key}}">
                            Pedido nº: {{$order->reference}}
                        </button>
                    </h2>
                </div>

                <div id="collapse_{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="nr_{{$key}}"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            @foreach (unserialize($order->itens) as $item)
                            <li>{{$item['name']}} | R$ {{number_format($item['price'] * $item['amount'], 2, ',', '.')}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @empty
            <h3 class="alert alert-warning">Nenhum resultado encontrado</h3>
            @endforelse
        </div>
    </div>
    <div class="col-md-12" style="text-align: center;display: grid;justify-items: center;">
        <hr>
        {{$orders->links()}}
    </div>
</div>
@endsection
