<?php

namespace App\Http\Controllers\API;

use Mail;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


/**
 * Class ProductsController
 * @package App\Http\Controllers\API
 */
class ProductsControllerApi extends Controller
{

    // image save destination
    protected $uploadDestination = 'images/products';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        // get all products from db
        $products = Product::all();

        // check successfully status
        return [
            'status' => true,
            'data' => [
                'products' => $products
            ],
            'msg' => 'Products was successfully displyed!'
        ];

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreateNewProduct()
    {

        $products = Product::all();
        // check successfully status
        return [
            'status' => true,
            'data' => [
                'products' => $products
            ],
            'msg' => 'Data was successfully displayed'
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function createNewProduct(Request $request)
    {
        // validation products
        $validation_products = [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ];

        $validation = validator($request->all(), $validation_products);

        // if validation failed, return false response
        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $key => $value) {
                return [
                    'status' => false,
                    'data' => 'validation error',
                    'msg' => $value
                ];
            }
        }


        // stored data in product table
        $product = Product::forceCreate([
            'name' => $request->name,
            'price' => $request->price,
            'model_number' => $request->model_number,
            'description' => $request->description,
        ]);

        // check saving success
        if (!$product->save()) {
            return [
                'status' => false,
                'data' => null,
                'msg' => 'something went wrong, please try again!'
            ];
        }

        //successful return
        return [
            'status' => true,
            'data' => [
                'product' => $product
            ],
            'msg' => 'Product had been successfully recorded',
        ];
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdateProduct($id)
    {
        //find product by id
        $product = Product::find($id);

        if (!$product) {
            return [
                'status' => false,
                'data' => null,
                'msg' => 'There is no product in such id!'
            ];
        }

        //product arabic translate details
        $product_translated_ar = $product->translate('ar');

        $product->ar = $product_translated_ar;

        //english product translate details
        $product_translated_en = $product->translate('en');

        $product->en = $product_translated_en;


        // get all menues
        $menus = Menu::all();

        foreach ($menus as $menu) {

            // get menu trans
            $menu->trans = $menu->translate();

            // get menu's main categories
            $categories = $menu->categories()->where('parent_id', 0)->get();

            // translate categories
            foreach ($categories as $category) {

                // get category details
                $category_translated = $category->translate();

                // add the translated Category as a key => value to main Category object
                // key is category_translated and the value id $category_translated
                $category->trans = $category_translated;


                // get sub categories
                $sub_categories = Category::where('parent_id', $category->id)->get();

                //translate sub categories
                foreach ($sub_categories as $sub_category) {

                    $sub_category->trans = $sub_category->translate();
                }

                // apend sub categories to main ones
                $category->sub_categories = $sub_categories;
            }

            $menu->categories = $categories;
        }


        if (count($menu->categories) == 0) {
            return [
                'status' => false,
                'data' => null,
                'msg' => 'There are no Categories in db!'
            ];
        }

        //check successfully status
        return [
            'status' => true,
            'data' => [
                'product' => $product,
                'menus' => $menus,
                // 'category_name' => $category_name,
            ],
            'msg' => 'Data was successfully displayed'
        ];
    }

    /**
     * @param $id
     * @param Request $request
     * @return array
     */
    public function updateProduct($id, Request $request)
    {
        // validation products
        $validation_rules = [
            'type_en' => 'required',
            'name_en' => 'required',
            'description_en' => 'required',
        ];

        $validation = validator($request->all(), $validation_rules);

        // if validation failed, return false response
        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $key => $value) {
                return [
                    'status' => false,
                    'data' => 'validation error',
                    'msg' => $value
                ];
            }
        }

        //find product by id
        $product = Product::find($id);

        //check if no product
        if (!$product) {
            return [
                'status' => false,
                'data' => null,
                'msg' => 'There is no product with this id!'
            ];
        }

        //store request category id
        $product->category_id = $request->category_id;
        $product->type = $request->type_en;

        //check save status
        if ($product->save()) {

            $product_en = $product->translate('en');
            $product_en->name = $request->name_en;
            $product_en->description = $request->description_en;
            $product_en->notes = $request->notes_en;

            // check save status
            if (!$product_en->save()) {
                return [
                    'status' => false,
                    'data' => null,
                    'msg' => 'something went wrong while updating EN, please try again!'
                ];
            }

            if ($request->name_ar) {

                $product_ar = $product->translate('ar');
                $product_ar->name = $request->name_ar;
                $product_ar->description = $request->description_ar;
                $product_ar->notes = $request->notes_ar;

                $product_ar->save();

            }

            // save product images
            $images = $request->file('imgs');

            if ($images) {

                if (count($images) === 0) {

                    // check save success
                    return [
                        'status' => true,
                        'data' => [
                            'product' => $product
                        ],
                        'msg' => 'Product had been successfully updated!',
                    ];
                }

                foreach ($images as $image) {

                    if (!$image) {
                        continue;
                    }

                    $image_name = $image->getClientOriginalName();

                    $moved = $image->move(storage_path($this->uploadDestination), $image_name);

                    if ($moved) {

                        $product->images()->create([
                            'image' => $image_name
                        ]);
                    }
                }
            }


            // check save success
            return [
                'status' => true,
                'data' => [
                    'product' => $product
                ],
                'msg' => 'Product had been successfully updated!',
            ];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteProduct($id)
    {
        //search  for product
        $product = Product::find($id);

        //if no product
        if (!$product) {
            return [
                'status' => false,
                'data' => null,
                'msg' => 'There is no Product with this id!'
            ];
        }


        //delete productTrans
        $product->productTrans()->delete();

        //delete product
        $product->delete();

        //check  success status
        return [
            'status' => true,
            'data' => [
                'product' => $product
            ],
            'msg' => 'Product had been successfully deleted!'
        ];
    }


    /**
     * prepare text to summarize
     * @var Request $request
     * @return string summary
     */
    public function setupText($html)
    {
        $is_html = preg_match('/<[^>]*>/', $html, $matches);
        if (!$is_html) {

            return $html;
        }

        $paragraphs = preg_match('/(<p>).*[\s\S]*(<\/p>)/', $html, $matches);

        $paragraph = '';

        foreach ($matches as $matche) {

            $paragraph .= $matche;
        }

        $text = preg_replace('/<[^>]*>/', '', $paragraph);
        
        return $text;
    }


    /**
     * call summarize service
     * @var string $text
     * @return string $server_output
     */
    public function summarize($text)
    {

        // prepare text
        $text = $this->setupText($text);

        // init CURL
        $ch = curl_init();

        // setup curl options
        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:5000/summarize");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "text=$text");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // execute curl request
        $server_output = curl_exec($ch);

        // close curl connection
        curl_close($ch);

        $summarized_text = json_decode($server_output)->summary;

        return $summarized_text;
    }

}
