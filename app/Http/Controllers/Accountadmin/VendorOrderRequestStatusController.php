<?php

namespace App\Http\Controllers\Accountadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\PurchaseOrderStatus;

class VendorOrderRequestStatusController extends Controller
{
  public function index()
  {
      $account   = Auth::user()->pk_account;
      $purchaseOrderStatus = PurchaseOrderStatus::where('pk_account', $account)->get();
    //  echo "<pre>"; print_r($purchaseOrderStatus); die;
      return view('accountadmin.vendor-request-order-status.index', ['purchaseOrderStatus' => $purchaseOrderStatus]);
  }


  public function create()
  {
      $pk_account = Auth::user()->pk_account;
      return view('accountadmin.vendor-request-order-status.add', ['pk_account' => $pk_account]);
  }


  public function edit($id)
  {
      $pk_account    = Auth::user()->pk_account;
      $vendorRequest = DB::table('kbt_purchase_order_status')->where('pk_account', $pk_account)->where('pk_purchase_order_status', $id)->first();
      return view('accountadmin.vendor-request-order-status.add', ['pk_account' => $pk_account, 'vendorRequest' => $vendorRequest]);
  }

  public function store(Request $request)
  {
    //echo "<pre>";print_r($request->all()); die;
      $validated = $request->validate([
          'purchase_order_status' => 'required|max:30'
      ]);
      if (!empty($request->pk_purchase_order_status)) {
          $purchaseOrderStatus              = PurchaseOrderStatus::find($request->pk_purchase_order_status);
          $purchaseOrderStatus->pk_account  = auth()->user()->pk_account;
          $purchaseOrderStatus->pk_users    = auth()->user()->pk_users;
          $purchaseOrderStatus->purchase_order_status   = $request->purchase_order_status;
          $purchaseOrderStatus->description = $request->description;
          $purchaseOrderStatus->active      = $request->active;
          $purchaseOrderStatus->save();
      } else {
          $purchaseOrderStatus              = new purchaseOrderStatus;
          $purchaseOrderStatus->pk_account  = $request->pk_account;
          $purchaseOrderStatus->pk_users    = auth()->user()->pk_users;
          $purchaseOrderStatus->purchase_order_status   = $request->purchase_order_status;
          $purchaseOrderStatus->description = $request->description;
          $purchaseOrderStatus->save();
      }
      return redirect('/accountadmin/vendor-request-order-status');
  }

  public function delete($id)
  {
      $pk_account = Auth::user()->pk_account;
      DB::table('kbt_purchase_order_status')->where('pk_account', $pk_account)->where('pk_purchase_order_status', $id)->delete();
      return redirect()->route('accountadmin.vendor-request-order-status.index')
          ->with('message', 'products-categories deleted successfully');
  }

  public function back()
  {
      return redirect('/accountadmin/vase-types');
  }
}
