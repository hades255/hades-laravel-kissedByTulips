<?php

namespace App\Http\Controllers\Accountadmin;

use App\Location;
use App\LocationTime;
use App\ProductCategory;
use GuzzleHttp\Client;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\ArrangementType;
use App\ColorFlower;
use App\Country;
use App\Customer;
use App\Flower;
use App\Http\Requests\SaleRequest;
use App\Order;
use App\Sale;
use App\SaleType;
use App\State;
use App\Style;
use App\Transaction;
use App\User;
use App\Product;
use App\FloralArrangement;
use App\VaseType;
use App\UserLocation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use net\authorize\api\constants\ANetEnvironment;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        session()->forget('pos_cart');
        session()->forget('pos_total_quantity');

        $sales = Sale::with(['arrangementType', 'order'])->latest()->get();

        if ($request->search) {
            $search = $request->search;
            $sales  = Sale::with(['arrangementType', 'order'])
                ->where('customer_name', 'LIKE', '%' . $search . '%')
                ->orWhereHas('order', function ($order) use ($search) {
                    $order->where('email', 'LIKE', '%' . $search . '%')
                        ->orWhere('phone', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('arrangementType', function ($arrangementType) use ($search) {
                    $arrangementType->where('arrangement_type', 'LIKE', '%' . $search . '%');
                })
                ->get();
        }

        return view('accountadmin.sales.index', compact('sales', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $products   = Product::with('images')->get();
        $categories = ProductCategory::all();
        // foreach($products as $product){
        //   echo "<pre>"; print_r($product->images); die;
        // }
        //  echo "<pre>"; print_r($products->images); die;
        return view('accountadmin.sales.add', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaleRequest $request)
    {
        try {
            DB::beginTransaction();

            if ($request->has('is_order_sale')) {
                if (!$request->pk_order) {
                    return redirect()->back()
                        ->with('error', 'Please select an order!');
                }

                $order = Order::with('order_items')->find($request->pk_order);

                if ($order) {
                    $this->saveOrderSaleData($order);
                }

                DB::commit();

                return redirect()->route('accountadmin.sales.index')
                    ->with('success', 'Sale created successfully.');
            }

            $posCart = session('pos_cart');

            if (!$posCart || !count($posCart)) {
                return redirect()->back()->with('error', 'The cart is empty, please add some products to cart!');
            }

            $pk_user  = null;
            $customer = null;
            $saleType = SaleType::where('sale_type', 'POS')->first();

            if ($request->pk_customer) {
                $customer = Customer::find($request->pk_customer);
            }

            if ($customer) {
                $user    = User::where('email', $customer->email)->first();
                $pk_user = $user->pk_users ?? null;
            }

            $cartTotal = $this->getCartTotal();

            $location = Location::where('pk_locations', $request->pk_locations)->first();

            $grandTotal = $cartTotal;
            if ($location) {
                $grandTotal = $grandTotal + $location->tax_rate;
            }

            $res = $this->handlePaymentByGateway($request, $grandTotal);
            if ($res['msg_type'] == 'error_msg') {
                session()->flash('error', $res['message_text'] . ', please correct errors!');
                return back()->withInput();
            }

            $salesData = [
                'pk_users'            => $pk_user,
                'pk_account'          => 1,
                'pk_order_status'     => 3,
                'pk_arrangement_type' => $request->pk_arrangement_type,
                'customer_name'       => $customer->customer_name ?? 'Store/Cash Sale',
                'pk_customers'        => $request->pk_customer,
                'subtotal'            => $cartTotal,
                'tax_total'           => $location->tax_rate ?? 0,
                'total'               => $grandTotal,
                'pk_sales_type'       => $saleType->pk_sales_type ?? null,
                'pk_transactions'     => $res['trans_id'] ?? null,
                'pk_locations'        => $location->pk_locations ?? null,
                'pk_location_times'   => LocationTime::where('pk_locations', $location->pk_locations)
                        ->first()->pk_location_times ?? null,
                'is_paid'             => true,
                'created_by'          => Auth::id(),
                'updated_by'          => Auth::id(),
            ];

            $sale = Sale::create($salesData);
            foreach ($posCart as $item) {
                $sale->saleItems()->create([
                    'name'        => $item['name'],
                    'description' => $item['description'],
                    'quantity'    => $item['quantity'],
                    'price'       => $item['price'],
                    'type'        => $item['type'],
                    'created_by'  => Auth::id(),
                    'updated_by'  => Auth::id(),
                ]);
            }

            DB::commit();

            session()->forget('pos_cart');
            session()->forget('pos_total_quantity');

            return redirect()->route('accountadmin.sales.index')
                ->with('success', 'Sale created successfully.');
        } catch (ValidationException $exception) {
            DB::rollBack();
            throw $exception;
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function storeSaleFromOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!$request->pk_order) {
                return redirect()->back()
                    ->with('error', 'Please select an order!');
            }

            $order = Order::with(['order_items', 'customer'])->find($request->pk_order);

            if ($order) {
                $this->saveOrderSaleData($order);
            }


            DB::commit();

            session()->forget('pos_cart');
            session()->forget('pos_total_quantity');

            return redirect()->route('accountadmin.sales.index')
                ->with('success', 'Sale created successfully.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later!' . $exception->getMessage());
        }
    }

    private function saveOrderSaleData(Order $order)
    {
        $customer   = Customer::where('email', $order->email)->first();
        $saleType   = SaleType::where('sale_type', 'POS')->first();
        $orderTotal = $this->getOrderTotal($order);
        $taxRate    = $order->location->tax_rate ?? 0;
        $grandTotal = $orderTotal + $taxRate;

        $sale = Sale::create([
            'pk_orders'            => $order->pk_orders,
            'pk_users'             => $order->pk_users,
            'pk_account'           => 1,
            'pk_order_status'      => 3,
            'pk_arrangement_type'  => $order->pk_arrangement_type,
            'customer_name'        => $order->customer->customer_name ?? 'Store/Cash Sale',
            'pk_customers'         => $customer->pk_customers ?? null,
            'subtotal'             => $order->total,
            'tax_total'            => $taxRate,
            'total'                => $grandTotal,
            'pk_sales_type'        => $saleType->pk_sales_type ?? null,
            'pk_transactions'      => $order->pk_transactions,
            'pk_locations'         => $order->pk_locations,
            'pk_location_times'    => $order->pk_location_times,
            'is_paid'              => (bool)$order->pk_transactions,
            'discountCharge'       => $order->discountCharge,
            'coupon_discount_type' => $order->coupon_discount_type,
            'created_by'           => Auth::id(),
            'updated_by'           => Auth::id(),
        ]);

        $order                  = Order::find($order->pk_orders);
        $order->pk_order_status = 3;
        $order->save();

        if ($order->order_items->count()) {
            foreach ($order->order_items as $item) {
                $sale->saleItems()->create([
                    'name'        => $item['name'],
                    'description' => $item['description'],
                    'quantity'    => $item['quantity'],
                    'price'       => $item['price'],
                    'type'        => $item['type'],
                    'created_by'  => Auth::id(),
                    'updated_by'  => Auth::id(),
                ]);
            }
        }

        return $sale;
    }

    /**
     * Display the specified resource.
     *
     * @param Sale $sale
     * @return Application|Factory|View
     */
    public function show(Sale $sale)
    {
        $sale->load('saleItems');
        return view('accountadmin.sales.detail', compact('sale'));
    }


    public function select2Orders(Request $request)
    {
        $orders = Order::query()->with(['customer']);
        if ($request->q) {
            $orders->whereHas('customer', function ($q) use ($request) {
                $q->where('customer_name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('office_phone', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->q . '%');
            })
                ->orWhere('pk_orders', 'LIKE', '%' . $request->q . '%');
        }
        $orders    = $orders->get();
        $orderData = [];
        foreach ($orders as $order) {
            $orderData[] = [
                'text' => $order->pk_orders . '. ' . @$order->customer->customer_name . ' (' . @$order->customer->office_phone . ' - ' . @$order->customer->email . ' )',
                'id'   => $order->pk_orders,
            ];
        }
        return response([
            'results' => $orderData
        ]);
    }

    public function select2Customers(Request $request)
    {
        $customers = Customer::query();
        if ($request->q) {
            $customers->where('customer_name', 'LIKE', '%' . $request->q . '%')
                ->orWhere('office_phone', 'LIKE', '%' . $request->q . '%')
                ->orWhere('email', 'LIKE', '%' . $request->q . '%');
        }
        $customers = $customers->get();
        $cusData   = [];
        foreach ($customers as $customer) {
            $text = $customer->customer_name;

            if ($customer->office_phone) {
                $text .= ' (' . $customer->office_phone . ')';
            }

            if ($customer->email) {
                $text .= ' (' . $customer->email . ')';
            }

            if ($customer->office_phone && $customer->email) {
                $text = $customer->customer_name . ' (' . $customer->office_phone . ' - ' . $customer->email . ' )';
            }

            $cusData[] = [
                'text' => $text,
                'id'   => $customer->pk_customers,
            ];
        }
        return response([
            'results' => $cusData
        ]);
    }

    public function floralArrangement()
    {
        $products = DB::table('kbt_product_category')->get();

        $flowers = DB::table('kbt_floral_arrangements')
            //->join('kbt_flowers','kbt_floral_arrangements.pk_flowers','kbt_flowers.pk_flowers')
            ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
            ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
            ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
            ->get();

        return view('accountadmin.sales.floral-arrangement', ['flowers' => $flowers, 'products' => $products]);
    }

    public function productByCategory(Request $request)
    {
        $category = ProductCategory::find($request->category_id);

        if (!$category) {
            $products     = Product::with('images')->get();
            $htmlResponse = view('accountadmin.sales.product-response', compact('products'))->render();

            return response()->json([
                'success' => true,
                'data'    => $htmlResponse
            ]);
        }

        $products     = FloralArrangement::with('images')
            ->where('pk_product_category', $request->category_id)->get();
        $htmlResponse = view('accountadmin.sales.floral-arrangement-category-response', compact('products'))->render();

        return response()->json([
            'success' => true,
            'data'    => $htmlResponse
        ]);
    }

    public function floralArrangementByCategory($category)
    {
        $user_data = $user = auth()->user();

        $loginUserID = auth()->user()->pk_account;
        $categoryId  = Crypt::decrypt($category);
        $products    = DB::table('kbt_product_category')->get();
        $flowers     = DB::table('kbt_floral_arrangements')
            ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
            ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
            ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
            ->where('kbt_floral_arrangements.pk_product_category', $categoryId)->get();


        // This query will collect all locations of a user as an array
        $location_id = UserLocation::select('pk_locations')->where('pk_users', $user_data->pk_users)->get()->toArray() ?? null;

        $allProducts = [];
        if (isset($categoryId) && ($categoryId == 100)) {
            if (isset($location_id)) {

                // $flowers->where('pk_locations', $location_id)
                //     ->orWhereNull('pk_locations');
                // $allProducts = Product::where('pk_account', $loginUserID)->whereIn('pk_locations', $location_id)->get();
                $allProducts = Product::with('images')->where('pk_account', $loginUserID)->whereIn('pk_locations', $location_id)->get();
                //echo "<pre>"; print_r($allProducts); die;
            } else {
                $allProducts = Product::where('pk_account', $loginUserID)->WhereNull('pk_locations');

                //$flowers->WhereNull('pk_locations');
            }
            //$allProducts = Product::where('pk_account',$loginUserID)->get();
        }
        return view('accountadmin.sales.floral-arrangement', ['flowers' => $flowers, 'products' => $products, 'categoryId' => $categoryId, 'allProducts' => $allProducts]);
    }

    public function floralArrangementDetails($id)
    {

        $flower = DB::table('kbt_floral_arrangements')
            ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
            ->where('kbt_floral_arrangements.pk_floral_arrangements', $id)
            ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
            ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
            ->first();

        $colorFlowers = ColorFlower::all();
        $vaseTypes    = VaseType::all();
        $styles       = Style::all();
        $flower_list  = Flower::where('active', 1)->get();


        $arrangementTypes    = ArrangementType::leftjoin(
            'kbt_floral_arrangement_prices',
            'kbt_arrangement_type.pk_arrangement_type',
            '=',
            'kbt_floral_arrangement_prices.pk_arrangement_type'
        )
            ->select(
                'kbt_arrangement_type.pk_arrangement_type',
                'kbt_arrangement_type.arrangement_type',
                'kbt_floral_arrangement_prices.price'
            )
            ->where('kbt_floral_arrangement_prices.pk_floral_arrangements', $id)
            ->where('kbt_arrangement_type.pk_account', $flower->pk_account)
            ->groupBy('kbt_arrangement_type.pk_arrangement_type')
            ->orderBy('kbt_floral_arrangement_prices.pk_floral_arrangement_prices', 'asc')
            ->get();
        $arrangementTypesCus = ArrangementType::where('pk_account', $flower->pk_account)
            ->where('arrangement_type', 'Custom')
            ->select(
                'kbt_arrangement_type.pk_arrangement_type',
                'kbt_arrangement_type.arrangement_type',
                'kbt_arrangement_type.price'
            )
            ->get();
        $arrangementTypes    = $arrangementTypes->concat($arrangementTypesCus);


        return view('accountadmin.sales.floral-arrangement-details', [
            'flower'           => $flower,
            'colorFlowers'     => $colorFlowers,
            'vaseTypes'        => $vaseTypes,
            'styles'           => $styles,
            'arrangementTypes' => $arrangementTypes,
            'flower_list'      => $flower_list
        ]);
    }

    public function productDetails($id)
    {
        // $flower = DB::table('kbt_floral_arrangements')
        // ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
        // ->where('kbt_floral_arrangements.pk_floral_arrangements', $id)
        // ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
        // ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
        // ->first();
        // $flower = DB::table('kbt_products')
        //     ->where('kbt_products.pk_products', $id)
        //     ->select("kbt_products.*")
        //     ->first();
        $flower       = DB::table('kbt_products')
            ->join('kbt_product_images', 'kbt_products.pk_products', 'kbt_product_images.pk_products')
            ->where('kbt_products.pk_products', $id)
            ->select("kbt_products.*", "kbt_product_images.path")
            ->first();
        $colorFlowers = ColorFlower::all();
        $vaseTypes    = VaseType::all();
        $styles       = Style::all();
        $flower_list  = Flower::where('active', 1)->get();


        // $arrangementTypes    = ArrangementType::leftjoin(
        //     'kbt_floral_arrangement_prices',
        //     'kbt_arrangement_type.pk_arrangement_type',
        //     '=',
        //     'kbt_floral_arrangement_prices.pk_arrangement_type'
        // )
        //     ->select(
        //         'kbt_arrangement_type.pk_arrangement_type',
        //         'kbt_arrangement_type.arrangement_type',
        //         'kbt_floral_arrangement_prices.price'
        //     )
        //     ->where('kbt_floral_arrangement_prices.pk_floral_arrangements', $id)
        //     ->where('kbt_arrangement_type.pk_account', $flower->pk_account)
        //     ->groupBy('kbt_arrangement_type.pk_arrangement_type')
        //     ->orderBy('kbt_floral_arrangement_prices.pk_floral_arrangement_prices', 'asc')
        //     ->get();
        // $arrangementTypesCus = ArrangementType::where('pk_account', $flower->pk_account)
        //     ->where('arrangement_type', 'Custom')
        //     ->select(
        //         'kbt_arrangement_type.pk_arrangement_type',
        //         'kbt_arrangement_type.arrangement_type', 'kbt_arrangement_type.price'
        //     )
        //     ->get();
        // $arrangementTypes    = $arrangementTypes->concat($arrangementTypesCus);

        $arrangementTypes = "";
        return view('accountadmin.sales.productdetails', [
            'flower'           => $flower,
            'colorFlowers'     => $colorFlowers,
            'vaseTypes'        => $vaseTypes,
            'styles'           => $styles,
            'arrangementTypes' => $arrangementTypes,
            'flower_list'      => $flower_list
        ]);
    }

    public function floralArrangmentAddToCart(Request $request)
    {
        $flower = DB::table('kbt_floral_arrangements')
            ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
            ->where('kbt_floral_arrangements.pk_floral_arrangements', $request->id)
            ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
            ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
            ->first();

        $arrangementTypes = ArrangementType::leftjoin('kbt_floral_arrangement_prices', 'kbt_arrangement_type.pk_arrangement_type', '=', 'kbt_floral_arrangement_prices.pk_arrangement_type')
            ->select('kbt_arrangement_type.pk_arrangement_type', 'kbt_arrangement_type.arrangement_type', 'kbt_floral_arrangement_prices.price')
            ->where('kbt_floral_arrangement_prices.pk_arrangement_type', $request->arrangementType)
            ->where('kbt_floral_arrangement_prices.pk_floral_arrangements', $request->id)
            ->where('kbt_arrangement_type.pk_account', $flower->pk_account)
            ->first();
        $flower_name      = FloralArrangement::find($request->id);

        //$flower_name      = Flower::find($request->flower_id);
        $colorflower_name = ColorFlower::find($request->color);
        $style_name       = Style::find(!empty($request->style) ? $request->style : '');
        $flower_name      = !empty($flower_name) ? $flower_name->title : '';

        //$flower_name      = !empty($flower_name) ? $flower_name->flowers : '';
        $colorflower_name = !empty($colorflower_name) ? $colorflower_name->color_flower : '';
        $style_name       = !empty($style_name) ? $style_name->styles : '';

        $arrangementTypesName = !empty($arrangementTypes) ? $arrangementTypes->arrangement_type : '';
        $pk_arrangement_type  = !empty($request->arrangementType) ? $request->arrangementType : '';

        $flower_bouquet_data = join(' - ', array_filter([$flower_name, $colorflower_name, $style_name, $arrangementTypesName]));
        $flower_description  = !empty($flower->description) ? $flower->description : '';

        $quantity = !empty($request->quantity) ? $request->quantity : 1;
        $price    = $arrangementTypes ? (!empty($arrangementTypes->price) ? $arrangementTypes->price : 0) : '0.00';
        $photo    = !empty($flower->path) ? $flower->path : '';
        $pos_cart = session()->get('pos_cart', []);

        $pos_total_quantity = session()->get('pos_total_quantity', 0);

        if (!empty($pos_cart[$flower->pk_floral_arrangements])) {
            $pos_cart[$flower->pk_floral_arrangements]['quantity']++;
            $pos_total_quantity += 1;
        } else {
            $pos_cart[$flower->pk_floral_arrangements] = [
                "name"                 => $flower_bouquet_data,
                "arrangementTypesName" => $arrangementTypesName,
                "pk_arrangement_type"  => $pk_arrangement_type,
                "description"          => $flower_description,
                "quantity"             => $quantity,
                "price"                => $price,
                "photo"                => $photo,
                "type"                 => 5
            ];
            $pos_total_quantity                        += 1;
        }

        session()->put('pos_cart', $pos_cart);
        session()->put('pos_total_quantity', $pos_total_quantity);

        return response()->json(['msg' => 'Product added to cart successfully!']);
    }

    public function productAddToCart(Request $request)
    {
        $flower = DB::table('kbt_products')
            ->join('kbt_product_images', 'kbt_products.pk_products', 'kbt_product_images.pk_products')
            ->where('kbt_products.pk_products', $request->id)
            ->select("kbt_products.*", "kbt_product_images.path")
            ->groupBy('kbt_products.pk_products')
            ->first();
        //echo "<pre>"; print_r($flower); die;
        // $arrangementTypes = ArrangementType::leftjoin('kbt_floral_arrangement_prices', 'kbt_arrangement_type.pk_arrangement_type', '=', 'kbt_floral_arrangement_prices.pk_arrangement_type')
        //     ->select('kbt_arrangement_type.pk_arrangement_type', 'kbt_arrangement_type.arrangement_type', 'kbt_floral_arrangement_prices.price')
        //     ->where('kbt_floral_arrangement_prices.pk_arrangement_type', $request->arrangementType)
        //     ->where('kbt_floral_arrangement_prices.pk_floral_arrangements', $request->id)
        //     ->where('kbt_arrangement_type.pk_account', $flower->pk_account)
        //     ->first();
        //$flower_name = FloralArrangement::find($request->id);
        $arrangementTypes = "";
        //$flower_name      = Flower::find($request->flower_id);
        $flower_name      = $flower->product;
        $colorflower_name = ColorFlower::find($request->color);
        $style_name       = Style::find(!empty($request->style) ? $request->style : '');
        //$flower_name      = !empty($flower_name) ? $flower_name->title : '';

        //$flower_name      = !empty($flower_name) ? $flower_name->flowers : '';
        $colorflower_name = !empty($colorflower_name) ? $colorflower_name->color_flower : '';
        $style_name       = !empty($style_name) ? $style_name->styles : '';

        $arrangementTypesName = !empty($arrangementTypes) ? $arrangementTypes->arrangement_type : '';
        $pk_arrangement_type  = !empty($request->arrangementType) ? $request->arrangementType : '';

        $flower_bouquet_data = $flower->product;

        $flower_description = !empty($flower->description) ? $flower->description : '';

        $quantity = !empty($request->quantity) ? $request->quantity : 1;

        $price    = $flower->price ? (!empty($flower->price) ? $flower->price : 0) : '0.00';
        $photo    = !empty($flower->path) ? $flower->path : '';
        $pos_cart = session()->get('pos_cart', []);

        $pos_total_quantity = session()->get('pos_total_quantity', 0);

        if (!empty($pos_cart[$flower->pk_products])) {
            $pos_cart[$flower->pk_products]['quantity']++;
            $pos_total_quantity += 1;
        } else {
            $pos_cart[$flower->pk_products] = [
                "name"                 => $flower_bouquet_data,
                "arrangementTypesName" => $arrangementTypesName,
                "pk_arrangement_type"  => $pk_arrangement_type,
                "description"          => $flower_description,
                "quantity"             => $quantity,
                "price"                => $price,
                "photo"                => $photo,
                "type"                 => 5
            ];
            $pos_total_quantity             += 1;
        }

        session()->put('pos_cart', $pos_cart);
        session()->put('pos_total_quantity', $pos_total_quantity);

        return response()->json([
            'msg'                => 'Product added to cart successfully!',
            'pos_total_quantity' => $pos_total_quantity,
        ]);
    }

    public function removeCartItem(Request $request)
    {
        $id   = $request->id;
        $cart = session('pos_cart');

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('pos_cart', $cart);
        }

        $total = $this->getCartTotal();

        session()->put('pos_total_quantity', array_sum(array_column($cart, 'quantity')));

        return response()->json(['msg' => 'Product removed successfully', 'total' => $total]);
    }

    // Get cart total
    private function getCartTotal()
    {
        $total = 0;

        $cart = session()->get('pos_cart');

        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }

    private function getOrderTotal(Order $order)
    {
        $total = 0;

        if ($order->order_items->count()) {
            foreach ($order->order_items as $item) {
                $total += $item->price * $item->quantity;
            }
        }

        return $total;
    }

    // Get quantity total
    private function getCartTotalQuantity()
    {
        $total = 0;

        $cart = session()->get('pos_cart');

        foreach ($cart as $details) {
            $total += $details['quantity'];
        }

        return $total;
    }


    public function updateCartItem(Request $request)
    {
        $id       = $request->id;
        $quantity = $request->quantity;
        $cart     = session('pos_cart');

        $cart[$id]["quantity"] = $quantity;

        session()->put('pos_cart', $cart);

        $total = $quantity * $request->price;

        // $total = $this->getCartTotal();
        // echo "<pre>"; print_r($total ); die;


        session()->put('pos_total_quantity', array_sum(array_column($cart, 'quantity')));

        return response()->json([
            'msg'      => 'Cart updated successfully.',
            'total'    => $total,
            'totalQty' => $quantity
        ]);
    }

    public function checkout()
    {
        if (!session('pos_cart') || !count(session('pos_cart'))) {
            return redirect()->route('accountadmin.sales.create')
                ->with('error', 'The cart is empty, please add some products to cart!');
        }

        $user_data = Auth::user();

        $location = $this->getLocation();

        return view('accountadmin.sales.checkout', compact('user_data', 'location'));
    }

    private function handlePaymentByGateway($request, $total_amount)
    {
        $qty      = $this->getCartTotalQuantity();
        $order_no = 'SALE' . str_pad(Sale::max('pk_sales') + 1, 8, "0", STR_PAD_LEFT);

        // Card details
        $cardName    = $request->cc_name;
        $cardNumber  = preg_replace('/\s+/', '', $request->cc_number);
        $expiryYear  = $request->expiry_year;
        $expiryMonth = $request->expiry_month;
        $cvv         = $request->cvv;
        $expiryDate  = $expiryYear . '-' . $expiryMonth;


        // Customer data
        $customer = Customer::where('pk_customers', $request->pk_customer)->first();


        // Set up merchant authentication
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName('4Y5pCy8Qr');
        $merchantAuthentication->setTransactionKey('4ke43FW8z3287HV5');

        $refId = 'ref' . time();

        // Create credit card object
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($cardNumber);
        $creditCard->setExpirationDate($expiryDate);
        $creditCard->setCardCode($cvv);

        // Create payment object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($order_no);
        $order->setDescription('KBT Sale');


        if ($customer) {
            // Set customer's address
            $customerAddress = new AnetAPI\CustomerAddressType();
            $customerAddress->setFirstName($cardName);
            $customerAddress->setLastName($cardName);
            $customerAddress->setAddress($customer->address ?? '');
            $customerAddress->setCity($customer->city ?? '');
            $customerAddress->setState($customer->state_name ?? '');
            $customerAddress->setZip($customer->zip ?? '');
            $customerAddress->setCountry($customer->country_name ?? '');

            // Set customer's data
            $customerData = new AnetAPI\CustomerDataType();
            $customerData->setEmail($customer->email ?? '');
        }


        // Create transaction request
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($total_amount);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        if ($customer) {
            $transactionRequestType->setBillTo($customerAddress);
        }

        // Assemble the complete transaction request
        $requests = new AnetAPI\CreateTransactionRequest();
        $requests->setMerchantAuthentication($merchantAuthentication);
        $requests->setRefId($refId);
        $requests->setTransactionRequest($transactionRequestType);

        // Create the transaction controller and get the response
        $controller = new AnetController\CreateTransactionController($requests);
        $response   = $controller->executeWithApiResponse(ANetEnvironment::SANDBOX);

        $trans_id = 0;

        // Check if the API request was successful
        if ($response == null) {
            return ['msg_type' => "error_msg", 'message_text' => "No response returned", 'trans_id' => $trans_id];
        }

        if ($response->getMessages()->getResultCode() == "Ok") {
            // Parse the transaction response
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getMessages() != null) {
                $message_text = $tresponse->getMessages()[0]->getDescription() . ", Transaction ID: " . $tresponse->getTransId();
                $msg_type     = "success_msg";

                // Create a new transaction record
                $trans_id = Transaction::create([
                    'amount'         => $total_amount,
                    'response_code'  => $tresponse->getResponseCode(),
                    'transaction_id' => $tresponse->getTransId(),
                    'auth_id'        => $tresponse->getAuthCode(),
                    'message_code'   => $tresponse->getMessages()[0]->getCode(),
                    'name_on_card'   => trim($cardName),
                    'account_type'   => $tresponse->getAccountType(),
                    'currency'       => 'USD',
                    'created_by'     => auth()->user()->pk_users,
                    'quantity'       => $qty
                ])->pk_transactions;
            } else {
                $message_text = 'There were some issues with the payment. Please try again later.';
                $msg_type     = "error_msg";

                if ($tresponse->getErrors() != null) {
                    $message_text = $tresponse->getErrors()[0]->getErrorText();
                    $msg_type     = "error_msg";
                }
            }
        } else {
            $message_text = 'There were some issues with the payment. Please try again later!';
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

        return ['msg_type' => $msg_type, 'message_text' => $message_text, 'trans_id' => $trans_id];
    }

    private function getLocation()
    {
        $storeAddress = '1838 Newport Boulevard';
        $storeCity    = 'Costa Mesa';
        $zip          = '92627';
        $locationName = 'Costa Mesa';
        return Location::where('location_name', $locationName)
            ->orWhere('address', $storeAddress)
            ->orWhere('city', $storeCity)
            ->orWhere('zip', $zip)
            ->first();
    }
}
