<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartHasProducts;
use App\Helpers\Log;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function addProduct(Request $request, Cart $cart){

        $validator = Validator::make($request->all(), [
            'product_id' => ['required','integer'],
            'quantity' => ['required','integer']
        ]);

        if($validator->fails()){
            return redirect()->route('order.create')
                            ->withErrors($validator)
                            ->with(['cart' => $cart,
                            'product_id' => $request->product_id,
                            'quantity' => $request->quantity,
                            'products' => Product::all()]);
        }

        $quantity_availabilly =  Product::where('id','=',$request->product_id)->first()->quantity;

        if($request->quantity  > $quantity_availabilly){
            return redirect()->route('order.create')
                            ->with(['cart' => $cart,
                            'product_id' => $request->product_id,
                            'quantity' => $request->quantity,
                            'products' => Product::all()])->withErrors(['quantity' => 'Unavailable Quantity. Availability of only: ' . $quantity_availabilly]);
        }

        //1. se já tem item adicionado no carrinho... 
        $new_item = CartHasProducts::where('product_id','=',$request->product_id)->where('cart_id','=',$cart->id)->first();
    
        if($new_item ===null){
            $new_item = new CartHasProducts();
        }
    
        $new_item->cart_id = $cart->id;
        $new_item->product_id = $request->product_id;
        //2. ... Atribui a quantidade
        $new_item->quantity = $request->quantity;
        $new_item->save();

        Log::add($new_item->Product()->first());
       // Log::in("CART[{$cart->id}]", "Adicionou produto  " .  $new_item->Product()->first()->name);

            return redirect()->route('order.create')
                    ->with([
                            'cart' => $cart,
                            'product_id' => $request->product_id,
                            'quantity' => $request->quantity,
                            'products' => Product::all()
                        ]);
    }

    public function removeProduct(Request $request, CartHasProducts $cartHasProducts){
        $cart = $cartHasProducts->Cart()->first();
        $cartHasProducts->delete();

        Log::remove($cartHasProducts->Product()->first(), 'name');

        return redirect()->route('order.create')
                                ->with([
                                    'cart' => $cart,
                                    'products' => Product::all()]
                                );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        redirect()->route('order.index')->with(['fail', 'Action disabled!']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        redirect()->route('order.index')->with(['fail', 'Action disabled!']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        redirect()->route('order.index')->with(['fail', 'Action disabled!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        redirect()->route('order.index')->with(['fail', 'Action disabled!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        redirect()->route('order.index')->with(['fail', 'Action disabled!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        redirect()->route('order.index')->with(['fail', 'Action disabled!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        redirect()->route('order.index')->with(['fail', 'Action disabled!']);        
    }
}
