<?php

namespace App\Models;

class Cart
{
    public $products = [];

    public function __construct($cart)
    {
        if ($cart)
        {
            // dd($cart);
            $this->products = $cart->products;
        }
    }

    public function addCart(Product $product, $quantity)
    {
        $newProduct = [
            'quantity' => $quantity,
            'price' => $product->price_sale ? $product->price_sale : $product->price,
            'name' => $product->information->name,
            'img' => $product->image[0]->path,
            'id' => $product->id
        ];
        // dd($this->products);
        // dd(array_key_exists($product->id, $this->products));
        if (array_key_exists($product->id, $this->products)){
            
            $this->products[$product->id]['quantity'] += $quantity;
            // dd($this->products);
        } else {
            $this->products[$product->id] = $newProduct;
        }
        
    }

    public function deleteItemCart($id)
    {
        unset($this->products[$id]);
    }

    public function updateCartQuantity($id, $quantity)
    {
        $this->products[$id]['quantity'] = $quantity;
        // $this->products[$id]['price'] = $quantity * $this->products[$id]['productInfo']->price;
        // $totalPrice = 0;
        // foreach ($this->products as $productId => $product) {
        //     $totalPrice += $this->products[$productId]['price'];
        // }
        // $this->totalPrice = $totalPrice;
    }

    public function totalPrice(){
        $totalPrice = 0;
        // dd($this->products);
        foreach($this->products as $product){
            $totalPrice += $product['price'] * $product['quantity'];
        }
        return $totalPrice;
    }
}