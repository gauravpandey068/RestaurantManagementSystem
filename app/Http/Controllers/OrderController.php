<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('waiterRole');

    }

    public function index()
    {
        $orders = Order::all();
        return view('dashboard.order', compact('orders'));
    }

    public function getOrder(Customer $customer)
    {
        $orders = $customer->orders;
        return view('dashboard.customer', compact('orders'));
    }

    public function store(Customer $customer)
    {
        request()->validate([
            'menu_id' => 'required',
            'quantity' => 'required',
        ]);

        $customer->orders()->create([
            'menu_id' => request('menu_id'),
            'quantity' => request('quantity'),
            'status' => 'pending',
        ]);
        return redirect()->back();
    }

}
