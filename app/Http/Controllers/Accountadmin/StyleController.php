<?php
namespace App\Http\Controllers\Accountadmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Style;
use Auth;
use DB;

class StyleController extends Controller
{
  public function index(){
   $account = Auth::user()->pk_account;
   $styles = Style::where('pk_account',$account)->get();
   return view('accountadmin.styles.index',['styles'=>$styles]);
  }


 public function create(){
   $pk_account = Auth::user()->pk_account;
   return view('accountadmin.styles.add',['pk_account' => $pk_account]);
 }


 public function edit($id){
   $pk_account = Auth::user()->pk_account;
   $style = DB::table('kbt_styles')->where('pk_account',$pk_account)->where('pk_styles',$id)->first();
   //echo "<pre>";print_r($style); die;
   return view('accountadmin.styles.add',['pk_account' => $pk_account,'style'=>$style]);
 }

 public function store(Request $request){
   $validated = $request->validate([
      'style' => 'required|max:30'
   ]);
   if(!empty($request->pk_styles)){
     $style  = Style::find($request->pk_size_arrangement);
     $style->pk_account   = $request->pk_account;
     $style->styles        = $request->style;
     $style->description  = $request->description;
     $style->active       = $request->active;
     $style->save();
   }
   else{
     $style  = new Style;
     $style->pk_account   = $request->pk_account;
     $style->styles       = $request->style;
     $style->description  = $request->description;
     $style->save();
   }
   return redirect('/accountadmin/styles');
 }

 public function delete($id){
   $pk_account = Auth::user()->pk_account;
   DB::table('kbt_styles')->where('pk_account' , $pk_account)->where('pk_styles',$id)->delete();
   return redirect()->route('accountadmin.style.index')
                  ->with('message','style deleted successfully');
 }

 public function back(){
   return redirect('/accountadmin/styles');
 }

}
