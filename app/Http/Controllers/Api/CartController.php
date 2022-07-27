<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends ApiController
{
    //

    public function index(){
        $user_id = Auth::id();
        if(!$user_id){
            return $this->error(['error' => 'cart_index'], 'Invalid request');
        }

        $cart = Cart::query()->where('user_id', $user_id)->first();
        if(!$cart){
            return $this->success([]);
        }

        $c_products = $cart->products?json_decode($cart->products, true):[];
        $cart_product_ids = array_map(function($product){
            return $product['id'];
        },$c_products);
        $products = Product::query()->whereIn('id', $cart_product_ids)->orderBy('title')->get()->pluck(null,'id')->toArray();

        $cart_products = [];
        foreach($c_products as $p){
            $product = $products[$p['id']];
            $cart_products[] = [
                'id' => $product['id'],
                'title' => $product['title'],
                'image_url' => $product['image_url'],
                'price' => $product['price'],
                'quantity' => $p['quantity'],
                'category_id' => $product['category_id'],
                'restaurant_id' => $product['restaurant_id'],
                'description' => $product['description']
            ];
        }

        return $this->success($cart_products);
    }

    public function addProduct(){
        $user_id = Auth::id();
        if(!$user_id){
            return $this->error(['error' => 'cart_add_product'], 'Invalid request');
        }

        $product_id = request('product_id', false);
        $quantity = request('quantity', false);
        if(!$product_id || !$quantity){
            return $this->error(['error' => 'cart_add_product'], 'Invalid request');
        }

        $add_product = [
            'id' => $product_id,
            'quantity' => $quantity
        ];
        $cart = Cart::query()->where('user_id', $user_id)->first();
        if(!$cart){
            $products = [ $add_product ];
            Cart::query()->create([
                'user_id' => $user_id,
                'products' => json_encode($products, true),
            ]);
            return $this->success();
        }

        $products = $cart->products?json_decode($cart->products, true):[];
        array_push($products, $add_product);

        $cart->update([
            'products' => json_encode($products, true)
        ]);

        return $this->success();
    }

    public function updateProduct(){
        $user_id = Auth::id();
        if(!$user_id){
            return $this->error(['error' => 'cart_update_product'], 'Invalid request');
        }

        $product_id = request('product_id', false);
        $quantity = request('quantity', false);
        if(!$product_id || !$quantity){
            return $this->error(['error' => 'cart_update_product'], 'Invalid request');
        }

        $cart = Cart::query()->where('user_id', $user_id)->first();
        if($cart){
            $products = $cart->products?json_decode($cart->products, true):[];
            $products = array_map(function($product) use($product_id, $quantity){
                if($product['id'] == $product_id){
                    $product['quantity'] = $quantity;
                }
                return $product;
            }, $products);
            $cart->update([
                'products' => json_encode($products, true),
            ]);
            return $this->success();
        }
        return $this->error(['error' => 'cart_update_product'], 'Not found cart');
    }

    public function removeProduct(){
        $user_id = Auth::id();
        if(!$user_id){
            return $this->error(['error' => 'cart_remove_product'], 'Invalid request');
        }

        $product_id = request('product_id', false);
        if(!$product_id){
            return $this->error(['error' => 'cart_remove_product'], 'Invalid request');
        }

        $cart = Cart::query()->where('user_id', $user_id)->first();
        if($cart){
            $products = $cart->products?json_decode($cart->products, true):[];

            $products = array_filter($products, function($product) use($product_id){
                return $product['id'] != $product_id;
            });

            $cart->update([
                'products' => json_encode($products, true),
            ]);
            return $this->success();
        }

        return $this->error(['error' => 'cart_remove_product'], 'Not found cart');
    }


}
