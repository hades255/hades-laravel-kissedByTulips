<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Product;
use App\Flower;
use App\ColorFlower;
use App\ProductImage;
use Auth;
use DB;

class ProductController extends Controller
{
  public function index(){
   $account  = Auth::user()->pk_account;
   $products = Product::with('images')->get();
   return view('accountadmin.products.index',['products'=>$products]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   $product_categoies = ProductCategory::all();
   $flowers = Flower::all();
   $colorflowers = ColorFlower::all();
   $locations= DB::table('kbt_locations')->get();
   return view('accountadmin.products.add',['pk_account' => $pk_account,'product_categoies'=>$product_categoies,'flowers'=>$flowers,'colorflowers'=>$colorflowers,'locations'=>$locations]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $flowers = Flower::all();
   $colorflowers = ColorFlower::all();
   $product_categoies = ProductCategory::all();
   //$product    = DB::table('kbt_products')->where('pk_account',$pk_account)->where('pk_products',$id)->first()
   $product = Product::with('images')
              ->where('kbt_products.pk_products',$id)
              ->first();
   $locations= DB::table('kbt_locations')->get();
   return view('accountadmin.products.add',['pk_account' => $pk_account,'product'=>$product,'product_categoies'=>$product_categoies,'flowers'=>$flowers,'colorflowers'=>$colorflowers,'locations'=>$locations]);
 }

 public function store(Request $request){
   $validated = $request->validate([
     'location'=> 'required',
     'product' => 'required|max:30',
     'product_category' => 'required',
     'price' => 'required|numeric',
     ]);
  if(!empty($request->pk_products)){
    $product  = Product::find($request->pk_products);
    $product->pk_account          = Auth::user()->pk_account;
    $product->pk_locations        = $request->location;
    $product->product             = $request->product;
    $product->description         = $request->description;
    $product->location_bar_code   = $request->location_bar_code;
    $product->pk_product_category = $request->product_category;
    $product->pk_flowers          = $request->flowers;
    $product->pk_color_flower     = $request->color_flowers;
    $product->price               = $request->price;
    $product->active              = $request->active;
    $product->save();
    // print_r($request->pk_products);



   //  echo "<pre>"; print_r($data); die;
        if($request->file('images')){
        //   $oldImages = ProductImage::whereIn('pk_products',[$request->pk_products])->get();
        //       foreach ($oldImages as $oldImage) {
        //         $oldImage->delete();
        //        }
               $files = $request->file('images');
               foreach ($files as $file) {
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('products'), $filename);
                 $product->images()->create([
                  'path' => $filename,
                  'pk_products' => $product->pk_products,
                  'pk_account' => Auth::user()->pk_account,
                ]);
               }
       }
  }
  else{
     $validated2 = $request->validate([
     'images' => 'required',
     'location_bar_code'   => 'required',
     ]);
    $product  = new Product;
    $product->pk_account          = Auth::user()->pk_account;
    $product->pk_locations        = $request->location;
    $product->product             = $request->product;
    $product->description         = $request->description;
    $product->location_bar_code   = $request->location_bar_code;
    $product->pk_product_category = $request->product_category;
    $product->pk_flowers          = $request->flowers;
    $product->pk_color_flower     = $request->color_flowers;
    $product->price               = $request->price;
    $product->active              = $request->active;
    $product->save();


        if($request->file('images')){
               $files= $request->file('images');
               foreach ($files as $file) {
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('products'), $filename);
                $data = new ProductImage();
                $data->path = $filename;
                $data->pk_products = $product->pk_products;
                $data->pk_account  = Auth::user()->pk_account;
                $data->save();
               }

       }


   }
   return redirect('/accountadmin/products');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_products')->where('pk_account' , $pk_account)->where('pk_products',$id)->delete();
   return redirect()->route('admin.products.index')
                  ->with('message','products-categories deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/products');
 }

 public function productImageDelete($id){
   $image = ProductImage::findOrFail($id);

   // Delete image file from storage
   //Storage::delete($image->path);

   // Delete image record from the database
   $image->delete();

   return redirect()->back()->with('success', 'Image deleted successfully.');
 }

}
