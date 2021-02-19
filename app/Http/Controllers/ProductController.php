<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(string $categorySlug = null)
    {

        $category = Category::where("slug", $categorySlug)->firstOrFail();

        $products = Product::where('category_id', $category->id)->get();


        return view('pages/product/product-list', compact("products", "category" ));
    }

    public function show(string $id)
    {

    }
}
