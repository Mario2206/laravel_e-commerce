<?php

namespace App\Service;

class CartService {

    /**
     * Store product in cart session
     *
     * @param int $productId
     * @param int $incomingQuantity
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function store(int $productId, int $incomingQuantity = 1) {

        $storage = session('cart', []);
        $productIndex = null;
        $quantity = $incomingQuantity;

        foreach ($storage as $key => $product) {

            if($product['product'] === $productId) {
                $productIndex = $key;
                $quantity += $product['quantity'];
            }
        }

        $storage[is_int($productIndex ) ? $productIndex : count($storage) + 1] = ['product' => $productId, 'quantity' => $quantity];

        return session(["cart" => $storage]);
    }

    /**
     * Get all products from cart session
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function getAll() {
        return session('cart', []);
    }

    /**
     * Update one product from cart session (if quantity === 0, remove it)
     */
    public function update(int $productId, int $incomingQuantity = 0) {
        $storage = session('cart');

        $productIndex = null;

        foreach ($storage as $k => $product) {
            if($productId === $product['product_id']) {
                $productIndex = $k;
            }
        }

        if($incomingQuantity <= 0) {
            unset($storage[$productIndex]);
        } else {
            $storage[$productIndex] = $incomingQuantity;
        }

        return session(['cart' => $storage]);

    }

    /**
     * Remove all products from cart session
     */
    public function removeAll() {
        session()->forget('cart');
    }
}
