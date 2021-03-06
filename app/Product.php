<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    //
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = "products";
    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productOptionValue()
    {
        return $this->hasMany('App\Models\ProductOptionValues', 'product_id', 'id');
    }

    public function normalProductDetails()
    {
        return $this->hasMany('App\Models\NormalProductDetails', 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boughtDetails()
    {
        return $this->hasMany('App\Models\BoughtDetails', 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productTrans()
    {
        return $this->hasMany('App\Models\ProductTranslation', 'product_id', 'id');
    }

    /**
     * @param null $lang_code
     * @return Model|null|object|static
     */

    public function translate($lang_code = null)
    {
        if (!$lang_code) {

            $lang_id = Language::where('lang_code', app()->getLocale())->first()->id;
        } else {

            $lang_id = Language::where('lang_code', $lang_code)->first()->id;
        }

        return $this->productTrans()->where('lang_id', $lang_id)->first();
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }



}
