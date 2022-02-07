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
        $this->middleware('waiterRole')->except('update', 'index');
        $this->middleware('chefRole')->only('update');

    }

    public function index()
    {
        $orders = Order::all()->where('status', '!=', 'complete');
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
        $price = Menu::find(request('menu_id'))->price * request('quantity');


        $customer->orders()->create([
            'menu_id' => request('menu_id'),
            'quantity' => request('quantity'),
            'price' => $price,
            'status' => 'pending',
        ]);
        return redirect()->back();
    }

    public function update(Order $order)
    {
        request()->validate([
            'status' => 'required',
        ]);
        $order->status = request('status');
        $order->save();
        return redirect()->back();
    }

}
