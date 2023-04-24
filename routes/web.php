<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Custom\AjaxController;
use App\Http\Controllers\Custom\CustomerController;

//piza order systerm login and register

Route::middleware(['admin_auth'])->group(function () {
Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('login#Page');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('register#page');
});


Route::middleware(['auth'])->group(function () {


    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    //admin acc
     Route::middleware(['admin_auth'])->group(function () {
        //admin password change
       Route::get('password/page',[AdminController::class,'passwordpage'])->name('password#page');
       Route::post('password/change',[AdminController::class,'Changepassword'])->name('password#change');
       //admin details acc
       Route::get('accdetails',[AdminController::class,'details'],'details')->name('acc#details');
       Route::get('accedit',[AdminController::class,'accedit'])->name('acc#edit');
       Route::post('accupdate/{id}',[AdminController::class,'accupdate'])->name('acc#update');
       //admin list
       Route::get('adminlist',[AdminController::class,'adminlist'])->name('admin#list');
       Route::get('admindelete/{id}',[AdminController::class,'adminDelete'])->name('admin#delete');

       //admin chnage role page
       Route::prefix('admin')->group(function () {
           Route::get('change/rowpage/{id}',[AdminController::class,'changeRow'])->name('change#row');
           Route::post('updaterow/{id}',[AdminController::class,'rowUpdate'])->name('row#update');

       });
      //userrole to adminrole change  admin pannel
       Route::get('userlist',[AdminController::class,'userlist'])->name('user#list');
       //user role change admin
       Route::get('user/role/change',[AdminController::class,'userRolechange'])->name('user#rolechange');
       //user delete
       Route::get('user/delete/{id}',[AdminController::class,'userdelete'])->name('user#delete');
       //user message
       Route::get('user/message',[AdminController::class,'usermessage'])->name('user#message');


     });
     //admin create product |admin create product
     Route::group(['prefix' => 'product','middleware' => 'admin_auth'],function(){
     Route::get('pizalist',[ProductController::class,'pizalist'])->name('piza#list');
     Route::get('createpizaPage',[ProductController::class,'pizacreatePage'])->name('piza#createPage');
     Route::post('createPiza',[ProductController::class,'createPiza'])->name('create#Piza');
     Route::get('deletepiza/{id}',[ProductController::class,'deletepiza'])->name('delete#pizza');
     Route::get('details/piza{id}',[ProductController::class,'detailPizza'])->name('details#pizza');
     Route::get('editpage/{id}',[ProductController::class,'editpage'])->name('edit#pagepizza');
     Route::post('update',[ProductController::class,'updatepiza'])->name('update#piza');
     });



    // admin category
    Route::group(['prefix' => 'Category','middleware'=>'admin_auth'],function() {
        //category
    Route::get('listPage',[CategoryController::class,'list'])->name('list#page');
    Route::get('createPage',[CategoryController::class,'createpage'])->name('create#page');
    Route::post('categorycreate',[CategoryController::class,'categorycreate'])->name('category#create');
    Route::get('categorydelete/{id}',[CategoryController::class,'categorydelete'])->name('categroy#delete');
    Route::get('categoryedit/{id},',[CategoryController::class,'categoryedit'])->name('category#edit');
    Route::post('categoryupdate',[CategoryController::class,'categoryupdate'])->name('category#update');
});
     //admin see order list
   Route::group(['prefix' => 'admin','middleware'=>'admin_auth'],function() {
         //admin see order list page
   Route::get('orderlist',[OrderController::class,'orderlist'])->name('adminOrder#list');
   Route::get('status/list',[OrderController::class,'statusorderlist'])->name('status#orderlsit');
   Route::get('status/change',[OrderController::class,'statusChange'])->name('status#change');
   Route::get('listinfo/{ordercode}',[OrderController::class,'listinfo'])->name('list#info');


});

   //user user user user user user user user user

    //user home
    Route::group(['prefix' => 'user','middleware' => 'user_auth'],function(){
    Route::get('home',[CustomerController::class,'home'])->name('customer#home');
    Route::get('pizzadetail/{id}',[CustomerController::class,'pizzadetails'])->name('pizza#deatails');
    //cart history
    Route::get('history',[CustomerController::class,'carthistory'])->name('cart#history');
    //filter category
    Route::get('filter/{id}',[CustomerController::class,'filter'])->name('category#filter');

    Route::prefix('cart')->group(function() {
    Route::get('list',[CustomerController::class,'cartlist'])->name('cart#list');
        });

    Route::prefix('password')->group(function() {
    //change page
    Route::get('changepage',[CustomerController::class,'changePage'])->name('change#page');
    Route::post('changepassword',[CustomerController::class,'Changepassword'])->name('passowrd#change');
    });

    //acc ediit and update
    Route::prefix('account')->group(function () {
    Route::get('editpage',[CustomerController::class,'editPage'])->name('edit#page');
    Route::post('updateinfo/{id}',[CustomerController::class,'updateinfo'])->name('update#info');
    });
//ajax jquery
      Route::prefix('ajax')->group(function () {
      Route::get('pizzalist',[AjaxController::class,'pizzalist'])->name('pizza#list');
     //cart pizza  order
      Route::get('addcart',[AjaxController::class,'addcart'])->name('add#cart');
//cartto order list
      Route::get('order',[AjaxController::class,'orderlist'])->name('order#list');
      Route::get('clearcart',[AjaxController::class,'clearcart'])->name('clear#cart');
      Route::get('clear/ordercart',[AjaxController::class,'clearOrderCart'])->name('clear#ordercart');

      });
     //view count
     Route::get('ajax/view/count',[AjaxController::class,'viewcount'])->name('view#count');
    //contact message page
     Route::get('contact/admin',[CustomerController::class,'contact'])->name('admin#contact');
     ///create contact message
     Route::post('contact/{id}',[CustomerController::class,'contactCreate'])->name('contact#create');


});




















































});






