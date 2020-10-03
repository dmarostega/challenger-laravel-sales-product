
@extends('_layouts.template')

@section('subtitle','Viewing Category')

@section('content')
    <div class="row">
        <div class="col-6 mt-5 mb-3">
            <h3>@yield('subtitle')</h3>
        </div>        
    </div>
    <div class="row justify-content-center">
        <div class="col-6 justify-content-center">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Name</h5>
                    <p class="card-text">{{ $category->name }}</p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <small>Created {{ date('d/m/Y', strtotime($category->created_at) ) }} </small>
                        </div>
                        <div class="col-6">
                            <small class="float-right">Updated  {{ date('d/m/Y', strtotime($category->updated_at) ) }} </small>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>              
    </div>
   <div class="row justify-content-center ">
       <div class="col-6  mb-3">
           <a href="{{ route('category.index') }}" class="btn btn-sm btn-secondary float-right"> Back </a>
       </div>
   </div>
@endsection