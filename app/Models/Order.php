<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable= ['menu_id', 'quantity', 'status'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
