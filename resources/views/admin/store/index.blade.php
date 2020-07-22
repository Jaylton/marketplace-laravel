@extends('layouts.app')

@section('content')
<div class="row">
    @if(!$store)
    <div class="col-md-12">
        <a href="{{route('admin.stores.create')}}" style="margin: 5px 0;" type="submit"
            class="btn btn-success">Cadastrar loja</a>
    </div>
    @endif
    <div class="col-md-12">
        @if($store)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Loja</th>
                    <th>Total de produtos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$store->id}}</td>
                    <td>{{$store->name}}</td>
                    <td>{{$store->products->count()}}</td>
                    <td>
                        <a href="{{route('admin.stores.delete', ['store' => $store->id])}}" type="submit"
                            class="btn btn-danger">Excluir</a>
                        <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" type="submit"
                            class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            </tbody>
        </table>
        @else
        Sem loja cadastrada!
        @endif
    </div>
    <!-- <div class="col-md-12" style="text-align: center;display: grid;justify-items: center;">
    </div> -->
</div>
@endsection
