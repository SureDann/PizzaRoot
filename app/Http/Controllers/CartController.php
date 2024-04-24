<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart_view(){
        return view('cart');
    }


    public function add_cart(Request $request){

        $objectId = $request->input('object_id');
        $count = $request->input('quantity');
        $already_product_count = Cart::where('product_id', $objectId)->value('count');
        $cart = Cart::where('product_id', $objectId)->first();

        if($cart){
            $cart->update([
               'count' =>  $cart->count + $count,
            ]);
        }else{
            Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $objectId,
                'count' => $count,
            ]);
        }


        return redirect()->back();


    }
}
