<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaCat extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'id'];

    public function pizzas()
    {
        return $this->hasMany(Pizza::class);
    }
}
