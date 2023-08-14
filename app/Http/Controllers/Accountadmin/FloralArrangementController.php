<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flower;
use App\ColorFlower;
use App\VaseType;
use App\Style;
use App\VaseColor;
use App\ArrangementType;
use App\FloralArrangementPrice;
use DB;

class FloralArrangementController extends Controller
{

    public function index(Request $request)
    {
        $products = DB::table('kbt_product_category')->get();
        $flowers  = DB::table('kbt_floral_arrangements')
            //->join('kbt_flowers','kbt_floral_arrangements.pk_flowers','kbt_flowers.pk_flowers')
            ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
            ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
            ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
            ->get();
        //dd($flowers);
        /* $colorFlowers = ColorFlower::all();
         $vaseTypes    = VaseType::all();
         $vaseColors   = VaseColor::all();
         $styles       = Style::all();*/
        return view('floral-arrangement', ['flowers' => $flowers, 'products' => $products]);
    }

    public function detais($id)
    {
        $flower = DB::table('kbt_floral_arrangements')
            //->join('kbt_flowers','kbt_floral_arrangements.pk_flowers','kbt_flowers.pk_flowers')
            ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
            ->where('kbt_floral_arrangements.pk_floral_arrangements', $id)
            ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
            ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
            ->first();
        $category     = $flower->pk_product_category;
        $colorFlowers = ColorFlower::all();
        $vaseTypes    = VaseType::all();
        $vaseColors   = VaseColor::all();
        $styles       = Style::all();
        $flower_list  = Flower::where('active', 1)->get();

        //$dd( $aranPrice);arrangementTypes = ArrangementType::where('pk_account', $flower->pk_account)->get();

        $aranPrice = ArrangementType::where('created_by', $flower->created_by)->where('arrangement_type','Custom')->where('pk_account',$flower->pk_account)->first();

        $arrangementTypes    = ArrangementType::leftjoin('kbt_floral_arrangement_prices', 'kbt_arrangement_type.pk_arrangement_type', '=', 'kbt_floral_arrangement_prices.pk_arrangement_type')
            ->select('kbt_arrangement_type.pk_arrangement_type', 'kbt_arrangement_type.arrangement_type', 'kbt_floral_arrangement_prices.price')
            ->where('kbt_floral_arrangement_prices.pk_floral_arrangements', $id)
            ->where('kbt_arrangement_type.pk_account', $flower->pk_account)
            ->groupBy('kbt_arrangement_type.pk_arrangement_type')
            ->orderBy('kbt_floral_arrangement_prices.pk_floral_arrangement_prices', 'asc')
            ->get();


        $arrangementTypesCus = ArrangementType::where('pk_account', $flower->pk_account)->where('arrangement_type', 'Custom')
            ->select('kbt_arrangement_type.pk_arrangement_type', 'kbt_arrangement_type.arrangement_type', 'kbt_arrangement_type.price')
            ->get();
        $arrangementTypes    = $arrangementTypes->concat($arrangementTypesCus);

        /*if($multi_prices) $flower->price = $multi_prices[0]->price;
        $new_arrayPrice = array();
        foreach($multi_prices as $kk => $vv){
          $new_arrayPrice[$vv->pk_arrangement_type] = $vv->price;
        }*/

        return view('floral-arrangement-details', ['flower' => $flower,'aranPrice'=>$aranPrice, 'colorFlowers' => $colorFlowers, 'vaseTypes' => $vaseTypes, 'colorFlowers' => $colorFlowers, 'styles' => $styles, 'arrangementTypes' => $arrangementTypes, 'flower_list' => $flower_list , 'category'=>$category]);
    }

