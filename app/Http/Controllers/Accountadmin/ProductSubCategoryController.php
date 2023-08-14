<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\ProductSubCategory;
use Auth;
use DB;

class ProductSubCategoryController extends Controller
{
  public function index(){
   $account =Auth::user()->pk_account;
   //$productCategories = ProductCategory::where('pk_account',$account)->get();
   //$productSubCategories = ProductSubCategory::where('pk_account',$account)->get();
   $productSubCategories = DB::table('kbt_product_sub_category')
                           ->join('kbt_product_category','kbt_product_category.pk_product_category','kbt_product_sub_category.pk_product_category')
                           ->get();
   return view('accountadmin.productsubcategory.index',['productSubCategories'=>$productSubCategories]);
  }


 public function create(){
   $account = Auth::user()->pk_account;
   $product_categories = ProductCategory::where('pk_account',$account)->get();
   return view('accountadmin.productsubcategory.add',['account' => $account,'product_categories'=>$product_categories]);
 }


 public function edit($id){
   $account = Auth::user()->pk_account;
   $product_categories = ProductCategory::where('pk_account',$account)->get();
   $productCategory = DB::table('kbt_product_sub_category')
                           ->join('kbt_product_category','kbt_product_category.pk_product_category','kbt_product_sub_category.pk_product_category')
                           ->where('kbt_product_sub_category.pk_product_sub_category',$id)
                           ->first();
   //echo "<pre>"; print_r($productCategory); die;
   return view('accountadmin.productsubcategory.add',['account' => $account,'productCategory'=>$productCategory,'product_categories'=>$product_categories]);
 }

 public function store(Request $request){
  // echo "<pre>"; print_r($request->all()); die;
   $validated = $request->validate([
      'product_category' =>'required',
      'product_sub_category' => 'required|max:30'
   ]);
   if(!empty($request->pk_product_sub_category)){
     $productsubcategory  = ProductSubCategory::find($request->pk_product_sub_category);
     $productsubcategory->pk_account           = $request->pk_account;
     $productsubcategory->product_sub_category = $request->product_sub_category;
     $productsubcategory->pk_product_category  = $request->product_category;
     $productsubcategory->description          = $request->description;
     $productsubcategory->active               = $request->active;
     $productsubcategory->save();
   }
   else{
     $productsubcategory  = new ProductSubCategory;
     $productsubcategory->pk_account           = $request->pk_account;
     $productsubcategory->product_sub_category = $request->product_sub_category;
     $productsubcategory->pk_product_category  = $request->product_category;
     $productsubcategory->description          = $request->description;
     $productsubcategory->active               = $request->active;
     $productsubcategory->save();
   }
   return redirect('/accountadmin/product-sub-category');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_product_sub_category')->where('pk_account' , $pk_account)->where('pk_product_sub_category',$id)->delete();
   return redirect()->route('accountadmin.product-sub-category.index')
                  ->with('message','products-categories deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/product-sub-category');
 }

}
