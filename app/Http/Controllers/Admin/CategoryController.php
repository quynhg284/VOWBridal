<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $categories = Category::all();
        view()->share(['categories' => $categories]);   
    }
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.category-list', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.category.category-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = ($request->status === 'active') ? 1 : 0;
        
        $category = Category::create(
            [ 'name' => $request->name,
              'image' => $request->image,
              'status' => $status
            ]
        );
        if($category) 
            return redirect()->route('admin.category.index');
        else
        return back();
    }

    /**
     * Display the specified resource.
     */
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        
        return view('admin.category.category-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $status = ($request->status === 'active') ? 1 : 0;
        
        $category->update([
            'name' => $request->name,
            'image' => $request->image,
            'status' => $status
        ]);     
        if($category) 
            return redirect()->route('admin.category.index');
        else 
            return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        if($category) 
            return redirect()->route('admin.category.index');
        else 
            return back();
    }
    public function show(Category $category)
    {
        //
    }

}
