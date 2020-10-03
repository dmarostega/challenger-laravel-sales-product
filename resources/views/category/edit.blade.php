
@extends('_layouts.template')

@section('subtitle','Creating Category')

@section('content')
    <div class="row">
        <div class="col-6 mt-5 mb-3">
            <h1>@yield('subtitle')</h1>
        </div>        
    </div>
    <form action="{{ route('category.update',['category' => $category->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Name" value="{{ $category->name }}">            
            @error('name')
            <small class="alert text-danger">{{ $message }}</small>
            @enderror
        </div> <div class="row justify-content-end">
            <div class="btn-group mr-5 mb-3" role="group" aria-label="Basic example">
                <button class="btn btn-success" type="submit">Save</button>
                <a class="btn btn-secondary" href="{{ route('category.index') }}">To List</a>
            </div>
        </div>
    </form>
@endsection