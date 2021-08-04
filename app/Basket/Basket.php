<?php

namespace App\Basket;

use App\Exceptions\QuantityExceededException;
use App\Product;
use App\Support\Storage\Contracts\StorageInterface;

class Basket
{
    /**
     * Instance of StorageInterface.
     *
     * @var StorageInterface
     */
    protected $storage;

    /**
     * Instance of Product.
     *
     * @var Product $product
     */
    protected $product;

    /**
     * Create a new Basket instance.
     *
     * @param StorageInterface $storage
     * @param Product $product
     */
    public function __construct(StorageInterface $storage, Product $product)
    {
        $this->storage = $storage;
        $this->product = $product;
    }

    /**
     * Check if the basket has a certain product.
     *
     * @param  Product $product
     */
    public function has($product_id, $id)
    {
        return $this->storage->exists($product_id, $id);
    }

    /**
     * Update the basket.
     *
     * @param Product $product
     * @param $data
     *
     * @throws QuantityExceededException
     */
    public function update(Product $product, $data, $id = null)
    {
//        if (!$this->product->find($product->id)->hasStock($quantity)) {
//            throw new QuantityExceededException;
//        }

        if ($data['quantity'] == 0) {
            $this->remove($product, $id);

            return;
        }

        $this->storage->set($product->id, $data, $id);
    }

    /**
     * Add the product with its quantity to the basket.
     * The quantity will be updated if it exists.
     *
     * @param Product $product
     * @param Integer $quantity
     */
    public function add(Product $product, $data, $id = null)
    {

        if ($item = $this->has($product->id, $id)) {

            $data['quantity'] = $item['quantity'] + $data['quantity'];
        }


        if ($data['quantity'] == 0) {
            $this->remove($product, $id);

            return;
        }

        $this->storage->set($product->id, $data, $id);

//        $this->update($product, $data, $id);
    }

    /**
     * Remove a Product from the storage.
     * @param $id
     * @param  Product $product
     */
    public function remove(Product $product, $id)
    {
        $this->storage->remove($product->id, $id);
    }

    /**
     * Get a product that is inside the basket.
     *
     * @param  Product $product
     */
    public function get(Product $product)
    {
        return $this->storage->get($product->id);
    }

    /**
     * Clear the basket.
     */
    public function clear()
    {
        return $this->storage->clear();
    }

    /**
     * Get all products inside the basket.
     */
    public function all()
    {

        return $this->storage->all();
    }

    /**
     * Get the amount of products inside the basket.
     */
    public function itemCount()
    {
        return count($this->storage->all());
    }

    public function getTotalCost()
    {

        $cost = 0;
        $all_items = $this->storage->all();

        foreach ($all_items as $item) {

            if (isset($item['product_option_value_id'])) {

                $cost += ProductOptionValues::find($item['product_option_value_id'])->price * $item['quantity'];
                continue;
            }

            $cost += NormalProductDetails::where('product_id', $item['product']->priceid)->first()->price * $item['quantity'];
        }

        return $cost;

    }

}