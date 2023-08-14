<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use Auth;
use DB;

class PageController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $pages   = Page::where('pk_account',$account)->get();
   return view('accountadmin.pages.index',['pages'=>$pages]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.pages.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $page       = DB::table('kbt_pages')->where('pk_account',$pk_account)->where('pk_page',$id)->first();
   return view('accountadmin.pages.add',['pk_account' => $pk_account,'page'=>$page]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'page' => 'required|max:30'
   ]);
   // echo "<pre>"; print_r($request->all()); die;
   if(!empty($request->pk_page)){
     $page               = Page::find($request->pk_page);
     $page->pk_account   = $request->pk_account;
     $page->page         = $request->page;
     $page->description  = $request->description;
     $page->active       = $request->active;
     $page->save();
   }
   else{
     $page  = new Page;
     $page->pk_account   = $request->pk_account;
     $page->page         = $request->page;
     $page->description  = $request->description;
     $page->save();
   }
   return redirect('/accountadmin/pages');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_pages')->where('pk_account' , $pk_account)->where('pk_page',$id)->delete();
   return redirect()->route('accountadmin.pages.index')
                  ->with('message','style deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/pages');
 }

}
