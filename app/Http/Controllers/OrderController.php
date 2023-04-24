<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderlist;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  //for order list page
  public function orderlist() {
    $order = Order::select('orders.*','users.name as user_name')
            ->leftJoin('users','users.id','orders.user_id')
            ->Orderby('created_at','desc')
            ->get();
    return view('admin.order.orderlist',compact('order'));
  }
  //ajax include order list page
  public function statusorderlist(request $req) {

    $order = Order::select('orders.*','users.name as user_name')
              ->leftJoin('users','users.id','orders.user_id')
              ->Orderby('created_at','desc');

               if($req->status == null) {
                  $order = $order->get();
             }
             else  {
                $order = $order->where('orders.status',$req->status)->get();
             }
            return view('admin.order.orderlist',compact('order'));
  }
  //status change
  public function statusChange(Request $req) {

     Order::where('id',$req->orderid)->update([
         'status' => $req->status
     ]);
     $order = Order::select('orders.*','users.name as user_name')
     ->leftJoin('users','users.id','orders.user_id')
     ->Orderby('created_at','desc')
     ->get();
     return response()->json($order,200);
}

//order list info
public function listinfo($ordercode) {
   $order = Order::where('order_code',$ordercode)->first();

   $orderlist = Orderlist::select('orderlists.*','users.name as user_name','products.image as product_image','products.name as product_name')
              ->leftJoin('users','users.id','orderlists.user_id')
              ->leftJoin('products','products.id','orderlists.product_id')
               ->where('order_code',$ordercode)
               ->get();
            //    dd($orderlist->toArray());
    return view('admin.order.listinfo',compact('orderlist','order'));
}












}
