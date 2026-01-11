<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
     public function __construct()
    {
        $products = Product::all();
        $categories = Category::all();
        view()->share(['products' => $products, 'categories' => $categories]);   
    }
    public function index()
    {
         $products = Product::all();
        return view('admin.product.product-list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.product-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $status = ($request->status === 'active') ? 1 : 0;
        $price = str_replace(['.', ','], '', $request->price);
            $idcategory = $request->filled('idcategory') ? (int) $request->idcategory : 0;

                 $product = Product::create(
                        [ 'title' => $request->title,
                            'image' => $request->image,
                            'content' => $request->content,
                            'description' => $request->description,
                            'price' => $price,
                            'status' => $status,
                            'idcategory' => $idcategory
                        ]
                );
        if($product) 
            return redirect()->route('admin.product.index');
        else
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
         return view('admin.product.product-edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $status = ($request->status === 'active') ? 1 : 0;
        $price = str_replace(['.', ','], '', $request->price);
            $idcategory = $request->filled('idcategory') ? (int) $request->idcategory : 0;

        $product->update([
             'title' => $request->title,
              'image' => $request->image,
              'content' => $request->content,
              'description' => $request->description,
              'price' => $price,
              'status' => $status,
              'idcategory' => $idcategory
        ]);     
        if($product) 
            return redirect()->route('admin.product.index');
        else 
            return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        if($product) 
            return redirect()->route('admin.product.index');
        else 
            return back();
    }
}