    public function addCard(Request $request)
    {
        $flower_arrangement = $request->all();

        $flower_name = Flower::find($request->flower_id);
        $flower_name = !empty($flower_name->flowers) ? $flower_name->flowers : '';

        $colorflower_name = ColorFlower::find($request->color);
        $colorflower_name = !empty($colorflower_name->color_flower) ? $colorflower_name->color_flower : '';

        $style_name = Style::find(!empty($request->style) ? $request->style : '');
        $style_name = !empty($style_name->styles) ? $style_name->styles : '';

        $flower = DB::table('kbt_floral_arrangements')
            //->join('kbt_flowers','kbt_floral_arrangements.pk_flowers','kbt_flowers.pk_flowers')
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

        $arrangementTypesName = !empty($arrangementTypes) ? $arrangementTypes->arrangement_type : '';
        $pk_arrangement_type  = !empty($request->arrangementType) ? $request->arrangementType : '';

        $flower_bouquet_data = join(' - ', array_filter(array($flower_name, $colorflower_name, $style_name, $arrangementTypesName)));
        $flower_description  = !empty($flower->description) ? $flower->description : '';

        $quantity = !empty($request->quantity) ? $request->quantity : 1;
        //$price    = !empty($flower->price)?$flower->price:0;
        $price = '0.00';
        if ($arrangementTypes) {
            $price = !empty($arrangementTypes->price) ? $arrangementTypes->price : 0;
        }
        $photo = !empty($flower->path) ? $flower->path : '';

        //echo '<pre>'; print_r($flower_bouquet_data); die;

        // Add in Cart Session RJ

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

            $oth_cart[$oth_total_hit] = [
                "name"                 => $flower_bouquet_data,
                "arrangementTypesName" => $arrangementTypesName,
                "pk_arrangement_type"  => $pk_arrangement_type,
                "description"          => $flower_description,
                "quantity"             => $quantity,
                "price"                => ($request->custom_price) ? $request->custom_price : $price,
                "photo"                => $photo,
                "type"                 => 5
            ];

            $oth_total_quantity += 1;
            session()->put('oth_cart', $oth_cart);
            session()->put('oth_total_quantity', $oth_total_quantity);
            session()->put('oth_total_hit', $oth_total_hit + 1);

            $htmlCart = view('_header_cart')->render();
            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);
            /*session()->flash('message','Floral arrangement added to cart successfully!');
            session()->flash('level','success');*/
            //return redirect('/other-cart');
        }

        if (isset($oth_cart[$oth_total_hit])) {

            $oth_cart[$oth_total_hit]['quantity']++;
            $oth_total_quantity += 1;

            session()->put('oth_cart', $oth_cart);
            session()->put('oth_total_quantity', $oth_total_quantity);
            session()->put('oth_total_hit', $oth_total_hit + 1);

            $htmlCart = view('_header_cart')->render();
            return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

            /*session()->flash('message','Floral arrangement added to cart successfully!');
            session()->flash('level','success');
            return redirect('/other-cart');*/

            //$htmlCart = view('_header_cart')->render();
            //return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

        }

        // if item not exist in cart then add to cart with quantity = 1

        $oth_cart[$oth_total_hit] = [
            "name"                 => $flower_bouquet_data,
            "arrangementTypesName" => $arrangementTypesName,
            "pk_arrangement_type"  => $pk_arrangement_type,
            "description"          => $flower_description,
            "quantity"             => $quantity,
            "price"                => ($request->custom_price) ? $request->custom_price : $price,
            "photo"                => $photo,
            "type"                 => 5
        ];

        $oth_total_quantity += 1;

        session()->put('oth_cart', $oth_cart);
        session()->put('oth_total_quantity', $oth_total_quantity);
        session()->put('oth_total_hit', $oth_total_hit + 1);

        $htmlCart = view('_header_cart')->render();
        return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

    }

    public function category($category)
    {
        $categoryId = \Illuminate\Support\Facades\Crypt::decrypt($category);
        $products   = DB::table('kbt_product_category')->get();
        $flowers    = DB::table('kbt_floral_arrangements')
            ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
            ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
            ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
            ->where('kbt_floral_arrangements.pk_product_category', $categoryId)->get();
        return view('floral-arrangement', ['flowers' => $flowers, 'products' => $products, 'categoryId' => $categoryId]);

    }

}
