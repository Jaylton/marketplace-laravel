@extends('layouts.app')

@section('content')
<form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="POST">
    @csrf
    @method('PUT')
    <h1>Editar categoria</h1>
    <div class="form-group">
        <label for="">Nome categoria</label>
        <input type="text" name="name" id="" value="{{$category->name}}"
            class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror"
            value="{{$category->description}}">
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
