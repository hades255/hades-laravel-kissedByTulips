<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PurchaseOrder;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        return view('vendor.index');
    }

    public function vendorOrderRequestList()
    {
        $vendorOrders = PurchaseOrder::where('pk_vendors', Auth::user()->pk_vendors)->get();
        return view('vendor.vendor-request-order.index', ['vendorOrders' => $vendorOrders]);
    }


    public function vendorOrderRequestShow($id)
    {
      $vendorOrder = PurchaseOrder::with('vendor', 'items', 'user')
      ->where('pk_purchase_order', $id)
      ->where('pk_vendors', Auth::user()->pk_vendors)
      ->first();

      if(!$vendorOrder) abort(404);

      return view('vendor.vendor-request-order.view', ['vendorOrder' => $vendorOrder]);
    }
}
