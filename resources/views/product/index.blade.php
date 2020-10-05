@extends('_layouts.template')

@section('subtitle','Products')

@section('content')  
    <div class="row">
        <div class="col-6 mt-5">
            <h1>@yield('subtitle')</h1>
            <p class="ml-1">
                Viewing
                @if($products->hasMorePages())
                    {{ $products->count() }}  
                @else
                    {{$products->total()  }} 
                @endif
                    to  {{ $products->total() }}    
            </p>         
        </div>
        <div class="col-6 mt-5">
            <a class="btn btn-primary float-right" href="{{ route('product.create') }}" >Create</a>
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
                        <th scope="col">{{ __('Code') }}</th>
                        <th class="w-50 "scope="col">Name</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('Quantity') }}</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th class="w-25" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td >{{ $product->id }}</td>
                            <td >{{ $product->name }}</td>
                            <td >{{ number_format($product->price,2,',','.') }}</td>
                            <td >{{ $product->quantity }}</td>
                            <td>{{ date('d/m/Y', strtotime($product->created_at)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($product->updated_at)) }}</td>
                            <td>
                                <div class="float-right">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('product.show',['product'=>$product->id]) }}" title="View details this User">View</a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('product.edit',['product'=>$product->id]) }}" title="Edit this User">Edit</a>
                                    <form style="display: inline-block" action="{{ route('product.destroy',['product'=>$product->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="product" value="{{$product->id }}">
                                        <input class="btn btn-sm btn-danger" type="submit" value="X" title="Remove this Product">
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        {{ $products->links() }}     
                    </tbody>
            </table>
        </div>
    </div>
@endsection