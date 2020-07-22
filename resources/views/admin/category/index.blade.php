@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{route('admin.categories.create')}}" style="margin: 5px 0;" type="submit"
            class="btn btn-success">Cadastrar novo</a>
    </div>
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->name}}</td>
                    <td>
                        <a href="{{route('admin.categories.edit', ['category' => $c->id])}}" type="submit"
                            class="btn btn-warning">Editar</a>
                        <form style="float: left;margin-right: 5px;"
                            action="{{route('admin.categories.destroy', ['category' => $c->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12" style="text-align: center;display: grid;justify-items: center;">
        {{$categories->links()}}
    </div>
</div>
@endsection