<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of products
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(CartService $cartService)
    {
        $cartData = $cartService->getAll();
        $products = array_map(function ($item) {
            return ["product" => Product::find($item['product']), "quantity" => $item["quantity"]];
        }, $cartData);

        return view('pages/cart/index', compact("products"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, CartService $cartService)
    {
        $request->validate([
            "product_id" => ["required", "integer"],
            "quantity" => ["required", "integer"]
        ]);

        $cartService->store($request->input('product_id'), $request->input('quantity'));

        return redirect()->route("cart-index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
