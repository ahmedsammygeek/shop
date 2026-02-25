<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderReturn;
use App\Models\Expenses;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders_count = Order::whereDate('created_at' , today() )->count();

        $products_count = Product::count();
        $categories_count = Category::count();
        $orders_total_income = Order::whereDate('created_at' , today() )->sum('total');


        return view('dashboard.index' , compact('orders_count' , 'orders_total_income' , 'categories_count' , 'products_count'));
    }
}
