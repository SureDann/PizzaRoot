<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pizza;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // also works code  without laravel methods, i think its better :)
//    public function cart_view(){
//        $user_id = auth()->user()->id;
//        $data = Cart::where('user_id', $user_id)->get();
//        $array = array();
//        foreach ($data as $d){
//            $array[] = $d['product_id'];
//        }
//        $products = array();
//        foreach ($array as $ar){
//            $products = Pizza::where('id', $ar)->get();
//        }
//
//        $context = ['data'=>$data, 'ar' => $products];
//
//        return view('cart')->with($context);
//    }

    public function cart_view(){
        $user_id = auth()->user()->id;
        $products = Pizza::leftJoin('carts', 'pizzas.id', '=', 'carts.product_id')
            ->select('pizzas.*', 'carts.count')
            ->where('carts.user_id', $user_id)
            ->get();


        return view('cart', compact('products'));
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












