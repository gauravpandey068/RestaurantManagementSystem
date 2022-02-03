<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('waiterRole');
    }

    public function index()
    {
        //get active customers
        $customers = Customer::where('is_active', 1)->get();
        return view('dashboard.customer', [
            'customers' => $customers
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'table_no' => 'required|unique:customers',
        ]);
        $customer = new Customer();
        $customer->create([
            'name' => request('name'),
            'table_no' => request('table_no'),
            'is_active' => 1
        ]);
        return redirect()->back();
    }
}
