<?php

namespace App\Support\Storage;

use App\Support\Storage\Contracts\StorageInterface;

use Session;

class SessionStorage implements StorageInterface
{
	/**
	 * The bucket being used.
	 *
	 * @var String
	 */
	protected $bucket;

	/**
	 * Set the bucket name that should be used.
	 *
	 * @param String $bucket
	 */
	public function __construct($bucket = 'default')
	{
		if(! Session::has($bucket)) {
			Session::put($bucket, []);
		}

		$this->bucket = $bucket;
	}

    /**
     * @param $product_id
     * @param $value
     * @param null $id
     * @return mixed
     */
	public function set($product_id, $value,  $id = null)
	{

        $session_content = $this->all();

        foreach ($session_content as $key => $item) {

            if ($item['product']->id == $product_id) {

                if ($item['product']->type == 'option') {

                    if (isset($item['product_option_value_id']) && $item['product_option_value_id'] == (int) $id) {

                        return Session::put("{$this->bucket}.{$key}", $value);
                    }

                }

                if ($item['product']->type == 'normal' && $item['product']->id == (int) $product_id) {

                    return Session::put("{$this->bucket}.{$key}", $value);
                }

            }
        }
        return Session::push("{$this->bucket}", $value);
	}

    /**
     * Get the product from the bucket.
     *
     * @param $index
     *
     * @return mixed|null
     */
	public function get($product_id, $id)
	{
	    $item = $this->exists($product_id, $id);

		return $item;
//		return Session::get("{$this->bucket}.{$index}");
	}

    /**
     * Check if the product index exists in the bucket.
     *
     * @param $product_id
     * @param $id
     *
     * @return mixed
     */
	public function exists($product_id, $id = null)
	{
	    $session_content = $this->all();

	    foreach ($session_content as $item) {

	        if ($item['product']->id == $product_id) {

	            if ($item['product']->type == 'option') {

	                if (isset($item['product_option_value_id'])) {

	                    if (isset($item['product_option_value_id']) && $item['product_option_value_id'] == (int) $id){

                            return $item;
                        }

                    }

                }

                if ($item['product']->type == 'normal' && $item['product']->id == (int) $product_id) {

                    return $item;
                }

            }
        }
        return null;
//		return Session::has("{$this->bucket}.{$index}");
	}

	/**
	 * Get all products inside the bucket.
	 *
	 */
	public function all()
	{
		return Session::get("{$this->bucket}");
	}

	/**
	 * Remove a product from the bucket.
	 * @param $product_id
	 * @param $id
	 */
	public function remove($product_id, $id)
	{

        $session_content = $this->all();

        foreach ($session_content as $key => $item) {

            if ($item['product']->id == $product_id) {

                if ($item['product']->type == 'option') {

                    if (isset($item['product_option_value_id'])) {

                        if (isset($item['product_option_value_id']) && $item['product_option_value_id'] == (int) $id){

                            Session::forget("{$this->bucket}.{$key}");
                        };
                    }

                }

                if ($item['product']->type === 'normal' && $item['product']->id == (int) $product_id) {

                    Session::forget("{$this->bucket}.{$key}");
                }

            }
        }

//		if ($this->exists($index)) {
//			Session::forget("{$this->bucket}.{$index}");
//		}
	}

	/**
	 * Clear the entire bucket.
	 */
	public function clear()
	{
		Session::forget($this->bucket);
	}

}
