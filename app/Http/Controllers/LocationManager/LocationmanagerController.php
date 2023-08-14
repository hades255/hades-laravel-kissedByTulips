<?php

namespace App\Http\Controllers\LocationManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequestOrderRequest;
use App\Product;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class LocationmanagerController extends Controller
{

    public function index(){
        return view('location-manager.index');
    }

    public function vendorOrderRequestList(){
        $pk_users = Auth::user()->pk_users;
        $vendorOrders = PurchaseOrder::where('pk_users', $pk_users)->get();
        return view('location-manager.vendor-request-order.index',['vendorOrders'=>$vendorOrders]);
    }

    public function vendorOrderRequestCreate(){

        $pk_users = Auth::user()->pk_users;
        $vendors = Vendor::all();
        $products = Product::all();
        return view('location-manager.vendor-request-order.add',['vendors'=>$vendors, 'products' => $products]);
    }

    public function vendorOrderRequestStore(VendorRequestOrderRequest $request){
      $pk_locations = $request->pk_locations;
      if ($pk_locations === 'other') {
        $shipping_address = $request->address;
        $address_1 = $request->address_1;
        $city = $request->city;
        $zip = $request->zip;
        $state_name = $request->state_name;
        $country_name = $request->country_name;
      } else {
        $vendor = Vendor::with('state', 'country')->where('pk_vendors', $request->pk_locations)->first();
        $shipping_address = $vendor->address;
        $address_1 = $vendor->address_1;
        $city = $vendor->city;
        $zip = $vendor->zip;
        $state_name = @$vendor->state->state_name;
        $country_name = @$vendor->country->country_name;
      }
      // Start the transaction
      DB::beginTransaction();
  
      try {
  
        $dynamicData = [
          "active" => $request->active ? $request->active : 0,
          "shipping_address" => $shipping_address,
          "shipping_address_1" => $address_1,
          "shipping_city" => $city,
          "shipping_state" => $state_name,
          "shipping_country" => $country_name,
          "shipping_zip" => $zip,
          "pk_account" => auth()->user()->pk_account,
          "pk_users" => auth()->user()->pk_users,
          "created_by" => Auth::user()->pk_users,
        ];
  
        $order = PurchaseOrder::create($request->validated() + $dynamicData);
        $itemsRequest = $request->item_name;
        if ($order && $itemsRequest) {
          for ($i = 0; $i < count($itemsRequest); $i++) {
            $items[$i]['pk_purchase_order'] = $order->pk_purchase_order;
            $items[$i]['name'] = $itemsRequest[$i];
            $items[$i]['description'] = $request->item_description[$i];
            $items[$i]['quantity'] = $request->item_quantity[$i];
            $items[$i]['price'] = $request->item_price[$i];
            $items[$i]['total'] = $request->item_total[$i];
            $items[$i]['created_by'] = Auth::user()->pk_account;
            $items[$i]['created_at'] = Carbon::now();
            $items[$i]['updated_at'] = Carbon::now();
          }
        }
  
        PurchaseOrderItem::insert($items);
  
        DB::commit();
  
        return redirect('/locationmanager/vendor-order-request')->with(['message' => 'Order has been created successfully.', 'messageType' => 'success']);
      } catch (\Exception $e) {
        DB::rollBack();
        $errorMessage = 'Failed to create purchase order. Error: ' . $e->getMessage();
        return redirect()->back()->with(['message' => $errorMessage, 'messageType' => 'danger'])->withInput();
      }
    }

    public function vendorOrderRequestEdit($id)
    {
      $vendors = DB::table('kbt_vendors')->get();
      $products = DB::table('kbt_products')->get();
      $vendorOrder = PurchaseOrder::with('vendor', 'items', 'user')
      ->where('pk_purchase_order', $id)
      ->where('pk_users', Auth::user()->pk_users)
      ->first();
  
      if(!$vendorOrder) abort(404);
  
      return view('location-manager.vendor-request-order.edit', ['vendorOrder' => $vendorOrder, 'vendors' => $vendors, 'products' => $products]);
    }

    public function vendorOrderRequestUpdate(VendorRequestOrderRequest $request)
    {
  
      $pk_purchase_order = $request->pk_purchase_order;
      $pk_locations = $request->pk_locations;
      if ($pk_locations === 'other') {
        $shipping_address = $request->address;
        $address_1 = $request->address_1;
        $city = $request->city;
        $zip = $request->zip;
        $state_name = $request->state_name;
        $country_name = $request->country_name;
      } else {
        $vendor = Vendor::with('state', 'country')->where('pk_vendors', $request->pk_locations)->first();
        $shipping_address = $vendor->address;
        $address_1 = $vendor->address_1;
        $city = $vendor->city;
        $zip = $vendor->zip;
        $state_name = @$vendor->state->state_name;
        $country_name = @$vendor->country->country_name;
      }
      // Start the transaction
      DB::beginTransaction();
  
      try {
  
        $dynamicData = [
          "pk_vendors" => $request->pk_vendors,
          "po_number" => $request->po_number,
          "delivery_date_request" => $request->delivery_date_request,
          "pk_locations" => $request->pk_locations,
          "shipping_address" => $shipping_address,
          "shipping_address_1" => $address_1,
          "shipping_city" => $city,
          "shipping_state" => $state_name,
          "shipping_country" => $country_name,
          "shipping_zip" => $zip,
          "pk_account" => auth()->user()->pk_account,
          "pk_users" => auth()->user()->pk_users,
          "updated_by" => Auth::user()->pk_users,
          "active" => $request->active ? $request->active : 0,
        ];
  
        $order = PurchaseOrder::where('pk_purchase_order', $pk_purchase_order)->update($dynamicData);
        PurchaseOrderItem::where('pk_purchase_order', $pk_purchase_order)->delete();
  
        $itemsRequest = $request->item_name;
        if ($order && $itemsRequest) {
          for ($i = 0; $i < count($itemsRequest); $i++) {
            $items[$i]['pk_purchase_order'] = $pk_purchase_order;
            $items[$i]['name'] = $itemsRequest[$i];
            $items[$i]['description'] = $request->item_description[$i];
            $items[$i]['quantity'] = $request->item_quantity[$i];
            $items[$i]['price'] = $request->item_price[$i];
            $items[$i]['total'] = $request->item_total[$i];
            $items[$i]['updated_by'] = Auth::user()->pk_account;
            $items[$i]['created_at'] = Carbon::now();
            $items[$i]['updated_at'] = Carbon::now();
          }
        }
  
        PurchaseOrderItem::insert($items);
  
        DB::commit();
  
        return redirect('/locationmanager/vendor-order-request')->with(['message' => 'Purchase order has been updated successfully.', 'messageType' => 'success']);
      } catch (\Exception $e) {
        DB::rollBack();
        $errorMessage = 'Failed to update purchase order. Error: ' . $e->getMessage();
        return redirect()->back()->with(['message' => $errorMessage, 'messageType' => 'danger'])->withInput();
      }
    }

    public function vendorOrderRequestShow($id)
    {
      $vendorOrder = PurchaseOrder::with('vendor', 'items', 'user')
      ->where('pk_purchase_order', $id)
      ->where('pk_users', auth()->user()->pk_users)
      ->first();

      if(!$vendorOrder) abort(404);

      return view('location-manager.vendor-request-order.view', ['vendorOrder' => $vendorOrder]);
    }
    
    public function vendorOrderRequestDelete($id)
    {
      DB::beginTransaction();
  
      try {
        PurchaseOrder::where('pk_purchase_order', $id)->delete();
        PurchaseOrderItem::where('pk_purchase_order', $id)->delete();
        DB::commit();
  
        return redirect('/locationmanager/vendor-order-request')->with(['message' => 'Purchase order has been deleted successfully.', 'messageType' => 'success']);
      } catch (\Exception $e) {
        DB::rollBack();
        $errorMessage = 'Failed to create purchase order. Error: ' . $e->getMessage();
        return redirect()->back()->with(['message' => $errorMessage, 'messageType' => 'danger'])->withInput();
      }
    }
  
}
