<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function pizalist() {

        $piza = Product::select('products.*','categories.name as category_name')
            ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
         ->leftjoin('categories','products.category_id','categories.id')
         ->orderBy('products.id','desc')->paginate(2);
          $piza->appends(request()->all());
          return view('admin.product.pizalist',compact('piza'));
    }

 //show create page
    public function pizacreatePage() {
        $category = Category::select('id','name')->get();
       return view('admin.product.createpiza',compact('category'));
    }
  //creation of piza
   public function createPiza(Request $req) {
     $this->validatorCheckpiza($req,"create");
      $product = $this->procuctinfotake($req);


          $fileName = uniqid() . $req->file('image')->getClientOriginalName();
          $req->file('image')->storeAs('public',$fileName);
          $product['image'] = $fileName;


        Product::create($product);
        return redirect()->route('piza#list'); }

   //delete pizza
   public function deletepiza($id) {
    $dbimage = Product::where('id',$id)->first();
    $dbimage = $dbimage->image;
       Storage::delete('public/'.$dbimage);

     Product::where('id',$id)->delete();
     return redirect()->route('piza#list')->with(['delete' => 'delete have done successfully']);
   }
   //detail page pizza
   public function detailPizza($id) {
     $pizza = Product::select('products.*','categories.name as category_name')
             ->leftjoin('categories','products.category_id','categories.id')
             ->where('products.id',$id)->first();
             return view('admin.product.detailspizza',compact('pizza'));
   }

   //update page pizza and edit
   public function editpage($id) {
     $pizza = Product::where('id',$id)->first();
     $category = Category::get();
     return view('admin.product.editpiza',compact('pizza','category'));
   }

   //update pizza update pizza
   public function updatepiza(Request $req) {
    $this->validatorCheckpiza($req,"update");

    $piza = $this->procuctinfotake($req);
    if($req->hasFile('image')) {
        //old image name | check => delete | store
         $dbimage = Product::where('id',$req->pizzaId)->first();
         $dbimage = $dbimage->image;
          if($dbimage != null) {
            Storage::delete('public/'.$dbimage);
          }
          $fileName = uniqid() . $req->file('image')->getClientOriginalName();
          $req->file('image')->storeAs('public',$fileName);
          $piza['image'] = $fileName;
       }
    Product::where('id',$req->pizzaId)->update($piza);
    return redirect()->route('piza#list');
   }

   // create of vaiidation
   private function validatorCheckpiza($request,$word)  {
    $validation =
        [
            'name' => 'required|min:5|max:25|unique:products,name,'.$request->pizzaId,
            'category' => 'required',

            'description' => 'required',
            'price' => 'required',
            'waitingTime' => 'required'
        ];
        $validation['image'] = $word == "create" ? 'required|mimes:jpg,jpeg,bmp,png,webp|file' : 'mimes:jpg,jpeg,bmp,png,webp|file' ;

    Validator::make($request->all(),$validation)->validate();
   }
 // create product of info
    public function procuctinfotake($request) {
        $accinfo = [
          'name' => $request->name,
        'category_id' => $request->category,
         'description' => $request->description,
          'price' => $request->price,
          'waiting_time' => $request->waitingTime
        ];
        return $accinfo;
    }

}
