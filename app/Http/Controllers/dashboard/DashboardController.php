<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menus = Menu::all();
        $payments = Payment::all()->where('is_paid', true);
        $today_sale = Payment::all()->where('is_paid', true)->where('created_at', '>=', Carbon::today())->sum('total_price');
        $total_sale = Payment::all()->where('is_paid', true)->sum('total_price');
        $today_customer = Payment::all()->where('is_paid', true)->where('created_at', '>=', Carbon::today())->count();
        $total_users= User::all()->count();
        return view('dashboard.index', compact('menus', 'payments', 'today_sale', 'total_sale', 'today_customer', 'total_users'));
    }
}
