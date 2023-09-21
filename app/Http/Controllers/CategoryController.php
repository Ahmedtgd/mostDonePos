<?php

namespace App\Http\Controllers;
use App\Models\Product;
use DB;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); 
        $categories = Category::paginate(5);

        return view('categories.index', compact('categories'));  
    
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories =Category::all();
        return view('categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        $category->save();
         
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
       return view('categories.index', compact('category'));     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        
        return view('categories.edit', compact('category'));    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

        
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
      

        $category->save();
         
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Delete all associated products
    $category->products()->delete(); 
    
    // Delete the category
    $category->delete();

    return redirect()->route('categories.index');
    }
}
