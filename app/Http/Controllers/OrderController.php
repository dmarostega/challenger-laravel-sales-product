<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use App\User;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index',[
            'orders' => Order::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cart = Cart::where('user_id','=',Auth::user()->id)
                           ->whereNull('done')->first();
        
        if($cart === null){
            $cart = new Cart();
            $cart->user_id = User::find(    Auth::user()->id  )->first()->id;
            $cart->save();
        }        

        return view('order.create',[
            'products' => Product::where('quantity','>',0)->get()
        ])->with(['cart'=> $cart]);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $cart = Cart::where('user_id','=',Auth::user()->id)
                ->whereNull('done')->first();

        if($cart !== null)    {
            $order = new Order();
            $order->cart_id = $cart->id;
            $order->user_id = $cart->user_id;
            $order->save();

            foreach($cart->Itens()->get() as $item){
               $product = Product::where('id','=',$item->product_id)->first();
               $product->quantity -= $item->quantity;
               $product->save();
            }            

            $cart->done = Carbon::now();
            $cart->save();
            
            Mail::to($request->user())->send(new OrderShipped($order));

            return redirect()->route('order.index');
        }

         return redirect()->route('order.create')->withErros(['fail'=>'Não foi possível gerar o Pedido!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $itens = $order->Cart()->first()->Itens()->get('product_id');
        $products = DB::table('products')->whereIn('id', $itens)->get();   

        return view('order.show',[
            'order' => $order,           
            'products' => $products
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if($order->Cart()->first()->user_id === Auth::user()->id){
            $cart = $order->Cart()->first();

            foreach(  $cart->Itens()->get() as $item){
                $product = Product::where('id','=',$item->product_id)->first();
                $product->quantity += $item->quantity;
                $product->save();
             }   

            $order->delete();
            return redirect()->route('order.index')->with(['success'=>"Ordem n. {$order->id} excluída com sucesso!"]);
        }
        return redirect()->route('order.index')->with(['fail'=>'Excusão não permitda!']);
    }
}
