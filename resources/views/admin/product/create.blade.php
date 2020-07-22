@extends('layouts.app')

@section('content')
<form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1>Criar produto</h1>
    <div class="form-group">
        <label for="">Nome produto</label>
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
        <label for="">Conteúdo</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name="body">{{old('body')}}</textarea>
        @error('body')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Categoria</label>
        <select name="categories[]" id="" multiple class="form-control @error('categories') is-invalid @enderror">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        @error('categories')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Preço</label>
        <input type="number" name="price" id="" class="form-control @error('price') is-invalid @enderror"
            value="{{old('price')}}">
        @error('price')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Imagens</label>
        <input name="photos[]" multiple type="file" class="form-control @error('photos.*') is-invalid @enderror">
        @error('photos.*')
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
