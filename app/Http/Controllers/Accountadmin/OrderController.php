<?php

namespace App\Http\Controllers\Accountadmin;

use App\CustomerAddres;
use App\Helper\Helper;
use App\Http\Middleware\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Order;
use App\Sale;
use App\OrderItem;
use App\OrderStatus;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $order_status = OrderStatus::all();
        $orders = Order::latest()->with([
            'orderStatus',
            'customer',
            'location',
        ])->get();

        return view('accountadmin.orders.index', compact('orders', 'order_status'));
    }

    public function detail($id)
    {
        $orders          = Order::with(['transactions', 'orderStatus', 'customer'])->where('pk_account', 2)
            ->where("pk_orders", $id)->first();
        $items           = OrderItem::where('pk_orders', $id)->get();
        $orderStatus     = OrderStatus::all();
        $customerAddress = CustomerAddres::where('pk_customers', $orders->pk_customers)->latest()
            ->with(['state', 'country'])->first();
        return view('accountadmin.orders.detail', compact(
            'orders',
            'items',
            'orderStatus',
            'customerAddress'
        ));
    }

    public function filter(Request $request)
    {
        $fields  = $request->validate([
            'search' => ['required'],
        ]);
        $account = Auth::user()->pk_account;
        $orders  = DB::table('kbt_orders')->where('email', 'LIKE', '%' . $fields["search"] . '%')->orWhere('customer_name', 'LIKE', '%' . $fields["search"] . '%')->orWhere('phone', 'LIKE', '%' . $fields["search"] . '%')->orWhere('arrangement_type', 'LIKE', '%' . $fields["search"] . '%')->get();
        // echo "<pre>"; print_r($orders); die;
        return view('accountadmin.orders.index', ['orders' => $orders, 'search' => $fields["search"]]);
    }

    public function orderStatusUpdate(Request $request)
    {

        $order                  = Order::find($request->pk_prders);
        $order->pk_order_status = $request->pk_order_status;
        $order->cancel_reason   = $request->cancel_reason;
        $order->save();

        $salecheck = Sale::where('pk_orders', $request->pk_orders)->first();
        if (!empty($salecheck)) {
            $sale = Sale::where('pk_orders', $request->pk_orders)->update(['pk_order_status' => $request->pk_order_status]);
        }

        return redirect()->back()->with(Helper::getAcknowledge('ORDER_STATUS_UPDATE'));
    }

    public function orderByStatus(Request $request)
    {
        $order_status = DB::table('kbt_order_status')->get();
        $account      = Auth::user()->pk_account;

        if (empty($request->pk_order_status)) {
            $orderStatusData = DB::table('kbt_orders as r')
                ->select('r.customer_name AS customer_name', 'r.pk_orders as pk_orders', 'r.phone as phone', 'r.pk_order_status as pk_order_status', 'r.discountCharge as discountcharge',
                    'r.state_name as state_name', 'r.country_name as country_name', 'r.email as email', 'r.zip as zip', 'r.total as total',
                    'pd.arrangement_type', 'r.deleveryCast1 as deliverycost', 'r.shippingCharge as shippingcharge', 'r.created_at AS date', 'ordstatus.order_status as order_status')
                ->leftjoin('kbt_arrangement_type as pd', function ($join) {
                    $join->on('r.pk_arrangement_type', '=', 'pd.pk_arrangement_type');
                })->join('kbt_order_status as ordstatus', 'r.pk_order_status', 'ordstatus.pk_order_status')
                ->orderBy('pk_orders', 'DESC')->get();
        } else {
            $orderStatusData = DB::table('kbt_orders as r')
                ->select('r.customer_name AS customer_name', 'r.pk_orders as pk_orders', 'r.phone as phone', 'r.pk_order_status as pk_order_status', 'r.discountCharge as discountcharge',
                    'r.state_name as state_name', 'r.country_name as country_name', 'r.email as email', 'r.zip as zip', 'r.total as total',
                    'pd.arrangement_type', 'r.deleveryCast1 as deliverycost', 'r.shippingCharge as shippingcharge', 'r.created_at AS date', 'ordstatus.order_status as order_status')
                ->leftjoin('kbt_arrangement_type as pd', function ($join) {
                    $join->on('r.pk_arrangement_type', '=', 'pd.pk_arrangement_type');
                })->join('kbt_order_status as ordstatus', 'r.pk_order_status', 'ordstatus.pk_order_status')
                ->where('r.pk_order_status', $request->pk_order_status)->orderBy('pk_orders', 'DESC')->get();
        }
        //  echo "<pre>"; print_r($orderStatusData); die;
        return view('accountadmin.orders.index', ['orderStatusData' => $orderStatusData, 'order_status' => $order_status]);
    }

    public function cancelOrder(Request $request, $id = null)
    {
        $order                  = Order::find($id);
        $order->pk_order_status = 5;
        $order->save();
        return redirect()->back()->with(Helper::getAcknowledge('ORDER_STATUS_UPDATE'));
    }

}
