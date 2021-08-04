<?php

namespace App\Support\Storage\Contracts;

interface StorageInterface
{
	public function set($index, $value);
	public function get($product_id, $id);
	public function all();
	public function exists($product_id, $id);
	public function remove($product_id, $id);
	public function clear();
}
