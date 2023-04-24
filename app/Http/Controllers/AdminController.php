<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
      //show  password change Page
      public function passwordpage() {
        return view('admin.account.change');
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

//show details page
public function details() {
      return view('admin.account.details');
}
//show edit page
public function accedit() {
    return view('admin.account.edit');
}

//update acc info
public function accupdate($id,Request $req) {
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
   return redirect()->route('acc#details');
}

    //admin list page
    public function adminlist() {

        $admins =User::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
                    // $query->orWhere('name','like','%'.request('key').'%')
                    //       ->orWhere('email','like','%'.request('key').'%')
                    //       ->orWhere('gender','like','%'.request('key').'%')
                    //       ->orWhere('address','like','%'.request('key').'%')
                    //       ->orWhere('phone','like','%'.request('key').'%');
                })->where('role','admin')->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.adminlist',compact('admins'));
       }

       //admin delete
       public function adminDelete($id) {

        $dbimage = User::where('id',$id)->first();
        $dbimage = $dbimage->image;
           Storage::delete('public/'.$dbimage);
         User::where('id',$id)->delete();
        return redirect()->route('admin#list');
       }

    //admin change row page
    public function changeRow($id) {
        $account = User::where('id',$id)->first();
        return view('admin.account.adminrole',compact('account'));
    }
 //admin row update
  public function rowUpdate($id,Request $req) {

    User::where('id',$id)->update(['role' => $req->role ]);
    return redirect()->route('admin#list');
  }

  //change user to admin  page
  public function userlist() {
    $users =User::when(request('key'),function($query){
        $query->where('name','like','%'.request('key').'%');
    })->where('role','user')->paginate(3);
    $users->appends(request()->all());
    return view('admin.account.userlist',compact('users'));
  }

  public function userRolechange(Request $req) {
    $role = [
        'role' => $req->role
    ];
     User::where('id',$req->userid)->update($role);
  }
  //user delete
  public function userdelete($id) {
    User::where('id',$id)->delete();
    return redirect()->route('user#list');
  }
//user messsage
public function usermessage() {
     $contact = Contact::paginate('3');
    return view('admin.account.usermessage',compact('contact'));
}



   //update acc info validation check
   private function accValidation($request) {
     $acc = [
        'Name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'email' => 'required',
        'image'=>"mimes:jpg,bmp.png|file",
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
