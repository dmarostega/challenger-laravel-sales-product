
@extends('_layouts.template')

@section('subtitle','Viewing Product')

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
                    <h5 class="card-title">Product</h5>
                    <p class="card-text"><strong>Name </strong>{{ $product->name }}</p>
                    <p class="card-text"><strong>Price </strong>{{ $product->price }}</p>
                    <p class="card-text"><strong>Quantity in Stock </strong>{{ $product->quantity }}</p>
                    <p class="card-text"><strong>Category </strong>{{ $category->name }}</p>

                </div>               
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <small>Created {{ date('d/m/Y', strtotime($product->created_at) ) }} </small>
                        </div>
                        <div class="col-6">
                            <small class="float-right">Updated  {{ date('d/m/Y', strtotime($product->updated_at) ) }} </small>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>              
    </div>
   <div class="row justify-content-center ">
       <div class="col-6  mb-3">
           <a href="{{ route('product.index') }}" class="btn btn-sm btn-secondary float-right"> Back </a>
       </div>
   </div>
@endsection