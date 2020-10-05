@extends('_layouts.template')

@section('subtitle','Orders')

@section('content')  
    <div class="row">
        <div class="col-6 mt-5">
            <h1>@yield('subtitle')</h1>
            <p class="ml-1">
                Viewing
                @if($orders->hasMorePages())
                    {{ $orders->count() }}  
                @else
                    {{$orders->total()  }} 
                @endif
                    to  {{ $orders->total() }}    
            </p>            
        </div>
        <div class="col-6 mt-5">
            <a class="btn btn-primary float-right" href="{{ route('order.create') }}" >New Order</a>          
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
                        <th scope="col">{{ __('Order') }}</th>
                        <th scope="col">{{ __('Cart') }}</th>
                        <th scope="col">{{ __('Date') }}</th>
                        <th scope="col">{{ __('Value') }}</th>                       
                        <th scope="col"></th>
                    </tr>
                </thead> 
                {{-- <tfoot>
                    <tr>
                        <th colspan="5">
                            <small>Quantity</small>
                            @if($orders->hasMorePages())
                                {{ $orders->count() }} to 
                            @endif
                                {{ $orders->total() }}    
                        </th>
                    </tr>
                </tfoot>                   --}}
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td >{{ $order->id }}</td>
                        <td >{{ $order->cart_id }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
                        <td >{{ number_format($order->Cart()->first()->TotalValue(),2,',','.') }}</td>
                        <td>
                            <div class="float-right">
                                <a class="btn btn-sm btn-secondary" href="{{ route('order.show',['order'=>$order->id]) }}" title="View details this Order">View</a>                                    
                                <form style="display: inline-block" action="{{ route('order.destroy',['order'=>$order->id]) }}" method="post" >
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="order" value="{{$order->id }}">
                                    <input class="btn btn-sm btn-danger" type="submit" value="X" title="Remove this Order">
                                </form> 
                            </div>
                        </td>
                    </tr>
                    @endforeach                               
                </tbody>
            </table>            
            {{ $orders->links() }}             
        </div>
    </div>
@endsection