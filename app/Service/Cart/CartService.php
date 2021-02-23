<?php

namespace App\Service\Cart;



use Illuminate\Http\Request;

class CartService {



    /**
     * Store product in cart session
     *
     * @param string $productId
     * @param int $incomingQuantity
     * @return CartItem[]
     */
    public function store(string $productId, int $incomingQuantity = 1)
    {
        $storage = $this->getStorage();
        $productIndex = null;

        foreach ($storage as $key => $product) {

            if($product->getItemId() === $productId) {
                $productIndex = $key;
                $product->setQuantity($product->getQuantity() + $incomingQuantity);
            }
        }

        if(!$productIndex && $productIndex !== 0) {
            $storage[] = new CartItem($productId, $incomingQuantity);
        }

        return $this->setStorage($storage);
    }

    /**
     * Get all products from cart session
     *
     * @return CartItem[]
     */
    public function getAll(): array
    {
        return $this->getStorage();
    }

    /**
     * Update one product from cart session (if quantity === 0, remove it)
     * @param string $productId
     * @param int $incomingQuantity
     * @return CartItem[]
     */
    public function update(string $productId, int $incomingQuantity = 0)
    {

        if($incomingQuantity <= 0) {
            return $this->remove($productId);
        }

        $storage = array_map(function ($item) use ($productId, $incomingQuantity) {
            return $productId === $item->getItemId() ? $item->setQuantity($incomingQuantity) : $item;
        }, $this->getStorage());

        return $this->setStorage($storage);

    }

    /**
     * @param string $productId
     * @return CartItem[]
     */
    public function remove(string $productId)
    {
        $storage = array_filter($this->getStorage(),function(CartItem $item) use ($productId) {
            return $item->getItemId() !== $productId;
        });

        return $this->setStorage($storage);
    }

    /**
     * Remove all products from cart session
     */
    public function removeAll() {
        session()->forget('cart');
    }

    private function setStorage(array $storage) {
        return session(['cart' => $storage]);
    }

    private function getStorage() {
        return session("cart", []);
    }
}
