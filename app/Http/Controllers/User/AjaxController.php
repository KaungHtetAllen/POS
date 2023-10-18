<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    //direct pizza list
    public function pizzaList(Request $request){

        if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }
        else if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }
        else{
            $data = Product::orderBy('price','asc')->get();
        }

        return response()->json($data, 200);
        }


        //direct cart
        public function addToCart(Request $request){
            // logger($request->all());
            $data =[
                'user_id'=>$request->userId,
                'product_id'=>$request->pizzaId,
                'quantity'=>$request->count
                ];

            Cart::create($data);
            $response = ['status' => 'success','message' => 'Add to Cart Completed...'];

            return response()->json($response, 200);

            }
}
