<?php

namespace App\Http\Controllers;

use App\Country;
use App\DeliveryOrPickup;
use App\ShippingAddress;
use App\State;
use App\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use DB;
use App\Customer;
use App\CustomerAddres;
use App\User;
use App\Order;
use App\OrderItem;
use App\Addres;
use App\Account;
use App\Location;
use App\LocationTime;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use \Carbon\Carbon;

class FlowerBySubscriptionController extends Controller
{


    public function index()
    {
        $flowerSubscriptions = DB::table('kbt_flower_subscription')
            ->join('kbt_frequency', 'kbt_flower_subscription.pk_frequency', 'kbt_frequency.pk_frequency')
            ->get();

        return view('flower-by-subscription', ['flowerSubscriptions' => $flowerSubscriptions]);
    }


    public function detail_img($id = null)
    {
        $flowerSubscriptions = DB::table('kbt_flower_subscription')
            ->join('kbt_frequency', 'kbt_flower_subscription.pk_frequency', 'kbt_frequency.pk_frequency')
            ->where('kbt_flower_subscription.pk_flower_subscription', $id)
            ->first();
        return view('flower-by-detail', ['flowerSubscriptions' => $flowerSubscriptions]);
    }

    public function view(Request $request)
    {
        $validated           = $request->validate([
            'flower_subscription' => 'required'
        ]);
        $flowerSubscription  = $request->all();
        $flowerSubscriptions = DB::table('kbt_flower_subscription')
            ->join('kbt_frequency', 'kbt_flower_subscription.pk_frequency', 'kbt_frequency.pk_frequency')
            ->get();
        return view('flower-by-subscription-cart', ['flowerSubscription' => $flowerSubscription, 'flowerSubscriptions' => $flowerSubscriptions]);
    }


    public function addToCart(Request $request)
    {

        if ($request->type == 3) {

            $flowerSubscriptions = DB::table('kbt_flower_subscription')
                ->join('kbt_frequency', 'kbt_flower_subscription.pk_frequency', 'kbt_frequency.pk_frequency')
                ->select('pk_flower_subscription', 'frequency', 'price', 'kbt_flower_subscription.description', 'path')
                ->where('pk_flower_subscription', $request->id)
                ->first();

            if (!$flowerSubscriptions) {
                abort(404);
            }
        }

        $oth_cart           = session()->get('oth_cart');
        $oth_total_quantity = session()->get('oth_total_quantity');
        $oth_total_hit      = session()->get('oth_total_hit');

        if ($oth_total_hit == '' || $oth_total_hit == null) {
            $oth_total_hit = 0;
        } else {
            $oth_total_hit += 1;
        }
        session()->put('oth_total_hit', $oth_total_hit);

        // if cart is empty then this the first product

        if (!$oth_cart) {

            if ($request->type == 3) {
                $oth_cart[$oth_total_hit] = [
                    "name"        => $flowerSubscriptions->frequency,
                    "description" => $flowerSubscriptions->description,
                    "quantity"    => 1,
                    "price"       => $flowerSubscriptions->price,
                    "photo"       => $flowerSubscriptions->path,
                    "type"        => 3
                ];
            }


            $oth_total_quantity += 1;
            session()->put('oth_cart', $oth_cart);
            session()->put('oth_total_quantity', $oth_total_quantity);
            session()->put('oth_total_hit', $oth_total_hit + 1);

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($oth_cart[$oth_total_hit])) {

            $oth_cart[$oth_total_hit]['quantity']++;
            $oth_total_quantity += 1;

            session()->put('oth_cart', $oth_cart);
            session()->put('oth_total_quantity', $oth_total_quantity);
            session()->put('oth_total_hit', $oth_total_hit + 1);

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);
        }

        // if item not exist in cart then add to cart with quantity = 1
        if ($request->type == 3) {
            $oth_cart[$oth_total_hit] = [
                "name"        => $flowerSubscriptions->frequency,
                "description" => $flowerSubscriptions->description,
                "quantity"    => 1,
                "price"       => $flowerSubscriptions->price,
                "photo"       => $flowerSubscriptions->path,
                "type"        => 3
            ];
        }
        $oth_total_quantity += 1;

        session()->put('oth_cart', $oth_cart);
        session()->put('oth_total_quantity', $oth_total_quantity);
        session()->put('oth_total_hit', $oth_total_hit + 1);

