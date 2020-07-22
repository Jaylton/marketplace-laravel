@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{route('admin.notification.read.all')}}" style="margin: 5px 0;" type="submit"
            class="btn btn-success">Marcar
            todas com lidas</a>
    </div>
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Notificação </th>
                    <th>Criada em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $n)
                <tr>
                    <td>{{$n->data['message']}}</td>
                    <td>{{$n->created_at->locale('pt')->diffForHumans()}}</td>
                    <td>
                        <button href="{{route('admin.notification.read.noti', ['id'=> $n->id])}}"
                            class="btn btn-primary">Marcar como
                            lida</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
