<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Brand  , ProductCountryPrice , Category   , Product, ProductImage, Country , Variation ,ProductShipping ,  OrderItem};
use Auth;
use App\Http\Requests\Dashboard\Products\{StoreProductRequest , UpdateProductRequest};
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $countries = Country::all();
        return view('dashboard.products.create' , compact('brands' , 'countries' ,'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // StoreProductRequest
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $product = new Product;

        if(!$product->add($request->all()))
            return redirect()->back()->with('error' , trans('products.adding_error'));

        if($request->hasFile('image')) {
            $product->image = basename($request->file('image')->store('products'));
            $product->save();
        }

        if($request->hasFile('size_guide')) {
            $product->size_guide = basename($request->file('size_guide')->store('products'));
            $product->save();
        }

        if($request->hasFile('images')) {
            $images = [];
            for ($i = 0; $i <count($request->images) ; $i++) {
                $images[] = new ProductImage([
                    'product_id' => $product->id ,
                    'image' => basename($request->file('images.'.$i)->store('products')) ,  
                ]);
            }
            $product->images()->saveMany($images);
        }


        foreach ($request->country_price as $key => $price) {
            $product_country_price = new ProductCountryPrice;
            $product_country_price->user_id = Auth::id();
            $product_country_price->product_id = $product->id;
            $product_country_price->country_id = $key;
            $product_country_price->price = $price;
            $product_country_price->price_after_discount = $request->price_after_discount[$key];
            $product_country_price->save();
        }

        if ($request->filled('types')) {
            for ($i=0; $i <count($request->types) ; $i++) { 
                $new_product_variat = new Variation;
                $new_product_variat->product_id = $product->id;
                $new_product_variat->title = $request->name[$i];
                $new_product_variat->type = $request->types[$i] ;
                $new_product_variat->user_id = Auth::id();
                $new_product_variat->barcode = time().mt_rand(1 , 9000);
                $new_product_variat->save();
                if ($request->color_names) {
                    for ($r=0; $r <count($request->color_names[$i]) ; $r++) { 
                        $product_sub_variat = new Variation;
                        $product_sub_variat->product_id = $product->id;
                        $product_sub_variat->parent_id = $new_product_variat->id;
                        $product_sub_variat->title = $request->color_names[$i][$r];
                        $product_sub_variat->color = $request->colors[$i][$r];
                        $product_sub_variat->type = 'color';
                        $product_sub_variat->barcode = time().mt_rand(1 , 9000);
                        $product_sub_variat->user_id = Auth::id();
                        $product_sub_variat->save();
                    }
                }
            }
        } else {
            $variation = new Variation;
            $variation->product_id = $product->id;
            $variation->user_id = Auth::id();
            $variation->price = $product->price;
            $variation->type = 'one_size';
            $variation->barcode = $product->barcode;
            $variation->save();
        }


        return redirect(route('dashboard.products.index'))->with('success' , trans('products.adding_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['images' , 'country', 'brand' , 'category'  , 'user']);
        return view('dashboard.products.show' , compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $countries = Country::all();
        return view('dashboard.products.edit' , compact('brands' , 'countries' ,'categories' , 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request,Product $product)
    {
        if(!$product->edit($request->all()))
            return redirect()->back()->with('error' , trans('products.editing_error'));

        
        if($request->hasFile('image')) {
            $product->image = basename($request->file('image')->store('products'));
            $product->save();
        }


        if($request->hasFile('size_guide')) {
            $product->size_guide = basename($request->file('size_guide')->store('products'));
            $product->save();
        }

        if($request->hasFile('images')) {
            $images = [];
            for ($i = 0; $i <count($request->images) ; $i++) {
                $images[] = new ProductImage([
                    'product_id' => $product->id ,
                    'image' => basename($request->file('images.'.$i)->store('products')) ,  
                ]);
            }
            $product->images()->saveMany($images);
        }

        foreach ($request->price as $key => $price) {
            $product_country_price = ProductCountryPrice::where('product_id' , $product->id )
            ->where('country_id' , $key )->first();

            if ($product_country_price) {
                $product_country_price->price = $price;
                $product_country_price->price_after_discount = $request->price_after_discount[$key];
                $product_country_price->save();
            } else {
                $product_country_price = new ProductCountryPrice;
                $product_country_price->user_id = Auth::id();
                $product_country_price->product_id = $product->id;
                $product_country_price->country_id = $key;
                $product_country_price->price = $price;
                $product_country_price->price_after_discount = $request->price_after_discount[$key];
                $product_country_price->save();
            }
        }

        return redirect()->back()->with('success' , trans('products.editing_success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
