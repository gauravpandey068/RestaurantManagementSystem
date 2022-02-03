<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('waiterRole');
    }

    public function index(){
        $menues = Menu::all();
        return view('dashboard.menu', [
            'menues' => $menues
        ]);
    }
    public function store(){
        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);
       Menu::create([
            'name' => request('name'),
            'price' => request('price'),
            'type' => request('type'),
        ]);
       return redirect()->route('menu');
    }
    public function destroy($id){
        Menu::find($id);
        Menu::destroy($id);
        return redirect()->back();
    }
    public function update($id){
        $menu = Menu::find($id);

        request()->validate([
            'name' => 'required',
            'price' => 'required',
            'type' => 'required',
        ]);

        $menu->name = request('name');
        $menu->price = request('price');
        $menu->type = request('type');
        $menu->save();
        return redirect()->back();
    }
}
