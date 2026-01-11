<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryShowController extends Controller
{
    /**
     * Show all categories with status = 1 (active)
     */
    public function index()
    {
        $categories = Category::where('status', 1)->with(['products' => function ($query) {
            $query->where('status', 1);
        }])->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show single category and its products (both in stock and out of stock)
     */
    public function show(Category $category)
    {
        if ($category->status != 1) {
            abort(404);
        }

        $category->load('products');

        return view('categories.show', compact('category'));
    }
}
