<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image_path', 'category_id'];


    public function category(){
        return $this->belongsTo(PizzaCat::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }

}
