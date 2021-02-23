<?php


namespace App\Service\Cart;


class CartItem
{
    private string $itemId;

    private int $quantity;

    private $item = null;



    /**
     * CartItem constructor.
     * @param $itemId
     * @param $quantity
     */
    public function __construct($itemId, $quantity)
    {
        $this->itemId = $itemId;
        $this->quantity = $quantity;
    }

    /**
     * @return null
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param null $item
     * @return CartItem
     */
    public function setItem($item): CartItem
    {
        $this->item = $item;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemId(): string
    {
        return $this->itemId;
    }

    /**
     * @param string $itemId
     * @return CartItem
     */
    public function setItemId(string $itemId): CartItem
    {
        $this->itemId = $itemId;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     * @return CartItem
     */
    public function setQuantity(int $quantity): CartItem
    {
        $this->quantity = $quantity;
        return $this;
    }





}
