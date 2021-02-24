<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use App\Service\QueryManager;



class ProductController extends Controller
{
    public function index(string $categorySlug, QueryManager $queryManager)
    {
        $orderByQuery = $queryManager->get("orderby", ["price"]);
        $typeQuery = $queryManager->get('type', ['asc', "desc"]);

        $category = Category::where("slug", $categorySlug)->firstOrFail();

        $productQuery = Product::where('category_id', $category->id);

        if($orderByQuery && $typeQuery) {
            $productQuery->orderBy($orderByQuery, $typeQuery);
        }

        $products = $productQuery->get();

        return view('pages/product/index', compact("products", "category" ));
    }

    public function show(string $categorySlug, string $productId)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $product = Product::findOrFail($productId);
        $annexProducts = Product::where('category_id', $category->id)->where("id", "!=", $productId)->get();

        return view('pages/product/show', compact('product', 'annexProducts', 'category'));
    }
}