        $htmlCart = view('_header_cart')->render();
        return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);
    }


    public function cart()
    {
//        dd(session('oth_cart'));
        return view('othere_cart');
    }

    public function update(Request $request)
    {
        $oth_cart = session()->get('oth_cart');
        if (!isset($oth_cart[$request->id]["quantity"])) {
            $oth_cart[$request->id]["quantity"] = $request->quantity ?? $oth_cart[$request->id]["quantity"];
        }

        if (!isset($oth_cart[$request->id]["card_message"])) {
            $oth_cart[$request->id]["card_message"] = $request->card_message ?? $oth_cart[$request->id]["card_message"];
        }

        $oth_cart[$request->id]["quantity"]     = $request->quantity ?? $oth_cart[$request->id]["quantity"];
        $oth_cart[$request->id]["card_message"] = $request->card_message ?? $oth_cart[$request->id]["card_message"];

        session()->put('oth_cart', $oth_cart);
        $subTotal = $oth_cart[$request->id]['quantity'] * $oth_cart[$request->id]['price'];

        $total = $this->getCartTotal();

        session()->put('oth_total_quantity', array_sum(array_column($oth_cart, 'quantity')));

        $htmlCart = view('_header_cart')->render();

        return response()->json([
            'msg'      => 'Cart updated successfully',
            'data'     => $htmlCart,
            'total'    => $total,
            'subTotal' => $subTotal,
            'totalQty' => session()->get('oth_total_quantity')
        ]);
    }

    public function updateAllCartItems()
    {

    }

    public function remove(Request $request)
    {
        if ($request->id != '') {
            $oth_cart = session()->get('oth_cart');
            if (isset($oth_cart[$request->id])) {
                unset($oth_cart[$request->id]);
                session()->put('oth_cart', $oth_cart);

                $oth_total_quantity = session()->get('oth_total_quantity');
                session()->put('oth_total_quantity', array_sum(array_column($oth_cart, 'quantity')));
            }

            $total    = $this->getCartTotal();
            $htmlCart = view('_header_cart')->render();
            return response()->json(['msg' => 'Product removed successfully', 'data' => $htmlCart, 'total' => $total, 'totalQty' => session()->get('oth_total_quantity')]);

            //session()->flash('success', 'Product removed successfully');
        }
    }

    /**
     * Checkout page
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function otherCheckOutPage()
    {
        $user_data  = auth()->user();
        $pk_user_id = $user_data->pk_users ?? '';

        $kbt_address     = DB::table('kbt_shipping_address')->where('pk_customers', $pk_user_id)->get();
        $countries       = Country::all();
        $states          = State::all();
        $store           = Location::all();
        $deliveryOptions = DeliveryOrPickup::all();

        return view('other-checkout', compact(
            'user_data',
            'kbt_address',
            'countries',
            'states',
            'store',
            'deliveryOptions'
        ));
    }

    public function other_checkout(Request $request)
    {
        $user_data = auth()->user();

        if (empty(session('oth_cart'))) {
            session()->flash('message', 'Your Cart Is Currently Empty.');
            session()->flash('level', 'danger');
            return redirect('shop');
        }

        // Customer address create
        if (!auth()->check()) {
            $validator = Validator::make($request->all(), [
                'first_name'           => 'required',
                'last_name'            => 'required',
                'username'             => 'nullable|unique:users',
                'phone'                => 'required',
                'email'                => 'nullable|unique:users',
                'billing_address'      => 'required',
                'billing_city'         => 'required',
                'billing_state_name'   => 'required',
                'billing_zip'          => 'required',
                'billing_country_name' => 'required',
            ]);

            if ($validator->fails()) {
                session()->flash('message', 'Order could not be placed, please correct errors. -> ' . $validator->errors()->first());
                session()->flash('level', 'danger');
                return redirect('other-checkout')->withErrors($validator)->withInput();
            }

            if ($request->choise_details == 'billing_address') {
                $validator = Validator::make($request->all(), [
                    'billing_address'      => 'required',
                    'billing_city'         => 'required',
                    'billing_state_name'   => 'required',
                    'billing_country_name' => 'required',
                    'billing_zip'          => 'required',
                ]);
            }


            if ($validator->fails()) {
                session()->flash('message', 'Order could not be placed, please correct errors.');
                session()->flash('level', 'danger');
                return redirect('other-checkout')->withErrors($validator)->withInput();
            }

            // Create Customer
            $customer = Customer::create([
                'pk_account'       => 2,
                'customer_name'    => $request->first_name . ' ' . $request->last_name,
                'pk_customer_type' => 1,
                'email'            => $request->email,
                'office_phone'     => $request->phone,
                'login_enable'     => 1,
            ]);

            // Create User for customer
            $customer_user = User::create([
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'username'     => $request->username,
                'password'     => Hash::make(12345678),
                'pk_roles'     => 4,
                'pk_account'   => 2,
                'pk_customers' => $customer->pk_customers,
            ]);

            // Get customer and user id
            $pk_user_id     = $customer_user->pk_users;
            $pk_customer_id = $customer->pk_customers;

            // Create Customer Address
            if ($request->primary_address) {
                $primaryState    = State::where('state_code', $request->primary_state_name)->first();
                $primary_address = [
                    'pk_customers'    => $pk_customer_id,
                    'pk_address_type' => 1,
                    'address'         => $request->primary_address,
                    'address_1'       => $request->primary_address_1,
                    'city'            => $request->primary_city,
                    'pk_states'       => $primaryState->pk_states ?? 1,
                    'pk_country'      => $primaryState->pk_country ?? 1,
                    'zip'             => $request->primary_zip,
                ];

                CustomerAddres::create($primary_address);
            }


            if ($request->billing_address) {
                $billingState = State::where('state_code', $request->billing_state_name)->first();
                $billing_data = [
                    'pk_customers'    => $pk_customer_id,
                    'pk_address_type' => 2,
                    'address'         => $request->billing_address,
                    'address_1'       => $request->billing_address_1,
                    'city'            => $request->billing_city,
                    'pk_states'       => $billingState->pk_states ?? 1,
                    'pk_country'      => $billingState->pk_country ?? 1,
                    'zip'             => $request->billing_zip,
                ];
                CustomerAddres::create($billing_data);
            }

            // Login User
            Auth::loginUsingId($pk_user_id);
        } else {
            $request['billing_full_name'] = $request->first_name ?? $user_data->first_name . ' ' . $user_data->last_name;
            $validator                    = Order::validate_payment_card($request->all());

            if ($validator->fails()) {
                session()->flash('message', 'Order could not be placed, please correct errors.');
                session()->flash('level', 'danger');
                return redirect('other-checkout')->withErrors($validator)->withInput();
            }

            $pk_user_id     = $user_data->pk_users;
            $customer_data1 = Customer::where('email', $user_data->email)->first();

            // Check if customer already exists and create if not
            if ($customer_data1) {
                $pk_customer_id = $customer_data1->pk_customers;
                $user_data->update(['pk_customers' => $pk_customer_id]);
            } else {
                $customer = Customer::create([
                    'pk_account'       => 2,
                    'customer_name'    => $user_data->first_name . ' ' . $user_data->last_name,
                    'pk_customer_type' => 1,
                    'email'            => $user_data->email,
                    'office_phone'     => $user_data->phone,
                    'login_enable'     => 1,
                ]);

                // Get customer id
                $pk_customer_id = $customer->pk_customers;
                $user_data->update(['pk_customers' => $pk_customer_id]);

                // Create customer primary address
                if ($request->primary_address) {
                    $primaryState    = State::where('state_code', $request->primary_state_name)->first();
                    $primary_address = [
                        'pk_customers'    => $pk_customer_id,
                        'pk_address_type' => 1,
                        'address'         => $request->primary_address,
                        'address_1'       => $request->primary_address_1,
                        'city'            => $request->primary_city,
                        'pk_states'       => $primaryState->pk_states ?? 1,
                        'pk_country'      => $primaryState->pk_country ?? 1,
                        'zip'             => $request->primary_zip,
                    ];

                    CustomerAddres::create($primary_address);
                }


                if ($request->billing_address) {
                    $billingState = State::where('state_code', $request->billing_state_name)->first();
                    $billing_data = [
                        'pk_customers'    => $pk_customer_id,
                        'pk_address_type' => 2,
                        'address'         => $request->billing_address,
                        'address_1'       => $request->billing_address_1,
                        'city'            => $request->billing_city,
                        'pk_states'       => $billingState->pk_states ?? 1,
                        'pk_country'      => $billingState->pk_country ?? 1,
                        'zip'             => $request->billing_zip,
                    ];
                    CustomerAddres::create($billing_data);
                }

            }
        }

        $customer_data = Customer::find($pk_customer_id);
        // Check customer exists or not
        if (!$customer_data) {
            session()->flash('message', 'Customer could not be found, please correct errors.');
            session()->flash('level', 'danger');
            return redirect('other-checkout')->withErrors($validator)->withInput();
        }

        // Payment
        $pk_transactions = null;
        $payment_total   = 0;
        $payem_total_qty = 0;
        if (session('oth_cart')) {
            foreach ((array)session('oth_cart') as $orderitempay) {
                $quantity_payment = !empty($orderitempay['quantity']) ? $orderitempay['quantity'] : 0;
                if ($quantity_payment > 0) {
                    $payment_total   += $orderitempay['price'] * $quantity_payment;
                    $payem_total_qty += $quantity_payment;
                }
            }

            if (!empty($user_data->email)) {
                $user_email = $user_data->email;

                $request->request->add(['billing_email' => $user_email]);
            }

            $order_no = 'ORD' . str_pad(Order::max('pk_orders') + 1, 8, "0", STR_PAD_LEFT);
            $res      = $this->handleonlinepay($request, $pk_user_id, $payment_total, $payem_total_qty, $order_no);

            if ($res['msg_type'] == 'error_msg') {
                session()->flash('message', $res['message_text'] . ', please correct errors.');
                session()->flash('level', 'danger');
                return redirect('other-checkout')->withErrors($validator)->withInput();
            }

            $pk_transactions = $res['trans_id'];
        }

        // Save order
        $save_order = [
            'pk_users'              => $pk_user_id,
            'pk_transactions'       => $pk_transactions,
            'pk_customers'          => $pk_customer_id,
            'pk_delivery_or_pickup' => $request->choise_details ?? 1,
            'total'                 => $request->amount,
        ];

        if ($request->pk_locations) {
            $save_order['pk_locations'] = $request->pk_locations;
        }

        if ($request->store_id) {
            $store_time                      = explode("/", $request->store_id);
            $save_order['pk_locations']      = $store_time[1];
            $save_order['pk_location_times'] = $store_time[0];
        }

        if (isset($request->deleveryCast1)) {
            $save_order['delivery_charge'] = $request->deleveryCast1;
        }

        if (isset($request->shippingCharge)) {
            $save_order['tax_charge'] = $request->shippingCharge;
        }

        if (isset($request->discountCharge)) {
            $coupon = explode(" ", $request->discountCharge);

            if ($coupon[1] === '%') {
                $save_order['discount_charge']      = $coupon[0];
                $save_order['coupon_discount_type'] = 'percent';
            } elseif ($coupon[0] === '$') {
                $save_order['discount_charge']      = $coupon[1];
                $save_order['coupon_discount_type'] = 'fixed';
            } else {
                $save_order['discount_charge']      = $request->discountCharge[0];
                $save_order['coupon_discount_type'] = $request->discountCharge[1];
            }
        }

        if (isset($request->estimated_del)) {
            $save_order['estimated_del'] = Carbon::parse($request->estimated_del)->format('Y-m-d');
        }

        $save_order['pk_order_status'] = 1;

        // Create order
        $get_order                    = Order::create($save_order);
        $save_order['discountCharge'] = $request->discountCharge ? $save_order['discount_charge'] : 0;

        if (session('oth_cart')) {
            $total           = 0;
            $deliveryCharges = 0;

            foreach ((array)session('oth_cart') as $key => $orderitem) {
                $quantity = $orderitem['quantity'] ?? 0;

                if ($quantity > 0) {

                    $total += $orderitem['price'] * $quantity;

                    $save_order_item = [
                        'pk_orders'           => $get_order->pk_orders,
                        'pk_shipping_address' => 1,
                        'pk_arrangement_type' => $orderitem['pk_arrangement_type'] ?? '',
                        'name'                => $orderitem['name'] ?? '',
                        'description'         => $orderitem['description'] ?? '',
                        'quantity'            => $quantity,
                        'price'               => $orderitem['price'] ?? 0,
                        'card_message'        => $orderitem['card_message'] ?? '',
                    ];

                    $orderItem = OrderItem::create($save_order_item);

                    // Create item address
                    $user_name  = $user_data ? $user_data->first_name . ' ' . $user_data->last_name :
                        $request->first_name . ' ' . $request->last_name;
                    $user_email = !$user_data ? $request->email : $user_data->email;
                    $user_phone = !$user_data ? $request->phone : $user_data->phone;

                    if (isset($request->item_address) && count($request->item_address)) {
                        $itemAddress        = $request->item_address;
                        if ($itemAddress[$key]['same_as_billing'] == 0) {
                            $deliveryCharges += $itemAddress[$key]['delivery_charge'];
                        }
                        $cusAddr            = @$user_data->customer->address[0];
                        $shipping_address   = $itemAddress[$key]['shipping_address'] ?? $request->billing_address ??
                            $cusAddr->address ?? '';
                        $shipping_address_1 = $itemAddress[$key]['shipping_address_1'] ?? $request->billing_address_1 ??
                            $cusAddr->address_1 ?? '';
                        $shipping_city      = $itemAddress[$key]['shipping_city'] ?? $request->billing_city
                            ?? $cusAddr->city ?? '';
                        $shipping_zip       = $itemAddress[$key]['shipping_zip'] ?? $request->billing_zip
                            ?? $cusAddr->zip ?? '';
                        $state              = State::where('state_code', $itemAddress[$key]['shipping_state_name']
                            ?? $request->billing_state_name ?? '')->first();
                        $shipping_data      = [
                            'pk_customers'       => $pk_customer_id,
                            'pk_order_items'     => $orderItem->pk_order_items ?? 1,
                            'shipping_full_name' => $itemAddress[$key]['shipping_full_name'] ?? $user_name,
                            'shipping_email'     => $itemAddress[$key]['shipping_email'] ?? $user_email,
                            'shipping_phone'     => $itemAddress[$key]['shipping_phone'] ?? $user_phone,
                            'shipping_address'   => $shipping_address,
                            'shipping_address_1' => $shipping_address_1,
                            'shipping_city'      => $shipping_city,
                            'pk_states'          => $state->pk_states ?? $cusAddr->pk_states ?? 1,
                            'pk_country'         => $state->pk_country ?? $cusAddr->pk_country ?? 1,
                            'shipping_zip'       => $shipping_zip,
                            'delivery_charge'    => $itemAddress[$key]['delivery_charge'] ?? 0,
                            'same_as_billing'    => $itemAddress[$key]['same_as_billing'] ?? 1,
                        ];

                        Addres::create($shipping_data);
                    }
                }
            }

            if ($request->choise_details != 'store') {
                $deliveryCharges = $deliveryCharges > 0 ? $deliveryCharges : $request->deleveryCast1;
                $total           += ($deliveryCharges + $request->shippingCharge) - $save_order['discountCharge'];
                Order::where('pk_orders', $get_order->pk_orders)->update([
                    'total'           => $total,
                    'delivery_charge' => $deliveryCharges
                ]);
            }
        }


        // Forget session data
        session()->forget('oth_cart');
        session()->forget('oth_total_quantity');
        session()->forget('oth_total_hit');

        // Set success message
        session()->flash('message', 'Order has been placed successfully!');
        session()->flash('level', 'success');

        return redirect('thank-you/' . $get_order->pk_orders);
    }

    public function other_checkouts(Request $request)
    {
        $store = Location::where('pk_account', 2)->latest()->first();

        $output  = ['html' => null];
        $output1 = ['storename' => null, 'kilomiter' => null, 'storeName' => null, 'taxRate' => null];

        // Get the tax rate
        $getDes      = urlencode("{$store->address}, {$store->address_1}, {$store->city}, {$store->zip}");
        $getDes1     = urlencode("{$request->address}, {$request->address_1}, {$request->city}, {$request->postal_code}");
        $shippingurl = "https://maps.googleapis.com/maps/api/distancematrix/json";
        $params      = [
            'destinations' => $getDes1,
            'origins'      => $getDes,
            'key'          => 'AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A',
            'units'        => 'imperial'
        ];

        $client    = new Client();
        $response  = $client->get($shippingurl, ['query' => $params])->getBody();
        $responses = json_decode($response, true);
        $distance  = isset($responses['rows'][0]['elements'][0]['distance']) ? $responses['rows'][0]['elements'][0]['distance']['text'] : null;

        if ($distance !== null) {
            $output1['kilomiter'] .= "{$distance}a{$store->pk_locations}b";
        }
        // End of get the tax rate


        // Get the store IDS
        $aa1               = str_replace("m", "", str_replace("b", ",", str_replace("a", ":", str_replace(" ", "", str_replace(",", "", str_replace("km", "", implode(" ", $output1)))))));
        $convert_to_array1 = explode(",", $aa1);
        $linksArray1       = array_filter($convert_to_array1);
        $tttt1             = array_unique($linksArray1);

        $tttt2 = str_replace(".", "", $tttt1);
        sort($tttt2);
        $str1 = preg_replace("/[^a-zA-Z 0-9]+/", ",", $tttt2);

        sort($str1);
        $str12   = preg_replace("/[^a-zA-Z 0-9]+/", ",", $str1);
        $result1 = array_filter($str12);

        $store_id = [];
        if (isset($result1[0])) {
            $st1         = $result1[0];
            $locationId1 = explode(",", $st1);
            $store_id[]  = $locationId1[1];
        }
        if (isset($result1[1])) {
            $st2         = $result1[1];
            $locationId2 = explode(",", $st2);
            $store_id[]  = $locationId2[1];
        }
        if (isset($result1[2])) {
            $st3         = $result1[2];
            $locationId3 = explode(",", $st3);
            $store_id[]  = $locationId3[1];
        }
        // End of get the store IDS


        // Set the store info and tax rate into HTML
        foreach ($store_id as $st) {
            $storecity = Location::where('pk_locations', $st)->first();
            $store1    = DB::table('kbt_location_times')->where('pk_locations', $st)->get();

            $getDes      = urlencode("{$storecity->address}, {$storecity->address_1}, {$storecity->city}, {$storecity->zip}");
            $getDes1     = urlencode("{$request->address}, {$request->address_1}, {$request->city}, {$request->postal_code}");
            $shippingurl = "https://maps.googleapis.com/maps/api/distancematrix/json?destinations=$getDes1&origins=$getDes&key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A&units=imperial";
            $result      = file_get_contents($shippingurl);
            $responses   = json_decode($result, true);
            $distance1   = $responses['rows'][0]['elements'][0]['distance']['text'] ?? null;

            if ($distance1 !== null) {
                $output['html'] .= '
        <div class="col-md-12 mb-3 store1">
            <div class="row">
                <div class="col-md-12"><h6>' . $storecity->location_name . '</h6></div>
                <div class="col-md-12"><p>' . $distance1 . '</p></div>
                <div class="col-md-12">
                    <p>' . $storecity->address . ' ,' . $storecity->address_1 . ' ,' . $storecity->city . ' ,' . $storecity->zip . ' ,' . $storecity->state_name . ' ,' . $storecity->country_name . '</p>
                </div>
            </div>
            <div class="selectTimeItem">
                <div class="row">';
                foreach ($store1 as $data1) {
                    $output['html'] .= '
                <div class="col-md-10">
                    Day - ' . $data1->day . ' , ' . date('h:i A', strtotime($data1->open_time)) . ' - ' . date('h:i A', strtotime($data1->close_time)) . '
                </div>
                <div class="col-md-2">
                    <input type="radio" name="store_id" value="' . $data1->pk_location_times . '/' . $store->pk_locations . '" value="store"> Select
                </div>';
                }
                $output['html'] .= '</div></div></div>';
            }
        }

        return response()->json($output);
    }

    public function other_checkoutss(Request $request)
    {
        $store   = Location::where('pk_account', 2)->latest()->first();
        $output  = ['html' => null, 'Estimated_Delivery_Time' => 0, 'cost' => 0, 'storename' => null, 'kilomiter' => null, 'storeName' => null, 'taxRate' => 0, 'pk_location' => null];
        $output2 = ['html' => null];
        $output1 = ['storename' => null, 'kilomiter' => null, 'storeName' => null, 'taxRate' => null];

        // Get the tax rate
        $getDes  = urlencode("{$store->address}, {$store->city}");
        $getDes1 = urlencode("{$request->address}, {$request->city}");

        $shippingurl = "https://maps.googleapis.com/maps/api/distancematrix/json";
        $params      = [
            'destinations' => $getDes1,
            'origins'      => $getDes,
            'key'          => 'AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A',
            'units'        => 'imperial'
        ];

        $client    = new Client();
        $response  = $client->get($shippingurl, ['query' => $params])->getBody();
        $responses = json_decode($response, true);
        $distance  = isset($responses['rows'][0]['elements'][0]['distance']) ? $responses['rows'][0]['elements'][0]['distance']['text'] : null;

        if ($distance !== null) {
            $output2['html']      .= $distance;
            $output1['kilomiter'] .= "{$distance}a{$store->pk_locations}b";
        }
        // End of get the tax rate

        // Get the store IDS
        $aa1               = str_replace("m", "", str_replace("b", ",", str_replace("a", ":", str_replace(" ", "", str_replace(",", "", str_replace("mi", "", implode(" ", $output1)))))));
        $convert_to_array1 = explode(",", $aa1);
        $linksArray1       = array_filter($convert_to_array1);
        $tttt1             = array_unique($linksArray1);

        $tttt2 = str_replace(".", "", $tttt1);
        sort($tttt2);
        $str1 = preg_replace("/[^a-zA-Z 0-9]+/", ",", $tttt2);

        sort($str1);
        $str12      = preg_replace("/[^a-zA-Z 0-9]+/", ",", $str1);
        $result1    = array_filter($str12);
        $locationId = explode(",", $result1[0]);

        $storeName                         = DB::table('kbt_locations')->where('pk_locations', $locationId[1])->first();
        $output['storeName']               = $storeName->location_name;
        $output['storeCity']               = $storeName->city;
        $output['taxRate']                 = $storeName->tax_rate;
        $output['pk_location']             = $storeName->pk_locations;
        $dd                                = Carbon::now()->addDays($storeName->Estimated_Delivery_Time);
        $output['Estimated_Delivery_Time'] = date("d-M-Y", strtotime($dd));

        $aa = explode(" ", str_replace(",", "", str_replace("mi", "", implode(" ", $output2))));

        $linksArray = array_filter($aa);

        $tttt = array_unique($linksArray);
        sort($tttt);
        $result = array_filter($tttt);
        // End of get the store IDS

        // Get delivery cost
        $deleveryCast = DB::table('kbt_delivery_charges')
            ->where('miles_from', '<', $result[0])
            ->where('miles_to', '>', $result[0])
            ->get();

        foreach ($deleveryCast as $delCast) {
            $output['cost'] = !empty($delCast->cost) ? $delCast->cost : '0';
        }


        return response()->json($output);
    }

    public function otherCheckoutShipInfo(Request $request)
    {
        $store  = Location::where('pk_account', 2)->latest()->first();
        $output = [];

        $output2 = ['html' => null];

        $output1 = [
            'storename' => null,
            'kilomiter' => null,
            'storeName' => null,
            'taxRate'   => null
        ];

        // Get the tax rate
        $getDes  = urlencode("{$store->address}, {$store->city}");
        $getDes1 = urlencode("{$request->address}, {$request->city}");

        $shippingurl = "https://maps.googleapis.com/maps/api/distancematrix/json";
        $params      = [
            'destinations' => $getDes1,
            'origins'      => $getDes,
            'key'          => 'AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A',
            'units'        => 'imperial'
        ];

        $client    = new Client();
        $response  = $client->get($shippingurl, ['query' => $params])->getBody();
        $responses = json_decode($response, true);
        $distance  = isset($responses['rows'][0]['elements'][0]['distance']) ?
            $responses['rows'][0]['elements'][0]['distance']['text'] : null;

        if ($distance !== null) {
            $output2['html']      .= $distance;
            $output1['kilomiter'] .= "{$distance}a{$store->pk_locations}b";
        }
        // End of get the tax rate

        // Get the store IDS
        $aa1               = str_replace("m", "", str_replace("b", ",", str_replace("a", ":", str_replace(" ", "", str_replace(",", "", str_replace("mi", "", implode(" ", $output1)))))));
        $convert_to_array1 = explode(",", $aa1);
        $linksArray1       = array_filter($convert_to_array1);
        $tttt1             = array_unique($linksArray1);

        $tttt2 = str_replace(".", "", $tttt1);
        sort($tttt2);
        $str1 = preg_replace("/[^a-zA-Z 0-9]+/", ",", $tttt2);

        sort($str1);
        $str12      = preg_replace("/[^a-zA-Z 0-9]+/", ",", $str1);
        $result1    = array_filter($str12);
        $locationId = explode(",", $result1[0]);

        $storeName                         = DB::table('kbt_locations')->where('pk_locations', $locationId[1])->first();
        $output['storeName']               = $storeName->location_name;
        $output['storeCity']               = $storeName->city;
        $output['taxRate']                 = $storeName->tax_rate;
        $output['pk_location']             = $storeName->pk_locations;
        $estimatedDT                       = Carbon::now()->addDays($storeName->Estimated_Delivery_Time);
        $output['estimated_delivery_time'] = date("d-M-Y", strtotime($estimatedDT));

        $aa = explode(" ", str_replace(",", "", str_replace("mi", "", implode(" ", $output2))));

        $linksArray = array_filter($aa);

        $tttt = array_unique($linksArray);
        sort($tttt);
        $result = array_filter($tttt);
        // End of get the store IDS

        // Get delivery cost
        $deliveryCharge = DB::table('kbt_delivery_charges')
            ->where('miles_from', '<', $result[0])
            ->where('miles_to', '>', $result[0])
            ->first();

        $output['delivery_charge'] = !$deliveryCharge ? 0 : $deliveryCharge->cost;

        return response()->json($output);
    }

    public function apply_coupon(Request $request)
    {
        $coupon       = DB::table('kbt_coupons')->where('code', $request->couponName)->first();
        $couponAmount = "";
        // foreach($coupon as $data)
        // {
        if (!empty($coupon)) {
            $type         = $coupon->type;
            $couponAmount = $coupon->discount_amount;
        }
        // }
        return response()->json([$couponAmount, $type]);
    }

    public function handleonlinepay($request, $user_id, $totla_amount, $qty, $order_no)
    {
          $input = $request->input();
        $billing_address = isset($request->billing_address) ?$request->billing_address :'';
        $billing_city = isset($request->billing_city) ?$request->billing_city :'';
        $billing_state_name = isset($request->billing_state_name) ?$request->billing_state_name :'';
        $billing_zip = isset($request->billing_zip) ?$request->billing_zip :'';
        /* Create a merchantAuthenticationType object with authentication details
          retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        //$merchantAuthentication->setName(env('MERCHANT_LOGIN_ID'));
        $merchantAuthentication->setName('4Y5pCy8Qr');
        //$merchantAuthentication->setTransactionKey(env('MERCHANT_TRANSACTION_KEY'));
        $merchantAuthentication->setTransactionKey('4ke43FW8z3287HV5');

        // Set the transaction's refId
        $refId      = 'ref' . time();
        $cardNumber = preg_replace('/\s+/', '', $input['cc_number']);

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($input['expiry_year'] . "-" . $input['expiry_month']);
        $creditCard->setCardCode($input['cvv']);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($order_no);
        $order->setDescription('KBT');


        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($input['cc_name']);
        $customerAddress->setLastName($input['cc_name']);

        if (auth()->check() && !isset($input['address'])) {
            $authUser              = auth()->user();
            $cusAddr               = $authUser->customer->address[0];
            $input['email']        = $authUser->customer->email;
            $input['address']      = $cusAddr->address;
            $input['city']         = $cusAddr->city;
            $input['state_name']   = $cusAddr->state->state_name ?? 'CA';
            $input['zip']          = $cusAddr->zip;
        }

        $customerAddress->setAddress($input['address'] ?? $billing_address);
        $customerAddress->setCity($input['city'] ?? $billing_city);
        $customerAddress->setState($input['state_name'] ?? $billing_state_name);
        $customerAddress->setZip($input['zip'] ?? $billing_zip);
        $customerAddress->setCountry('United States');

        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setEmail($input['email'] ?? $input['billing_email']);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($totla_amount);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);

        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);
        $response   = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        //$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        $trans_id = 0;
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
                // Since the API request was successful, look for a transaction response
                // and parse it to display the results of authorizing the card
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getMessages() != null) {
                    //                    echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
                    //                    echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
                    //                    echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
                    //                    echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
                    //                    echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
                    $message_text = $tresponse->getMessages()[0]->getDescription() . ", Transaction ID: " . $tresponse->getTransId();
                    $msg_type     = "success_msg";

                    $trans_id = Transaction::create([
                        'amount'         => $totla_amount,
                        'response_code'  => $tresponse->getResponseCode(),
                        'transaction_id' => $tresponse->getTransId(),
                        'auth_id'        => $tresponse->getAuthCode(),
                        'message_code'   => $tresponse->getMessages()[0]->getCode(),
                        'name_on_card'   => trim($input['cc_name']),
                        'account_type'   => $tresponse->getAccountType(),
                        'currency'       => 'USD',
                        'created_by'     => $user_id,
                        'quantity'       => $qty
                    ])->pk_transactions;
                } else {
                    $message_text = 'There were some issue with the payment. Please try again later.';
                    $msg_type     = "error_msg";

                    if ($tresponse->getErrors() != null) {
                        $message_text = $tresponse->getErrors()[0]->getErrorText();
                        $msg_type     = "error_msg";
                    }
                }
                // Or, print errors if the API request wasn't successful
            } else {
                $message_text = 'There were some issue with the payment. Please try again later.';
                $msg_type     = "error_msg";

                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                    $msg_type     = "error_msg";
                } else {
                    $message_text = $response->getMessages()->getMessage()[0]->getText();
                    $msg_type     = "error_msg";
                }
            }
        } else {
            $message_text = "No response returned";
            $msg_type     = "error_msg";
        }

        return array('msg_type' => $msg_type, 'message_text' => $message_text, 'trans_id' => $trans_id);
        //print_r($msg_type);
        //print_r($message_text);exit;
        // test by lemon
    }


    public function thank_you(Request $request, $pk_orders = null)
    {
        $user_data = auth()->user();
        $order     = Order::with(['orderStatus', 'deliveryOption'])->find($pk_orders);

        $locationTime = LocationTime::where('pk_location_times', $order->pk_location_times)->first();      //Location::where('pk_locations',$order->pk_locations)->with('locationTime')
        if (isset($locationTime->pk_locations)) {
            $store = Location::where('pk_locations', $locationTime->pk_locations)->with('locationTime')->first();
        } else {
            $store = Location::where('pk_locations', $order->pk_locations)->with('locationTime')->first();
        }

        $account = "";
        if ($order->choise_details == 'store') {
            $account = Account::where('pk_account', $order->pk_account)->with(['locationType', 'locationType.locationTime'])->first();
        }

        //dd($account);

        $order_items = $order->order_items;

        return view('thank-you', compact('user_data', 'order_items', 'pk_orders', 'order', 'store', 'account'));
    }

    private function getCartTotal()
    {
        $total    = 0;
        $oth_cart = session()->get('oth_cart');

        foreach ($oth_cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }

    public function getAddressId(Request $request)
    {
        $kbt_address = ShippingAddress::find($request->id);

        if (empty($kbt_address)) {
            $kbt_address = false;
        }

        return json_encode($kbt_address);
    }
}
