@extends('layouts.app')

@section('content')
<form action="{{route('admin.products.update', ['product' => $product->id])}}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h1>Editar produto</h1>
    <div class="form-group">
        <label for="">Nome produto</label>
        <input type="text" name="name" id="" value="{{$product->name}}"
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
            value="{{$product->description}}">
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Conteúdo</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name="body">{{$product->body}}</textarea>
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
            <option value="{{$category->id}}" {{ $product->categories->contains($category) ? 'selected' : null}}>
                {{$category->name}}
            </option>
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
            value="{{$product->price}}">
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

<hr>
<div class="row">
    @foreach($product->photos as $photo)
    <div class="col-md-4 text-center">
        <img src="{{asset('storage/'.$photo->image)}}" class="image-fluid" width="300">
        <form action="{{route('admin.photo.remove')}}" method="POST" style="position: absolute; top: -9px;left: 10px">
            @csrf
            <input type="hidden" name="photoName" value="{{$photo->image}}">
            <button class="btn btn-danger" style="padding: 2px; line-height: 0.8rem">X</button>
        </form>
    </div>
    @endforeach
</div>
@endsection
