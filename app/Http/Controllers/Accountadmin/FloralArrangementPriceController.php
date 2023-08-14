<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\FloralArrangementsPrice;

class FloralArrangementPriceController extends Controller
{
  public function index(){
   $account  = Auth::user()->pk_account;
   $floralArrangements = DB::table('kbt_floral_arrangements')
                        ->join('kbt_floral_arrangements_images','kbt_floral_arrangements_images.pk_floral_arrangements','kbt_floral_arrangements.pk_floral_arrangements')
                        ->get();
   return view('accountadmin.floral-arrangements.index',['floralArrangements'=>$floralArrangements]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   $product_categoies = ProductCategory::all();
   $flowers = Flower::all();
   $colorflowers = ColorFlower::all();
   $arrangementTypes = ArrangementType::all();
   return view('accountadmin.floral-arrangements.add',['arrangementTypes'=>$arrangementTypes,'pk_account' => $pk_account,'product_categoies'=>$product_categoies,'flowers'=>$flowers,'colorflowers'=>$colorflowers]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $flowers = Flower::all();
   $colorflowers = ColorFlower::all();
   $product_categoies = ProductCategory::all();
   //$product    = DB::table('kbt_products')->where('pk_account',$pk_account)->where('pk_products',$id)->first()
   $floralArrangement =  DB::table('kbt_floral_arrangements')
                         ->join('kbt_floral_arrangements_images','kbt_floral_arrangements_images.pk_floral_arrangements','kbt_floral_arrangements.pk_floral_arrangements')
                         ->where('kbt_floral_arrangements.pk_floral_arrangements',$id)
                         ->first();
   return view('accountadmin.floral-arrangements.add',['pk_account' => $pk_account,'floralArrangement'=>$floralArrangement,'product_categoies'=>$product_categoies,'flowers'=>$flowers,'colorflowers'=>$colorflowers]);
 }

 public function store(Request $request){
   //echo "<pre>"; print_r($request->all()); die;
   $validated = $request->validate([
      'floral_arrangements' => 'required|max:30',
      'product_category' => 'required',
      'flowers'  => 'required',
      'price' => 'required|numeric'
   ]);
   if(!empty($request->pk_products)){
     $product  = FloralArrangement::find($request->pk_products);
     $product->pk_account          = Auth::user()->pk_account;
     $product->floral_arrangements = $request->floral_arrangements;
     $product->description         = $request->description;
     $product->pk_product_category = $request->product_category;
     $product->pk_flowers          = $request->flowers;
     $product->price               = $request->price;
     $product->active              = $request->active;
     $product->save();
     // print_r($request->pk_products);
    //   $data = ProductImage::where('pk_products',$request->pk_products)->first();
    // //  echo "<pre>"; print_r($data); die;
    //      if($request->file('images')){
    //             $file= $request->file('images');
    //             $filename= date('YmdHi').$file->getClientOriginalName();
    //             $file->move(public_path('products'), $filename);
    //             $data->path = $filename;
    //             $data->pk_products = $product->pk_products;
    //             $data->pk_account  = Auth::user()->pk_account;
    //             $data->save();
    //     }
   }
   else{
     $product  = new FloralArrangement;
     $product->pk_account          = Auth::user()->pk_account;
     $product->product             = $request->product;
     $product->description         = $request->description;
     $product->pk_product_category = $request->product_category;
     $product->pk_flowers          = $request->color_flowers;
     $product->pk_color_flower     = $request->color_flowers;
     $product->price               = $request->price;
     $product->active              = $request->active;
     $product->save();

     // $data = new ProductImage();
     //     if($request->file('images')){
     //            $file= $request->file('images');
     //            $filename= date('YmdHi').$file->getClientOriginalName();
     //            $file-> move(public_path('products'), $filename);
     //            $data['path'] = $filename;
     //            $data['pk_products'] = $product->pk_products;
     //            $data['pk_account']  = Auth::user()->pk_account;
     //    }
     //
     //    $data->save();
   }
   return redirect('/accountadmin/floral-arrangements');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_floral_arrangements')->where('pk_account' , $pk_account)->where('pk_floral_arrangements',$id)->delete();
   return redirect()->route('admin.floral-arrangements.index')
                  ->with('message','products-categories deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/floral-arrangements');
 }
}
