<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\PizzaCat;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function pizza_view($pk){

        $pizzas = Pizza::where('category_id', $pk)->get();
        $object =
        $data = [
            'pizzas' => $pizzas
        ];

        return view('pizzas')->with($data);
    }

    public function prod_info_view($pk)
    {
        $objects = Pizza::where('id', $pk)->get();
        $data = ['objects' => $objects];
        return view('product_info')->with($data);
    }




}
