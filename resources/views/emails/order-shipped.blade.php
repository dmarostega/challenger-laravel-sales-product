@include('_layouts.defines')

@push('styles')
<style>
    body{
        color: red;
        font-size: 1.6em;
    }
</style>
@endpush

<!document html>
<html lang="pt-br">
    <head>
        <title>@yield('title')</title>
        @stack('styles')
        @stack('metas')
       
    </head>
    <body>  
        <div class="container py-4">
            <div class="row justify-content-center">
            <div class="col-6 justify-content-center">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">New Order n.{{ $order->id }}</h3>
                        <p class="card-text"><strong>Total Value </strong>{{ number_format($order->Cart()->first()->TotalValue(),2,',','.') }} </p>
                        <div class="row">
                            <div class="col-12">
                                <h4> Itens</h4>
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
                                            <td style="text-align: center">{{ $item->quantity }}</td>
                                            <td>{{  number_format($product->price ,2,',','.')  }}</td>
                                            <td>{{ number_format($product->price * $item->quantity,2,',','.')  }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>              
                    <br><hr><br> 
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
        </div>
        @stack('scripts')
    </body>
</html>