<?php

namespace App\Http\Controllers\Site;

use App\Basket\Basket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class CartController extends Controller
{
    private static $basket;

    public function __construct(Basket $basket)
    {
        self::$basket = $basket;
    }


    public function addToCart(Request $request){
        $product_id = $request->input('product_id');

        $product = Product::find($product_id);


        self::$basket->add($product, [
            'product' => $product,
            'quantity' => 1,
        ], null);

        return self::$basket->all();
        
    }

        /**
     * @return array
     */
    public function getCartContent()
    {

        $total_cost = 0;
        $total_tax = 0;
        $products = [];
        $tax = 0.14;
        $count = 0;
        $shoes_offer = 0;
        $jaket_offer = 0;
        $discounts = [];
        $total_costs = 0;

        $all_items= session()->get('basket');

        if ($all_items) {

            foreach ($all_items as $item) {

                $product = $item['product'];
        
                if(strpos($product->name, 'Shoes') !== false){
                    $shoes_offer = $product->price * (10 / 100);
                }

                if(strpos($product->name, 'T-Shirt') !== false){
                    $count++;
                }
                if(strpos($product->name, 'Jacket') !== false){
                    if($count == 2){
                        $jaket_offer = $product->price * (50 / 100);
                    }
                }
          
                $product->qty = $item['quantity'];
                $product->price = $product->price;
                $total_cost += $product->price * $item['quantity'];

                $products[] = $product;
            }

            $discounts = ['10% off shoes:' => $shoes_offer,'50% off jacket:' => $jaket_offer];
        }

        $values_discunts = 0;
        
        foreach($discounts as $key => $item){
            $values_discunts += $item;
        }

        $total_tax = $total_cost * $tax;

        $total_costs = $total_cost + $total_tax - $shoes_offer - $jaket_offer;
         
        return view('site.layouts.cart')->with(compact('products', 'total_cost', 'total_tax', 'discounts', 'values_discunts', 'total_costs'));
    }

    public function removeItem($index)
    {
        $cart_session = session()->get('basket');

        if ($cart_session) {

            session()->forget("basket.$index");
        }
    }

}