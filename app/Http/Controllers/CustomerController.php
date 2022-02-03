<?php

namespace App\Http\Controllers;

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
        return view('customer.index');
    }
}
