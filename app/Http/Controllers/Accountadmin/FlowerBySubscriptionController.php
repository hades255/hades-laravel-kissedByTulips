<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flower;
use App\ColorFlower;
use App\VaseType;
use DB;
use App\Customer;
use App\User;
use App\Order;
use App\OrderItem;
use App\Addres;
use Auth;
use Illuminate\Support\Facades\Hash;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Validator;

class FlowerBySubscriptionController extends Controller
{


    public function index()
    {
        $flowerSubscriptions = DB::table('kbt_flower_subscription')
            ->join('kbt_frequency', 'kbt_flower_subscription.pk_frequency', 'kbt_frequency.pk_frequency')
            ->get();
        //echo "hello"; die;
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
        $validated          = $request->validate([
            'flower_subscription' => 'required'
        ]);
        $flowerSubscription = $request->all();
        // "name" = $request->frequency,
        // "description" = $request->description,
        // "quantity" => 1,
        // "price" => $request->price,
        // "photo" => $request->path
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


            // echo '<pre>'; print_r($oth_cart); die;

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
        //echo '<pre>'; print_r(session('oth_cart')); die;
        return view('othere_cart');
    }

    public function update(Request $request)
    {
        if (($request->id || $request->id == 0) and $request->quantity) {
            $oth_cart = session()->get('oth_cart');

            $oth_cart[$request->id]["quantity"] = $request->quantity;

            session()->put('oth_cart', $oth_cart);
            $subTotal = $oth_cart[$request->id]['quantity'] * $oth_cart[$request->id]['price'];

            $total = $this->getCartTotal();

            $oth_total_quantity = session()->get('oth_total_quantity');
            session()->put('oth_total_quantity', array_sum(array_column($oth_cart, 'quantity')));

            $htmlCart = view('_header_cart')->render();

            return response()->json(['msg' => 'Cart updated successfully', 'data' => $htmlCart, 'total' => $total, 'subTotal' => $subTotal, 'totalQty' => session()->get('oth_total_quantity')]);

            //session()->flash('success', 'Cart updated successfully');
        }
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


    public function other_checkout(Request $request)
    {
        $user_data = Auth::user();

        if ($request->isMethod('post')) {

            if (empty(session('oth_cart'))) {
                session()->flash('message', 'Your Cart Is Currently Empty.');
                session()->flash('level', 'danger');
                return redirect('shop');
            }
            //echo '<pre>'; print_r($request->all());
            if (empty(Auth::id())) {
                // $validator = Order::validate($request->all(),[
                //     'first_name'=>'required'
                // ]);
                $validator = Validator::make($request->all(), [
                    'first_name'   => 'required',
                    'last_name'    => 'required',
                    'username'     => 'required',
                    'phone'        => 'required',
                    'email'        => 'required',
                    'address'      => 'required',
                    'address_1'    => 'required',
                    'city'         => 'required',
                    'state_name'   => 'required',
                    'zip'          => 'required',
                    'country_name' => 'required',
                    'address_type' => 'required',
                ]);
                if ($request->choise_details == 'billing_address') {
                    $validator = Validator::make($request->all(), [
                        'billing_full_name'    => 'required',
                        'billing_address'      => 'required',
                        'billing_address_1'    => 'required',
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
                } else {

                    $customer                   = new Customer;
                    $customer->pk_account       = 1;
                    $customer->customer_name    = $request->first_name . ' ' . $request->last_name;
                    $customer->pk_customer_type = 1;
                    $customer->address          = $request->address;
                    $customer->address_1        = $request->address_1;
                    $customer->city             = $request->city;
                    $customer->zip              = $request->zip;
                    $customer->state_name       = $request->state_name;
                    $customer->country_name     = $request->country_name;
                    $customer->email            = $request->email;
                    $customer->login_enable     = 1;
                    $customer->save();

                    $customer_user               = new User;
                    $customer_user->first_name   = $request->first_name;
                    $customer_user->last_name    = $request->last_name;
                    $customer_user->email        = $request->email;
                    $customer_user->phone        = $request->phone;
                    $customer_user->username     = $request->username;
                    $customer_user->password     = Hash::make(12345678);
                    $customer_user->pk_roles     = 4;
                    $customer_user->pk_account   = 1;
                    $customer_user->pk_customers = $customer->pk_customers;
                    $customer_user->save();

                    $pk_user_id     = $customer_user->pk_users;
                    $pk_customer_id = $customer->pk_customers;

                    // Login User
                    Auth::loginUsingId($pk_user_id);
                }

            } else {

                $validator = Order::validate_payment_card($request->all());
                // $validator = Validator::make($request->all(), [
                //     'cc_name'=>'required',
                //     'cc_number'=>'required',
                //     'expiry_month'=>'required',
                //     'expiry_year'=>'required',
                //     'cvv'=>'required',

                // ]);
                // if($request->choise_details == 'billing_address')
                // {
                //     $validator = Validator::make($request->all(), [
                //         'billing_full_name'=>'required',
                //         'billing_address'=>'required',
                //         'billing_address_1'=>'required',
                //         'billing_city'=>'required',
                //         'billing_state_name'=>'required',
                //         'billing_country_name'=>'required',
                //         'billing_zip'=>'required',

                //     ]);
                // }

                if ($validator->fails()) {

                    //echo '<pre>'; print_r($validator->errors()); die;

                    session()->flash('message', 'Order could not be placed, please correct errors.');
                    session()->flash('level', 'danger');
                    return redirect('other-checkout')->withErrors($validator)->withInput();
                } else {
                    $pk_user_id = Auth::id();
                    //
                    $customer_data1 = Customer::where('email', $user_data->email)->first();
                    if ($customer_data1) {
                        $pk_customer_id = $customer_data1->pk_customers;

                    } else {
                        $customer                   = new Customer;
                        $customer->pk_account       = 1;
                        $customer->customer_name    = $user_data->first_name . ' ' . $user_data->last_name;
                        $customer->pk_customer_type = 1;
                        $customer->address          = null;
                        $customer->address_1        = null;
                        $customer->city             = $request->city;
                        $customer->zip              = $request->zip;
                        $customer->state_name       = $request->state_name;
                        $customer->country_name     = $request->country_name;
                        $customer->email            = $user_data->email;
                        $customer->login_enable     = 1;
                        $customer->save();
                        //
                        $pk_customer_id = $customer->pk_customers;

                        $billing_data                 = array();
                        $billing_data['pk_users']     = $pk_customer_id;
                        $billing_data['full_name']    = $user_data->first_name;
                        $billing_data['email']        = $user_data->email;
                        $billing_data['phone']        = null;
                        $billing_data['address']      = null;
                        $billing_data['address_1']    = null;
                        $billing_data['city']         = !empty($request->city) ? $request->city : '';
                        $billing_data['state_name']   = !empty($request->state_name) ? $request->state_name : '';
                        $billing_data['country_name'] = !empty($request->country_name) ? $request->country_name : '';
                        $billing_data['zip']          = !empty($request->zip) ? $request->zip : '';
                        $get_address                  = Addres::create($billing_data);


                        //
                    }

                }
            }

            //echo '<pre>'; print_r($request->all());

            $get_address_type = !empty($request->address_type) ? $request->address_type : '';
            if ($get_address_type == 'new_address') {
                if (!empty(Auth::id())) {
                    $customer_info = Customer::find(Auth::user()->pk_customers);

                    $user_email = Auth::user()->email;
                    $user_phone = Auth::user()->phone;

                } else {
                    $user_email = $request->email;
                    $user_phone = $request->phone;
                }

                $billing_data                 = array();
                $billing_data['pk_users']     = $pk_user_id;
                $billing_data['full_name']    = !empty($request->billing_full_name) ? $request->billing_full_name : '';
                $billing_data['email']        = $user_email;
                $billing_data['phone']        = $user_phone;
                $billing_data['address']      = !empty($request->billing_address) ? $request->billing_address : '';
                $billing_data['address_1']    = !empty($request->billing_address_1) ? $request->billing_address_1 : '';
                $billing_data['city']         = !empty($request->billing_city) ? $request->billing_city : '';
                $billing_data['state_name']   = !empty($request->billing_state_name) ? $request->billing_state_name : '';
                $billing_data['country_name'] = !empty($request->billing_country_name) ? $request->billing_country_name : '';
                $billing_data['zip']          = !empty($request->billing_zip) ? $request->billing_zip : '';

                $billing_data['shipping_full_name']    = !empty($request->shipping_full_name) ? $request->shipping_full_name : $billing_data['full_name'];
                $billing_data['shipping_email']        = !empty($request->shipping_email) ? $request->shipping_email : $billing_data['email'];
                $billing_data['shipping_phone']        = !empty($request->shipping_mobile) ? $request->shipping_mobile : $billing_data['phone'];
                $billing_data['shipping_address']      = !empty($request->shipping_address) ? $request->shipping_address : $billing_data['address'];
                $billing_data['shipping_address_1']    = !empty($request->shipping_address_1) ? $request->shipping_address_1 : $billing_data['address_1'];
                $billing_data['shipping_city']         = !empty($request->shipping_city) ? $request->shipping_city : $billing_data['city'];
                $billing_data['shipping_state_name']   = !empty($request->shipping_state_name) ? $request->shipping_state_name : $billing_data['state_name'];
                $billing_data['shipping_country_name'] = !empty($request->shipping_country_name) ? $request->shipping_country_name : $billing_data['country_name'];
                $billing_data['shipping_zip']          = !empty($request->shipping_zip) ? $request->shipping_zip : $billing_data['zip'];

                $get_address = Addres::create($billing_data);
                //echo '<pre>'; print_r($billing_data);

            } else {
                $get_address                  = DB::table('kbt_shipping_address')->where('pk_address', !empty($request->existing_address_id) ? $request->existing_address_id : '')->first();
                $billing_data                 = array();
                $billing_data['full_name']    = !empty($get_address->billing_full_name) ? $get_address->billing_full_name : '';
                $billing_data['phone']        = !empty($get_address->billing_mobile) ? $get_address->billing_mobile : '';
                $billing_data['email']        = !empty($get_address->billing_email) ? $get_address->billing_email : '';
                $billing_data['address']      = !empty($get_address->billing_address) ? $get_address->billing_address : '';
                $billing_data['address_1']    = !empty($get_address->billing_address_1) ? $get_address->billing_address_1 : '';
                $billing_data['city']         = !empty($get_address->billing_city) ? $get_address->billing_city : '';
                $billing_data['state_name']   = !empty($get_address->billing_state_name) ? $get_address->billing_state_name : '';
                $billing_data['country_name'] = !empty($get_address->billing_country_name) ? $get_address->billing_country_name : '';
                $billing_data['zip']          = !empty($get_address->billing_zip) ? $get_address->billing_zip : '';

                $billing_data['shipping_full_name']    = !empty($get_address->shipping_full_name) ? $get_address->shipping_full_name : '';
                $billing_data['shipping_email']        = !empty($get_address->shipping_email) ? $get_address->shipping_email : '';
                $billing_data['shipping_phone']        = !empty($get_address->shipping_mobile) ? $get_address->shipping_mobile : '';
                $billing_data['shipping_address']      = !empty($get_address->shipping_address) ? $get_address->shipping_address : '';
                $billing_data['shipping_address_1']    = !empty($get_address->shipping_address_1) ? $get_address->shipping_address_1 : '';
                $billing_data['shipping_city']         = !empty($get_address->shipping_city) ? $get_address->shipping_city : '';
                $billing_data['shipping_state_name']   = !empty($get_address->shipping_state_name) ? $get_address->shipping_state_name : '';
                $billing_data['shipping_country_name'] = !empty($get_address->shipping_country_name) ? $get_address->shipping_country_name : '';
                $billing_data['shipping_zip']          = !empty($get_address->shipping_zip) ? $get_address->shipping_zip : '';

            }

            //echo '<pre>'; print_r($get_address_type); die;
            // Save Order Data RJ

            $customer_data = Customer::find($pk_customer_id);
            if (empty($customer_data)) {
                session()->flash('message', 'Customer could not be found, please correct errors.');
                session()->flash('level', 'danger');
                return redirect('other-checkout')->withErrors($validator)->withInput();
            } else {

                // Payment
                $pk_transactions = NULL;
                $payment_total   = 0;
                $payem_total_qty = 0;
                if (session('oth_cart')) {
                    foreach ((array)session('oth_cart') as $idp => $orderitempay) {
                        $quantity_payment = !empty($orderitempay['quantity']) ? $orderitempay['quantity'] : 0;
                        if ($quantity_payment > 0) {
                            $payment_total   += $orderitempay['price'] * $quantity_payment;
                            $payem_total_qty += $quantity_payment;
                        }
                    }

                    if (!empty(Auth::id())) {
                        $user_email = Auth::user()->email;

                        $request->request->add(['billing_email' => $user_email]);
                    }

                    $order_no = 'ORD' . str_pad(Order::max('pk_orders') + 1, 8, "0", STR_PAD_LEFT);
                    $res      = $this->handleonlinepay($request, $pk_user_id, $payment_total, $payem_total_qty, $order_no);

                    if ($res['msg_type'] == 'error_msg') {
                        session()->flash('message', $res['message_text'] . ', please correct errors.');
                        session()->flash('level', 'danger');
                        return redirect('other-checkout')->withErrors($validator)->withInput();
                    } else {
                        $pk_transactions = $res['trans_id'];
                    }

                }


                $save_order                    = array();
                $save_order['pk_users']        = $pk_user_id;
                $save_order['pk_transactions'] = $pk_transactions;
                $save_order['customer_name']   = !empty($get_address->shipping_full_name) ? $get_address->shipping_full_name : '';
                $save_order['email']           = !empty($get_address->shipping_email) ? $get_address->shipping_email : '';
                $save_order['phone']           = !empty($get_address->shipping_phone) ? $get_address->shipping_phone : '';
                $save_order['address']         = !empty($get_address->shipping_address) ? $get_address->shipping_address : '';
                $save_order['address_1']       = !empty($get_address->shipping_address_1) ? $get_address->shipping_address_1 : '';
                $save_order['city']            = !empty($get_address->shipping_city) ? $get_address->shipping_city : '';
                $save_order['state_name']      = !empty($get_address->shipping_state_name) ? $get_address->shipping_state_name : '';
                $save_order['country_name']    = !empty($get_address->shipping_country_name) ? $get_address->shipping_country_name : '';
                $save_order['zip']             = !empty($get_address->shipping_zip) ? $get_address->shipping_zip : '';
                $save_order['total']           = $request->amount;
                $save_order['pk_locations']    = $request->store_id;
                $save_order['pk_order_status'] = 1;

                $get_order = Order::create($save_order);

                if (session('oth_cart')) {
                    $total     = 0;
                    $total_qty = 0;
                    foreach ((array)session('oth_cart') as $id => $orderitem) {

                        $quantity = !empty($orderitem['quantity']) ? $orderitem['quantity'] : 0;
                        if ($quantity > 0) {

                            $total     += $orderitem['price'] * $quantity;
                            $total_qty += $quantity;

                            $save_order_item                = array();
                            $save_order_item['pk_orders']   = $get_order->pk_orders;
                            $save_order_item['name']        = !empty($orderitem['name']) ? $orderitem['name'] : '';
                            $save_order_item['description'] = !empty($orderitem['description']) ? $orderitem['description'] : '';
                            $save_order_item['quantity']    = $quantity;
                            $save_order_item['price']       = !empty($orderitem['price']) ? $orderitem['price'] : 0;
                            $save_order_item['photo']       = !empty($orderitem['photo']) ? $orderitem['photo'] : '';
                            $save_order_item['type']        = !empty($orderitem['type']) ? $orderitem['type'] : '';

                            OrderItem::create($save_order_item);

                        }
                    }
                    Order::where('pk_orders', $get_order->pk_orders)->update(array('total' => $total));
                }


                session()->forget('oth_cart');
                session()->forget('oth_total_quantity');
                session()->forget('oth_total_hit');

                session()->flash('message', 'Order has been placed successfully!');
                session()->flash('level', 'success');
                return redirect('thank-you/' . $get_order->pk_orders);

                //echo '<pre>'; print_r($save_order);
                //echo '<pre>'; print_r($customer_data); die;
            }
        }

        $pk_user_id = !empty($user_data->pk_users) ? $user_data->pk_users : '';

        $kbt_shipping_address = DB::table('kbt_shipping_address')->where('pk_users', $pk_user_id)->orderBy('pk_address', 'ASC')->get()->toArray();
        $countries            = \App\Country::all();
        $states               = \App\State::all();
        $store                = DB::table('kbt_locations')->get()->toArray();
        foreach ($store as $data) {
            $shippingurl = "https://maps.googleapis.com/maps/api/distancematrix/json?destinations=$data->city";
            $shippingurl .= "&origins=$data->city&key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A";
            $ch          = curl_init();
            curl_setopt($ch, CURLOPT_URL, $shippingurl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch), true);
        }
        return view('other-checkout', compact('user_data', 'kbt_shipping_address', 'countries', 'states', 'store', 'response'));
    }

    public function other_checkouts(Request $request)
    {
        $store  = DB::table('kbt_locations')->get()->toArray();
        $output = ['html' => null];
        foreach ($store as $data) {
            $shippingurl = "https://maps.googleapis.com/maps/api/distancematrix/json?destinations=$data->city";
            $shippingurl .= "&origins=$request->city&key=AIzaSyAB80hPTftX9xYXqy6_NcooDtW53kiIH3A";
            $ch          = curl_init();
            curl_setopt($ch, CURLOPT_URL, $shippingurl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            $responses = json_decode($result, true);
            // $distance = $responses['rows'][0]['elements'][0]['distance']['text'];
            //  echo   $distance = isset($responses['rows']) ? $responses['rows'][0]['elements'][0]['distance']['text'] : null;
            $distance = isset($responses['rows'][0]['elements'][0]['distance']) ? $responses['rows'][0]['elements'][0]['distance']['text'] : null;
            if ($distance != null) {
                $output['html'] .= '
        <div class="col-md-12 mb-3 store1">
                        <div class="row">
                            <div class="col-md-12"><h6>
                                ' . $data->location_name . '
                                </h6>
                            </div>
                            <div class="col-md-10">
                            <p>
                                ' . $data->address . ' ,
                                ' . $data->address_1 . ' ,
                                ' . $data->city . ' ,
                                ' . $data->zip . ' ,
                                ' . $data->state_name . ' ,
                                ' . $data->country_name . '
                            </p>
                            </div>
                            <div class="col-md-2">
                                <input type="radio" name="store_id" value="' . $data->pk_locations . '"  value="store"> Select

                            </div>
                            <div class="col-md-12">
                            <p>
                                ' . $distance . '
                            </p>

                            </div>
                        </div>


                        </div>
    ';
            }


        }
        return response()->json($output);
    }

    public function handleonlinepay($request, $user_id, $totla_amount, $qty, $order_no)
    {
        // thest by lemon
        $input = $request->input();
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

        $customerAddress->setAddress($input['address'] ?? $input['billing_address']);
        $customerAddress->setCity($input['city'] ?? $input['billing_city']);
        $customerAddress->setState($input['state_name'] ?? $input['billing_state_name']);
        $customerAddress->setZip($input['zip'] ?? $input['billing_zip']);
        $customerAddress->setCountry($input['country_name'] ?? $input['billing_country_name']);

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

                    $trans_id = \App\Transaction::create([
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

        $user_data = Auth::user();

        $order_items = DB::table('kbt_order_items')
            ->where('pk_orders', $pk_orders)->orderBy('pk_order_items', 'ASC')->get();

        return view('thank-you', compact('user_data', 'order_items', 'pk_orders'));
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

}
