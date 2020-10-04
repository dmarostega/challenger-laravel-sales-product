
@extends('_layouts.template')

@section('subtitle','Viewing Order')

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
                    <h5 class="card-title">Order {{ $order->id }}</h5>
                    <p class="card-text"><strong>Total Value </strong>{{ number_format($order->Cart()->first()->TotalValue(),2,',','.') }} </p>
                    <div class="row">
                        <div class="col-12">
                            <h6> Itens</h6>
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Value</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->Cart()->first()->Itens()->get() as $item)
                                    @php
                                    $product = $item->Product()->first();     
                                    @endphp
                                    <tr>
                                        <td>{{ $product->id .', '.$product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{  number_format($product->price ,2,',','.')  }}</td>
                                        <td>{{ number_format($product->price * $item->quantity,2,',','.')  }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <p class="card-text"><strong>Price </strong>{{ $product->price }}</p>
                    <p class="card-text"><strong>Quantity in Stock </strong>{{ $product->quantity }}</p>
                    <p class="card-text"><strong>Category </strong>{{ $category->name }}</p> --}}

                </div>               
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">
                            <small>Date {{ date('d/m/Y H:i:s', strtotime($order->created_at) ) }} </small>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>              
    </div>
   <div class="row justify-content-center ">
       <div class="col-6  mb-3">
            <form style="display: inline-block" action="{{ route('order.destroy',['order'=>$order->id]) }}" method="post">
                @csrf
                @method('delete')
                <input type="hidden" name="order" value="{{$order->id }}">
                <input class="btn btn-sm btn-danger" type="submit" value="Remove">
            </form> 
           <a href="{{ route('order.index') }}" class="btn btn-sm btn-secondary float-right"> Back </a>
       </div>
   </div>
@endsection