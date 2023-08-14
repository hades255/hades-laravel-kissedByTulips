<?php

namespace App\Http\Controllers\Accountadmin;

use App\Location;
use App\PurchaseOrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequestOrderRequest;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorOrderRequestOrderController extends Controller
{
    public function index()
    {
        $vendorOrders = PurchaseOrder::with(['vendor', 'items', 'user', 'status'])->latest()->get();

        return view('accountadmin.vendor-request-order.index', ['vendorOrders' => $vendorOrders]);
    }

    public function show($id)
    {
        $vendorOrder = PurchaseOrder::with('vendor', 'items', 'user')->where('pk_purchase_order', $id)->first();

        return view('accountadmin.vendor-request-order.view', ['vendorOrder' => $vendorOrder]);
    }


    public function create()
    {
        $pk_account = Auth::user()->pk_account;
        $vendors    = DB::table('kbt_vendors')->get();
        $products   = DB::table('kbt_products')->get();
        $locations  = Location::all();
        return view('accountadmin.vendor-request-order.add', compact('products', 'vendors', 'pk_account', 'locations'));
    }


    public function edit($id)
    {
        $vendors     = DB::table('kbt_vendors')->get();
        $products    = DB::table('kbt_products')->get();
        $vendorOrder = PurchaseOrder::with('vendor', 'items', 'user')->where('pk_purchase_order', $id)->first();
        $locations   = Location::all();

        return view('accountadmin.vendor-request-order.edit', compact('vendorOrder', 'vendors', 'products', 'locations'));
    }

    public function store(VendorRequestOrderRequest $request)
    {
        $location         = Location::with(['state', 'country'])->where('pk_locations', $request->pk_locations)->first();
        $shipping_address = $location->address;
        $address_1        = $location->address_1;
        $city             = $location->city;
        $zip              = $location->zip;
        $state_name       = @$location->state->state_name;
        $country_name     = @$location->country->country_name;

        if ($request->pk_locations === 'other') {
            $shipping_address = $request->address;
            $address_1        = $request->address_1;
            $city             = $request->city;
            $zip              = $request->zip;
            $state_name       = $request->state_name;
            $country_name     = $request->country_name;
        }

        // Start the transaction
        DB::beginTransaction();

        try {

            $dynamicData = [
                "active"                   => $request->active ? $request->active : 1,
                "pk_purchase_order_status" => PurchaseOrderStatus::where('purchase_order_status', 'New')
                    ->first()->pk_purchase_order_status,
                "shipping_address"         => $shipping_address,
                "shipping_address_1"       => $address_1,
                "shipping_city"            => $city,
                "shipping_state"           => $state_name,
                "shipping_country"         => $country_name,
                "shipping_zip"             => $zip,
                "pk_account"               => auth()->user()->pk_account,
                "pk_users"                 => auth()->user()->pk_users,
                "created_by"               => Auth::user()->pk_users,
            ];

            $order = PurchaseOrder::create($request->validated() + $dynamicData);

            $itemsRequest = $request->item_name;

            if ($order && $itemsRequest) {
                foreach ($itemsRequest as $key => $item) {
                    $items[] = [
                        'pk_purchase_order' => $order->pk_purchase_order,
                        'name'              => $item,
                        'description'       => $request->item_description[$key] ?? 'N/A',
                        'quantity'          => $request->item_quantity[$key],
                        'price'             => $request->item_price[$key],
                        'total'             => $request->item_total[$key],
                        'created_by'        => Auth::user()->pk_account,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now(),
                    ];
                }
            }

            PurchaseOrderItem::insert($items);

            DB::commit();

            return $this->back()->with(['message' => 'Purchase order created successfully.', 'messageType' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = 'Failed to create purchase order. Error: ' . $e->getMessage();
            return redirect()->back()->with(['message' => $errorMessage, 'messageType' => 'danger'])->withInput();
        }
    }

    public function update(VendorRequestOrderRequest $request)
    {

        $pk_purchase_order = $request->pk_purchase_order;
        $pk_locations      = $request->pk_locations;
        $location          = Location::with(['state', 'country'])->where('pk_locations', $request->pk_locations)->first();
        $shipping_address  = $location->address;
        $address_1         = $location->address_1;
        $city              = $location->city;
        $zip               = $location->zip;
        $state_name        = @$location->state->state_name;
        $country_name      = @$location->country->country_name;

        if ($pk_locations === 'other') {
            $shipping_address = $request->address;
            $address_1        = $request->address_1;
            $city             = $request->city;
            $zip              = $request->zip;
            $state_name       = $request->state_name;
            $country_name     = $request->country_name;
        }
        // Start the transaction
        DB::beginTransaction();

        try {

            $order = PurchaseOrder::where('pk_purchase_order', $pk_purchase_order)->first();

            $dynamicData = [
                "pk_purchase_order_status" => !$order->pk_purchase_order_status ? PurchaseOrderStatus::where('purchase_order_status', 'New')
                    ->first()->pk_purchase_order_status : $order->pk_purchase_order_status,
                "pk_vendors"               => $request->pk_vendors,
                "po_number"                => $request->po_number,
                "delivery_date_request"    => $request->delivery_date_request,
                "pk_locations"             => $request->pk_locations,
                "shipping_address"         => $shipping_address,
                "shipping_address_1"       => $address_1,
                "shipping_city"            => $city,
                "shipping_state"           => $state_name,
                "shipping_country"         => $country_name,
                "shipping_zip"             => $zip,
                "pk_account"               => auth()->user()->pk_account,
                "pk_users"                 => auth()->user()->pk_users,
                "updated_by"               => Auth::user()->pk_users,
                "active"                   => $request->active ? $request->active : 1,
            ];


            $order->update($dynamicData);
            PurchaseOrderItem::where('pk_purchase_order', $pk_purchase_order)->delete();

            $itemsRequest = $request->item_name;
            if ($order && $itemsRequest) {
                foreach ($itemsRequest as $key => $item) {
                    $items[] = [
                        'pk_purchase_order' => $pk_purchase_order,
                        'name'              => $item,
                        'description'       => $request->item_description[$key] ?? 'N/A',
                        'quantity'          => $request->item_quantity[$key],
                        'price'             => $request->item_price[$key],
                        'total'             => $request->item_total[$key],
                        'created_by'        => Auth::user()->pk_account,
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now(),
                    ];
                }
            }


            PurchaseOrderItem::insert($items);

            DB::commit();

            return $this->back()->with(['message' => 'Purchase order has been updated successfully.', 'messageType' => 'success']);
        } catch (\Exception $e) {

            DB::rollBack();

            $errorMessage = 'Failed to update purchase order. Error: ' . $e->getMessage();

            return redirect()->back()->with(['message' => $errorMessage, 'messageType' => 'danger'])->withInput();
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            PurchaseOrder::where('pk_purchase_order', $id)->delete();
            PurchaseOrderItem::where('pk_purchase_order', $id)->delete();
            DB::commit();

            return $this->back()->with(['message' => 'Purchase order has been deleted successfully.', 'messageType' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = 'Failed to create purchase order. Error: ' . $e->getMessage();
            return redirect()->back()->with(['message' => $errorMessage, 'messageType' => 'danger'])->withInput();
        }
    }

    public function back()
    {
        return redirect('/accountadmin/vendor-request-order');
    }
}
