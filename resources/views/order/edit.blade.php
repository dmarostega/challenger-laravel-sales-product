
@extends('_layouts.template')

@section('subtitle','Creating Product')

@section('content')
    <div class="row">
        <div class="col-6 mt-5 mb-3">
            <h1>@yield('subtitle')</h1>
        </div>        
    </div>
    <form action="{{ route('product.update',['product' => $product->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Name" value="{{ $product->name }}">            
            @error('name')
                <small class="alert text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="text" name="price" placeholder="Price" value="{{ $product->price }}">             
            @error('price')
                <small class="alert text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control" type="number" name="quantity" placeholder="Quantity" value="{{ $product->quantity }}">            
            @error('quantity')
                <small class="alert text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" class="custom-select" name="category_id">                
                <option>Select</option>
                @foreach($categories as $category)
                   <option value="{{ $category->id }}"  @if($category->id === $product->Category()->first()->id) selected @endif    >{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <small class="alert text-danger">{{ $message }}</small>
            @enderror
        </div>
       <div class="row justify-content-end">
            <div class="btn-group mr-5 mb-3" role="group" aria-label="Basic example">
                <button class="btn btn-success " type="submit">Save</button>
                <a class="btn btn-secondary " href="{{ route('product.index') }}">To List</a>
            </div>
        </div>
    </form>
@endsection