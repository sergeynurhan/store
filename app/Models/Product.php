<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stock_balance', 'store_id'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // public function purchases()
    // {
    //     return $this->hasMany(Purchase::class);
    // }

    public function users()
    {
        return $this->belongsToMany(User::class, 'purchases');
    }
}
