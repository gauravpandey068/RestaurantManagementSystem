<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('cashierRole');
    }

    public function index()
    {
        $customers = Customer::all()->where('is_active', true);
        $payments = Payment::all()->where('is_paid', false);
        return view('dashboard.payment', compact('customers', 'payments'));
    }
    public function create()
    {
        request()->validate([
            'customer_id' => 'required|exists:customers,id',
        ]);
        $customer = Customer::find(request('customer_id'));
        $total_price = 0.00;
        foreach ($customer->orders as $order){
            $total_price = $total_price + $order->price;
        }
        $customer->payments()->create([
            'customer_id' => request('customer_id'),
            'total_price'=>$total_price,
            'is_paid'=>false,
        ]);
        return redirect()->back();

    }
    public function update(Payment $payment)
    {
        $payment->is_paid = true;
        $customer = Customer::find($payment->customer_id);
        $customer->is_active = false;
        $customer->delete();
        $payment->save();
        return redirect()->back();
    }

}
