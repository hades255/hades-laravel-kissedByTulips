<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\FlowerSubscription;
use App\Frequency;
use App\Uom;


class FlowerSubscriptionController extends Controller
{
  public function index(){
    $account             = Auth::user();
    $flowerSubscriptions  = DB::table('kbt_flower_subscription')
                            ->join('kbt_frequency' , 'kbt_flower_subscription.pk_frequency','kbt_frequency.pk_frequency')
                            ->join('kbt_uom','kbt_frequency.pk_frequency','kbt_uom.pk_frequency')
                            ->get();

    return view('accountadmin.flower-subscription.index',['flowerSubscriptions'=>$flowerSubscriptions,'account'=>$account]);
  }

  public function create(){
    $frequencies = Frequency::all();
    $uoms        = Uom::all();
    return view('accountadmin.flower-subscription.add',['frequencies'=>$frequencies,'uoms'=>$uoms]);
  }

  public function edit($id){
    $account            = Auth::user()->pk_account;
    $frequencies        = Frequency::all();
    $uoms               = Uom::all();
    $flowerSubscription = DB::table('kbt_flower_subscription')
                          ->join('kbt_frequency' , 'kbt_flower_subscription.pk_frequency','kbt_frequency.pk_frequency')
                          ->join('kbt_uom','kbt_frequency.pk_frequency','kbt_uom.pk_frequency')
                          ->where('kbt_flower_subscription.pk_flower_subscription',$id)
                          ->select('kbt_flower_subscription.path','kbt_flower_subscription.pk_flower_subscription as pk_flower_subscription','kbt_frequency.frequency as frequency','kbt_frequency.pk_frequency as pk_frequency','kbt_flower_subscription.price as price','kbt_flower_subscription.active as active','kbt_flower_subscription.description as description','kbt_flower_subscription.pk_uom as pk_uom','kbt_uom.uom as uom')
                          ->first();
  //  echo "<pre>"; print_r($flowerSubscription); die;
    return view('accountadmin.flower-subscription.add',['uoms'=>$uoms,'account'=>$account,'frequencies'=>$frequencies,'flowerSubscription'=>$flowerSubscription]);
  }

  public function store(Request $request){
    $pk_account = Auth::user()->pk_account;
    $validated = $request->validate([
       'price'     => 'required|between:0,99.99',
       'frequency' => 'required',
       'image'     => 'required'
    ]);
    $FlowerSubscription               = new FlowerSubscription;
    $FlowerSubscription->pk_account   = $pk_account;
    $FlowerSubscription->price        = $request->price;
    $FlowerSubscription->pk_uom       = $request->uom;
    $FlowerSubscription->pk_frequency = $request->frequency;
      if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('flower-subscription'), $filename);
            $FlowerSubscription->path = $filename;
     }
    $FlowerSubscription->active       = $request->active;
    $FlowerSubscription->save();
    return redirect('/accountadmin/flower-subscription');
  }

  public function update(Request $request){
  //  echo "<pre>"; print_r($request->all()); die;
    $pk_account = Auth::user()->pk_account;
    $validated = $request->validate([
       'price'     => 'required|between:0,99.99',
       'frequency' => 'required',
    ]);
    if(!empty($request->pk_flower_subscription)){
      $FlowerSubscription               = FlowerSubscription::find($request->pk_flower_subscription);
    //  echo "<pre>"; print_r($request->all()); die;
      $FlowerSubscription->pk_account   = $pk_account;
      $FlowerSubscription->price        = $request->price;
      $FlowerSubscription->pk_frequency = $request->frequency;
      $FlowerSubscription->pk_uom       = $request->uom;
      $FlowerSubscription->description  = $request->description;
       if($request->file('image')){
             $file= $request->file('image');
             $filename= date('YmdHi').$file->getClientOriginalName();
             $file->move(public_path('flower-subscription'), $filename);
             $FlowerSubscription->path = $filename;
      }
      $FlowerSubscription->active       = $request->active;
      $FlowerSubscription->save();
    }
    return redirect('/accountadmin/flower-subscription');
  }

  public function delete(Request $request,$id){
    DB::table('kbt_flower_subscription')->where('pk_flower_subscription',$id)->delete();
    return redirect()->route('accountadmin.flower-subscription.index')
                   ->with('message','Flower-subscription deleted successfully');
  }

  public function back(){
    return redirect('/accountadmin/flower-subscription');
  }
}
