<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Helpers\Log;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index',[
            'products' => Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:191'],
            'price' => ['required'],
            'quantity' => ['required','integer'],
            'category_id' => ['required','integer']
        ]);

        $product = new Product();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;

       
        if($product->save()){
            Log::create($product);
            return redirect()->route('product.index')->with(['success' =>'Produto salvo com sucesso!']);
        }
        return redirect()->route('product.index')->with(['fail' =>'Ocorreu algum erro ao tentar Salvar!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show',[
            'product' => $product,
            'category' => $product->Category()->withTrashed()->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // dd($product->category_id);

        return view('product.edit',[
            'product' => $product,
            'categories' => Category::all()//->whereNull('deleted_at')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Product $product)
    {  
        
        $request->validate([
            'name' => ['required', 'max:191'],
            'price' => ['required'],
            'quantity' => ['required','integer'],
            'category_id' => ['required','integer']
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;

    
        if($product->save()){
            Log::edit($product);
            return redirect()->route('product.index')->with(['success' =>'Produto salvo com sucesso!']);
        }
        return redirect()->route('product.index')->with(['fail' =>'Ocorreu algum erro ao tentar Salvar!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()){
            Log::remove($product);
            return redirect()->route('product.index')->with(['success' =>'Categoria Removida com Sucesso!']);
        }
        return redirect()->route('product.index')->with(['fail' =>'Impossível remover categoria {$product->name}!']);  
    }
}
