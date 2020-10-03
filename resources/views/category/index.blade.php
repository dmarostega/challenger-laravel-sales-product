@extends('_layouts.template')

@section('subtitle','Categories')

@section('content')  
    <div class="row">
        <div class="col-6 mt-5">
            <h1>@yield('subtitle')</h1>
        </div>
        <div class="col-6 mt-5">
            <a class="btn btn-primary float-right" href="{{ route('category.create') }}" >Create</a>
        </div>       
    </div>
    @if(    session('success')  )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{ session('success') }}
        </div>
    @endif
    @if(    session('fail')  )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            {{ session('fail') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12 table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th class="w-50 "scope="col">Name</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th class="w-25" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td >{{ $category->id }}</td>
                            <td >{{ $category->name }}</td>
                            <td>{{ date('d/m/Y', strtotime($category->created_at)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($category->updated_at)) }}</td>
                            <td>
                                <div class="float-right">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('category.show',['category'=>$category->id]) }}">View</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('category.edit',['category'=>$category->id]) }}">Edit</a>
                                    <form style="display: inline-block" action="{{ route('category.destroy',['category'=>$category->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="category" value="{{$category->id }}">
                                        <input class="btn btn-sm btn-danger" type="submit" value="Remove">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
@endsection