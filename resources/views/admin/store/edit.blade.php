@extends('layouts.app')

@section('content')
<form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1>Criar loja</h1>
    <div class="form-group">
        <label for="">Nome loja</label>
        <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror"
            value="{{$store->name}}">
        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Descrição</label>
        <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror"
            value="{{$store->description}}">
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Telefone</label>
        <input type="text" name="phone" id="" class="form-control" value="{{$store->phone}}">
        @error('phone')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Celular</label>
        <input type="text" name="mobile_phone" id="" class="form-control" value="{{$store->mobile_phone}}">
        @error('mobile_phone')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Logo</label>
        <p>
            <img src="{{asset('storage/'.$store->logo)}}" width="300" alt="">
        </p>
        <input name="logo" type="file" class="form-control @error('logo') is-invalid @enderror">
        @error('logo')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Atualizar</button>
    </div>
</form>
@endsection
