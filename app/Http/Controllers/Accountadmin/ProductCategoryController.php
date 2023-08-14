<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use Auth;
use DB;

class ProductCategoryController extends Controller
{
     public function index(){
      $account =Auth::user()->pk_account;
      $productCategories = ProductCategory::where('pk_account',$account)->get();
      return view('accountadmin.productcategory.index',['productCategories'=>$productCategories]);
     }


    public function create(){
      $pk_account = Auth::user()->pk_account;
      return view('accountadmin.productcategory.add',['pk_account' => $pk_account]);
    }


    public function edit($id){
      $pk_account = Auth::user()->pk_account;
      $productCategory = DB::table('kbt_product_category')->where('pk_account',$pk_account)->where('pk_product_category',$id)->first();
      return view('accountadmin.productcategory.add',['pk_account' => $pk_account,'productCategory'=>$productCategory]);
    }

    public function store(Request $request){
      $validated = $request->validate([
         'product_category' => 'required|max:30'
      ]);
      if(!empty($request->pk_product_category)){
        $productcategory  = ProductCategory::find($request->pk_product_category);
        $productcategory->pk_account       = $request->pk_account;
        $productcategory->product_category = $request->product_category;
        $productcategory->description      = $request->description;
        $productcategory->active           = $request->active;
        $productcategory->save();
      }
      else{
        $productcategory  = new ProductCategory;
        $productcategory->pk_account       = $request->pk_account;
        $productcategory->product_category = $request->product_category;
        $productcategory->description      = $request->description;
        $productcategory->save();
      }
      return redirect('/accountadmin/products-categories');
    }

    public function delete($id){
      $pk_account = Auth::user()->pk_account;
      DB::table('kbt_product_category')->where('pk_account' , $pk_account)->where('pk_product_category',$id)->delete();
      return redirect()->route('accountadmin.products-categories.index')
                     ->with('message','products-categories deleted successfully');
    }

    public function back(){
      return redirect('/accountadmin/products-categories');
    }



}
