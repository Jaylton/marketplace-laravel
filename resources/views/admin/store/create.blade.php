@extends('layouts.app')

@section('content')
<form action="{{route('admin.stores.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1>Criar loja</h1>
    <div class="form-group">
        <label for="">Nome loja</label>
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
        <input type="text" name="description" id="" value="{{old('description')}}"
            class="form-control @error('description') is-invalid @enderror">
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Telefone</label>
        <input type="text" name="phone" id="" value="{{old('phone')}}"
            class="form-control @error('phone') is-invalid @enderror">
        @error('phone')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Celular</label>
        <input type="text" name="mobile_phone" value="{{old('mobile_phone')}}" id=""
            class="form-control @error('mobile_phone') is-invalid @enderror">
        @error('mobile_phone')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Imagens</label>
        <input name="logo" type="file" class="form-control">
        @error('logo')
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
