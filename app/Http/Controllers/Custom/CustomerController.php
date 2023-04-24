<?php

namespace App\Http\Controllers\Custom;
use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
   //customer home
  public function home() {
    $pizza = Product::orderBy('created_at','desc')->get();
    $category = Category::get();
    $history = Order::where('user_id',Auth::user()->id)->get();
    $cart = Cart::where('user_id',Auth::user()->id)->get();
    return view('user.main.home',compact('pizza','category','cart','history'));
  }
 //category filter
  public function filter($categoryid) {
    $pizza = Product::where('category_id',$categoryid)->orderBy('created_at','desc')->get();
    $category = Category::get();
    $history = Order::where('user_id',Auth::user()->id)->get();
    $cart = Cart::where('user_id',Auth::user()->id)->get();
    return view('user.main.home',compact('pizza','category','cart','history'));
  }
//pizza details
 public function pizzadetails($id) {
    $pizza = Product::where('id',$id)->first();
    $pizzalist = Product::get();
    return view('user.main.detailpizza',compact('pizza','pizzalist'));
 }

 //pizza order shop cart show
  public function cartlist() {
    $cartlist = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
              ->leftJoin('products','products.id','carts.product_id')
              ->where('carts.user_id',Auth::user()->id)
               ->get();
               $totalprice = 0;
               foreach($cartlist as $c) {
                $totalprice += $c->pizza_price * $c->qty;
               }

     return view('user.main.cart',compact('cartlist','totalprice'));
  }

 //cart history
 public function carthistory() {
    $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('4');
    return view('user.main.history',compact('order'));
 }




 //password change page
  public function changePage() {
     return view('user.password.change');
  }

    //change password
    public function Changepassword(Request $req) {
        $this->passwordcheck($req);
        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;
       //  dd(Hash::make('sithu')); //password hash create
          if(Hash::check($req->current, $dbPassword)) {
             $data=[
               'password' => Hash::make($req->new)
             ];
            User::where('id',Auth::user()->id)->update($data);
        //  return redirect()->route('login#Page'); }
         return back()->with(['success' => 'password change sucess']); } else {
  return back()->with(['notMatch' => 'The old password not match.Try again!']); }  }

//edit acc info page
public function editPage() {
    return view('user.account.editpage');
}

//update accinfo
 public function updateinfo ($id,Request $req) {
    $this->accValidation($req);
    $accinfo =  $this->update($req);
 //for image
 if($req->hasFile('image')) {
  //old image name | check => delete | store
   $dbimage = User::where('id',$id)->first();
   $dbimage = $dbimage->image;
    if($dbimage != null) {
      Storage::delete('public/'.$dbimage);
    }
    $fileName = uniqid() . $req->file('image')->getClientOriginalName();
    $req->file('image')->storeAs('public',$fileName);
    $accinfo['image'] = $fileName;
 }
   User::where('id',$id)->update($accinfo);
    return redirect()->route('customer#home');
 }

 //contact and advice to admin
 public function contact() {
    $user = User::where('role','admin')->first();
    return view('user.contact.contact',compact('user'));
 }
 //create contact message
public function contactCreate($id,Request $req) {
    $user = User::where('id',$id)->first();
    $contact = [
        'name' =>$user->name,
        'email' =>$user->email,
        'message'=>$req->message,
    ];
    Contact::create($contact);
    return redirect()->route('customer#home');

}


   //update acc info validation check
   private function accValidation($request) {
    $acc = [
       'Name' => 'required',
       'phone' => 'required',
       'address' => 'required',
       'email' => 'required',
       'image'=> "mimes:jpg,jpeg,png,webp|file",
    ];
   Validator::make($request->all(),$acc)->validate();
  }



  //update acc info format change
    private function update($request) {
       // dd($request->all())->toArray();
       $account = [
           'name' => $request->Name,
           'email' =>$request->email,
           'phone' => $request->phone,
           'address' =>$request->address,
           'gender' => $request->gender
       ];
       return $account;
    }






 //password validation checkup
 private function passwordcheck($request) {
    $validate = [
        'current' => 'required|min:5|max:15',
         'new'  => 'required|min:5|max:15',
         'comfrim' => 'required|min:5|max:15|same:new'
    ];

    Validator::make($request->all(),$validate
    )->validate();

 }









}












