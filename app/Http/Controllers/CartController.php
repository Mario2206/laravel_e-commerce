<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\Cart\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of products
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $cartData = $this->cartService->getAll();

        $products = array_map(function ($item) {
            return $item->setItem(Product::find($item->getItemId()));
        }, $cartData);

        $totalPrice = array_reduce($cartData, function ($acc, $item) {
            $acc += $item->getItem()->price * $item->getQuantity();
            return $acc;
        });

        return view('pages/cart/index', compact("products", "totalPrice"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            "product_id" => ["required", "integer"],
            "quantity" => ["required", "integer"]
        ]);

        $this->cartService->store($request->input('product_id'), $request->input('quantity'));

        return redirect()->route("cart-index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(string $productId, Request $request)
    {
        $request->validate([
            "quantity" => ["required", "integer"]
        ]);

        $this->cartService->update($productId, $request->input("quantity"));

        return redirect()->route('cart-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->cartService->remove($id);

        return redirect()->route('cart-index');
    }
}
