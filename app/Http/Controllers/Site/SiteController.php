<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Page , Slide , Product, Category, Governorate, User, Cart, Order, OrderItem , City , Complain , Country};
use App\Http\Requests\Site\{RegisterRequest ,SoreOrderRequest , LoginRequest , StoreComplainRequest, UpdatePhoneRequest };
use App\Jobs\{SendVerificationCodeToViaPhoneNumberJob, IncreasProductSalesCountJob ,IncreasProductViewsCountJob };
use Auth;
use Str;
use Storage;
use Hash;
use Zip;
use Session;
class SiteController extends Controller
{


    public function setCountry(Request $request)
    {

        if ($request->filled('country_id')) {
            $country_id = $request->country_id;
            $country = Country::find($country_id);
            if ($country) {
                Session::put('user_country', $country->id);
                Session::put('currency', $country->currency);
            }
        }

        return redirect()->back();
    }

    public function index() {
        $slides = Slide::where('active' , 1)->latest()->get();
        $latest_products = Product::with(['category' , 'images' , 'prices' ])->latest()->take(12)->get();
        $best_selling_products = Product::orderBy('sales_count' , 'DESC' )->take(6)->get();
        $categories = Category::where('show_after_slider' , 1 )->latest()->get();
        $home_categories = Category::with('products')->where('show_in_home_page' , 1 )->latest()->get();
        $slider_categories = Category::where('show_after_slider' , 1 )->latest()->get();


        $latest_products = $latest_products->map(function($latest_product){
            $country_id = Session::get('user_country');
            $latest_product->price =  $latest_product->prices->where('country_id' , $country_id)->first()?->price ;
            $latest_product->price_after_discount =  $latest_product->prices->where('country_id' , $country_id)->first()?->price_after_discount ;
            return $latest_product;
        });


        $best_selling_products = $best_selling_products->map(function($best_selling_product){
            $country_id = Session::get('user_country');
            $best_selling_product->price =  $best_selling_product->prices->where('country_id'  , $country_id)->first()?->price ;
            $best_selling_product->price_after_discount =  $best_selling_product->prices->where('country_id'  , $country_id)->first()?->price_after_discount ;
            return $best_selling_product;
        });

        $home_categories = $home_categories->map(function($home_category){

            $home_category->products->map(function($product){
                $country_id = Session::get('user_country');
                $product->price =  $product->prices->where('country_id'  , $country_id)->first()?->price ;
                $product->price_after_discount =  $product->prices->where('country_id'  , $country_id)->first()?->price_after_discount ;
                return $product;
            });

            return $home_category;
        });
        return view('site.index' , compact('slides' , 'slider_categories' , 'home_categories' , 'categories' , 'latest_products' , 'best_selling_products'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page(Page $page)
    {
        return view('site.page' , compact('page') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product(Product $product)
    {
        dispatch(new IncreasProductViewsCountJob($product));
        $similar_products = Product::where('category_id' , $product->category_id )->inRandomOrder()->take(3)->get();
        $best_selling_products = Product::orderBy('sales_count' , 'DESC' )->take(6)->get();


        $similar_products = $similar_products->map(function($similar_product){
            $country_id = Session::get('user_country');
            $similar_product->price =  $similar_product->prices->where('country_id'  , $country_id)->first()?->price ;
            $similar_product->price_after_discount =  $similar_product->prices->where('country_id'  , $country_id)->first()?->price_after_discount ;
            return $similar_product;
        });

        $best_selling_products = $best_selling_products->map(function($best_selling_product){
            $country_id = Session::get('user_country');
            $best_selling_product->price =  $best_selling_product->prices->where('country_id'  , $country_id)->first()?->price ;
            $best_selling_product->price_after_discount =  $best_selling_product->prices->where('country_id'  , $country_id)->first()?->price_after_discount ;
            return $best_selling_product;
        });
        return view('site.product' , compact('product' , 'similar_products' , 'best_selling_products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        return view('site.products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('site.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('site.register');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        return view('site.account');
    }


    public function login_system(LoginRequest $request)
    {

        if (Auth::attempt(['password' => $request->password ,'phone' => $request->mobile], true)) {
            $request->session()->regenerate();
            return redirect('/');
        }
        return back()->with('error' ,  'بيانات الدخول غير صحيحه' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category_products(Category $category)
    {
        $products = Product::where('active' , 1)->where('category_id' , $category->id )
        ->latest()
        ->get();


        $products = $products->map(function($product){
            $country_id = Session::get('user_country');
            $product->price =  $product->prices->where('country_id' , $country_id)->first()?->price ;
            $product->price_after_discount =  $product->prices->where('country_id' , $country_id)->first()?->price_after_discount ;
            return $product;
        });



        return view('site.category_products' , compact('category' , 'products') );
    }

    public function search(Request $request)
    {
        $products = Product::where(function($query) use($request) {
            $query->where('name->en' , 'LIKE' , '%'.$request->search.'%' )->orWhere('name->ar' , 'LIKE' , '%'.$request->search.'%' );
        });
        if ($request->category_name != 'all' ) {
            $products->where('category_id' , $request->category_name );
        }
        $products = $products->latest()->get();
        return view('site.search' , compact('products'));
    }

    public function store_register(RegisterRequest $request)
    {

        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->type = 3;
        $user->save();
        Auth::login($user);
        // dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone))->onConnection('sync');
        return redirect(route('site.index'))->with('success' , 'تم الاشتراك بنجاح' );
    }

    public function cart()
    {
        return view('site.cart');
    }

    public function checkout()
    {
        $cartItems = [];
        $subtotal = 0;
        $total = 0;
        $shippingCost = 0;
        $currency = 'SR';
        $governorates = [];
        $discount = 0;
        return view('site.checkout' , compact('cartItems' , 'subtotal' , 'total' , 'shippingCost' , 'currency' , 'governorates' , 'discount'));
    }

    // SoreOrderRequest
    public function save_order(SoreOrderRequest $request)
    {


        $user_seesion_id = session()->getId();
        $sub_total = 0;
        $total = 0;
        $items = \Cart::session($user_seesion_id)->getContent();
        foreach ($items as $item) {
            $sub_total += ($item->quantity * $item->price );
        }
        // calculate the shipping cost
        $country = Country::find($request->country_id);
        $shipping_cost = $country->shipping_cost;

        $order = new Order;
        $order->number = time().mt_rand(1 , 1000).Auth::id();
        $order->total = $total;
        $order->subtotal = $sub_total;
        $order->shipping_cost = $shipping_cost;
        $order->total = $shipping_cost + $sub_total ;
        $order->discount = 0;
        $order->governorate_id = $request->governorate_id;
        $order->city = $request->city;
        $order->country_id = $request->country_id;
        $order->address = $request->address;
        $order->shipping_statues_id = 1;
        $order->postal_code = $request->postal_code;
        $order->whats_up = $request->whats_up;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->phone = $request->whats_up;
        $order->save();

        foreach ($items as $item) {
            $order_item = new OrderItem;
            $order_item->order_id = $order->id;
            $order_item->product_id = $item->associatedModel['id'];
            $order_item->price = $item->price;
            $order_item->quantity = $item->quantity;
            $order_item->size = $item->attributes['size'];
            $order_item->color = $item->attributes['color'];
            $order_item->save();
            // dispatch(new IncreasProductSalesCountJob($item->associatedModel['id']));
        }



        // \Cart::session($user_seesion_id)->clear();
        // return view('site.success')->with('success' , 'تم انشاء الطلب بنجاح' );
    }

    public function complains()
    {
        return view('site.complains');
    }

    public function store_complains(StoreComplainRequest $request)
    {
        $complain = new Complain;
        $complain->user_id = Auth::id();
        $complain->content = $request->content;
        $complain->phone = $request->phone;
        $complain->email = $request->email;
        $complain->category = $request->category;
        $complain->type = $request->type;
        $complain->save();
        return back()->with('success' , 'تم استلام طلبكم بنجاح ..جارى المراجعه' );
    }

    public function downloadProductImages(Product $product)
    {
        $zip_file =  Zip::create( $product->name.'-images.zip');
        $zip_file->add("s3://alaa-eldeen-s3-bucket/products/".$product->image, $product->image );
        foreach ($product->images as $product_image) {
           $zip_file->add("s3://alaa-eldeen-s3-bucket/products/".$product_image->image, $product_image->image );
       }
       return $zip_file;
   }

   public function phone()
   {
    return view('site.phone');
}

public function update_phone(UpdatePhoneRequest $request)
{
    $user = Auth::user();
    $user->phone = $request->phone;
    $user->save();
    dispatch(new SendVerificationCodeToViaPhoneNumberJob($request->phone));
    return redirect(route('site.verify_phone'));
}

}
