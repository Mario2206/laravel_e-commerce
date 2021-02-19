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
        $product = Product::findOrFail($productId);

        return view('pages/product/show', compact('product'));
    }
}
