
@extends('_layouts.template')

@section('subtitle','New Order')

@section('content')
    <div class="row">
        <div class="col-6 mt-5 mb-3">
            <h1>@yield('subtitle')</h1>
        </div>        
    </div>    
    @if(session('cart')) 
     @php
        $cart = session('cart');         
     @endphp
    @endif
    <form action="{{ route('cart.add',['cart'=>$cart->id]) }}" method="post">
        @csrf
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select id="product_id" class="custom-select" name="product_id">
                                <option value="">Select</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" @if(session('product_id') == $product->id) selected @endif >{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')                            
                                <small class="alert text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input class="form-control" type="number" name="quantity" value="{{ session('quantity') }}">                            
                            @error('quantity')                            
                                <small class="alert text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success mr-5"><small>Add on Cart</small></button>
            </div>
        </div>
    </form>

        <div class="card">
            <div class="card-header">
                <h5>Itens</h5>
            </div>
            <div class="card-body">
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>Code</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>SubTotal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sum = 0;
                            $qdt_total = 0;    
                        @endphp
                        @if(isset($cart))
                            @foreach($cart->Itens()->get() as $item)                              
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{  $item->Product()->first()->name }}
                                    </td>
                                    <td>
                                        {{ $item->quantity }}
                                        @php
                                           $qdt_total += $item->quantity;
                                        @endphp
                                    </td>
                                    <td>
                                        {{  number_format($item->Product()->first()->price,2,',','.') }}
                                    </td>
                                    <td>
                                        {{  number_format($item->Product()->first()->price *  $item->quantity,2,',','.')  }} 
                                        @php
                                            $sum += $item->Product()->first()->price *  $item->quantity;
                                        @endphp
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            {{-- <a class="btn btn-sm btn-secondary" href="{{ route('cart.view',['cart'=>$item->id]) }}">View</a> --}}
                                            <form style="display: inline-block" action="{{ route('cart.remove.item',['cartHasProducts'=>$item->id ]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="order" value="{{$cart->id }}">
                                                <input class="btn btn-sm btn-danger" type="submit" value="Remove">
                                            </form> 
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-9 align-self-center">
                        {{-- <a href="{{ route('order.finalize') }}" class="btn btn-primary">Finalizar Compra</a> --}}
                        <form action="{{ route('order.store') }}" method="post" >
                            @csrf                            
                            <button type="submit" class="btn btn-primary" >Check Out</button>
                        </form>
                    </div>                    
                    <div class="col-3 ">
                        <div class="row">
                            <div class="col text-center align-middle" style=" font-size: 1.3em; font-weigth: bold;border: 1px solid #ddd">
                                This Order 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                Quantity
                            </div>
                            <div class="col-6">
                                {{ $qdt_total }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                Total Value
                            </div>
                            <div class="col-6">
                                {{ number_format($sum,2,',','.') }}
                            </div>
                        </div>
                    </div>
                </div>                               
            </div> 
        </div>
@endsection