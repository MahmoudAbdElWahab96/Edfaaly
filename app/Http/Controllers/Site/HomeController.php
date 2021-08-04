<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // get all products
        $products = $this->getProductsDetails();

        // shuffle products
        $products = $products->shuffle();

        // take 10 products
        $products = $products->take(20);

        return view('home')->with(compact('products'));
    }

        /**
     * get products details
     * @param null $category_id
     * @return \Illuminate\Support\Collection
     */
    public function getProductsDetails()
    {
        $products = Product::all();

        return collect($products);
    }
    
}
