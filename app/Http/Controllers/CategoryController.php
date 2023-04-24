<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
   public function list() {
       $categories = Category::when(request('key'),function($query){
        $query->where('name','like','%'.request('key').'%');
     })
          ->orderBy('id','desc')->paginate(3);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }
    public function createpage() {
        return view('admin.category.addcreate');
    }
    //create categroy
    public function categorycreate(Request $req) {
      $this->CategroyValidationCheck($req);
      $post = $this->Categorymake($req);
      Category::create($post);
      return redirect()->route('list#page');

    }
    //delete category
    public function categorydelete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('list#page')->with(['delete' => 'delete have done successfully']);
    }

    //edit category
    public function categoryedit($id) {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }
   //update category
     public function categoryupdate(Request $req) {
        $id = $req->editId;
       $this->CategroyValidationCheck($req);
       $category = $this->Categorymake($req);
        Category::where('id',$id)->update($category);
        return redirect()->route('list#page');
     }

   //create validation check
   private function CategroyValidationCheck($request) {
   Validator::make($request->all(),['CategoryName' => 'required|min:5|max:25|unique:categories,name,'.$request->editId ])->validate();
   }

   //create piza
   private function Categorymake($request) {
    return[
        'name' => $request->CategoryName,
    ];
   }


}
