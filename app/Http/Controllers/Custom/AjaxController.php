<?php

namespace App\Http\Controllers\Custom;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzalist(Request $req) {
        if($req->status == "asc") {
          $data = Product::orderBy('created_at','asc')->get();
        } else{
            $data = Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }
    //add cart piza ||get order data
    public function addcart(Request $req) {
       $data = $this->orderData($req);
       Cart::create($data);
       $response = [
        'message' => 'Add to cart complete',
         'status' => 'success'
       ];
        return response()->json($response, 200);
    }

    //cart to orderlist table
    public function orderlist(Request $req) {
        $total = 0;
        foreach($req->all() as $item) {
         $data =    Orderlist::create([
             'user_id' =>$item['userid'],
             'product_id' => $item['productid'],
             'qty' => $item['qty'],
             'total' => $item['total'],
             'order_code' => $item['ordercode']
            ]);
            $total += $data->total;
        }
            Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total+3000,
        ]);
        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'order completed'
        ]);
    }

    //function for add cart piza private
    private function orderData($req) {
       return [
         'user_id' => $req->userid,
         'product_id'=> $req->pizzaid,
         'qty' =>$req->count
       ];
    }

    //clear cart
    public function clearcart() {
        Cart::where('user_id',Auth::user()->id)->delete();
    }
    //clear order cart
    public function clearOrderCart(Request $req) {
        Cart::where('user_id',Auth::user()->id)
             ->where('product_id',$req->productid)
             ->where('id',$req->orderid)
             ->delete();
    }

    //view count
    public function viewcount(Request $req) {


        $pizza = Product::where('id',$req->productid)->first();

        Product::where('id',$req->productid)->update([
            'view_count' => $pizza->view_count + 1
        ]);
    }

}
