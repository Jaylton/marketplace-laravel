@extends('layouts.app')

@section('content')
<form action="{{route('admin.categories.store')}}" method="POST">
    @csrf
    <h1>Criar categoria</h1>
    <div class="form-group">
        <label for="">Nome categoria</label>
        <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror"
            value="{{old('name')}}">
        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror"
            value="{{old('description')}}">
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Enviar</button>
    </div>
</form>
@endsection
