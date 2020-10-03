<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'name' => ['required','max:255']
        ]);

        $category = new Category();

        $category->name = $request->name;

        if($category->save()){
            return redirect()->route('category.index')->with(['success' =>'Categoria salva com sucesso!']);
        }
        return redirect()->route('category.index')->with(['fail' =>'Ocorreu algum erro ao tentar Salvar!']);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show',[
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required','max:255']
        ]);

        $category->name = $request->name;

        if($category->save()){
            return redirect()->route('category.index')->with(['success' =>'Categoria salva com sucesso!']);
        }
        return redirect()->route('category.index')->with(['fail' =>'Ocorreu algum erro ao tentar Salvar Categoria: {$category->name}!']);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      
        if($category->delete()){
            return redirect()->route('category.index')->with(['success' =>'Categoria Removida com Sucesso!']);
        }
        return redirect()->route('category.index')->with(['fail' =>'Impossível remover categoria {$category->name}!']);  

    }
}
