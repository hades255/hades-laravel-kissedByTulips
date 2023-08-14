<?php

namespace App\Http\Controllers;

use App\FloralArrangementPrice;
use App\FloralArrangementsImage;
use Illuminate\Http\Request;
use App\Flower;
use App\ColorFlower;
use App\VaseType;
use App\Style;
use App\VaseColor;
use App\ArrangementType;
use App\FloralArrangement;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
        $flower       = DB::table('kbt_floral_arrangements')
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


        $aranPrice = ArrangementType::where('created_by', $flower->created_by)->where('arrangement_type', 'Custom')->where('pk_account', $flower->pk_account)->first();


        $arrangementTypes = ArrangementType::leftjoin('kbt_floral_arrangement_prices', 'kbt_arrangement_type.pk_arrangement_type', '=', 'kbt_floral_arrangement_prices.pk_arrangement_type')
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

        return view('floral-arrangement-details', ['flower' => $flower, 'aranPrice' => $aranPrice, 'colorFlowers' => $colorFlowers, 'vaseTypes' => $vaseTypes, 'colorFlowers' => $colorFlowers, 'styles' => $styles, 'arrangementTypes' => $arrangementTypes, 'flower_list' => $flower_list, 'category' => $category]);
    }

    public function addCard(Request $request)
    {
        // Get Floral Arrangement
        $floralArrangement = FloralArrangement::find($request->id);

        // Get Floral Arrangement Image
        $image = $floralArrangement->images->first();

        // Get Floral Arrangement Price & Type
        $arrangementType = FloralArrangementPrice::where('pk_floral_arrangements', $request->id)
            ->where('pk_arrangement_type', $request->arrangementType)
            ->where('pk_account', $floralArrangement->pk_account)
            ->first();

        // Set data for Cart
        $flowerName          = $floralArrangement->title ?? '';
        $arrangementTypeName = $arrangementType->arrangementType->arrangement_type ?? '';
        $pk_arrangement_type = $request->arrangementType ?? '';
        $flower_description  = $floralArrangement->description ?? '';
        $quantity            = $request->quantity ?? 1;
        $price               = $arrangementType->price ?? '0.00';
        $photo               = $image->path ?? '';

        // Add to Cart Session
        $oth_cart           = session()->get('oth_cart');
        $oth_total_quantity = session()->get('oth_total_quantity');
        if (!isset($oth_cart[$request->id])) {
            $oth_cart[$request->id] = [
                "name"                 => $flowerName,
                "arrangementTypesName" => $arrangementTypeName,
                "pk_arrangement_type"  => $pk_arrangement_type,
                "description"          => $flower_description,
                "card_message"         => '',
                "quantity"             => $quantity,
                "price"                => $request->custom_price ?? $price,
                "photo"                => $photo,
                "type"                 => 5
            ];
        } else {
            $oth_cart[$request->id]['quantity']++;
        }

        // Set Total Quantity & Cart Session
        $oth_total_quantity++;
        session()->put('oth_cart', $oth_cart);
        session()->put('oth_total_quantity', $oth_total_quantity);

        // Get Cart HTML for Header
        $htmlCart = view('_header_cart')->render();

        return response()->json([
            'msg'  => 'Product added to cart successfully!',
            'data' => $htmlCart
        ]);
    }

    public function category($category)
    {
        $categoryId = Crypt::decrypt($category);
        $products   = DB::table('kbt_product_category')->get();
        $flowers    = DB::table('kbt_floral_arrangements')
            ->join('kbt_floral_arrangements_images', 'kbt_floral_arrangements.pk_floral_arrangements', 'kbt_floral_arrangements_images.pk_floral_arrangements')
            ->select("kbt_floral_arrangements.*", "kbt_floral_arrangements_images.path")
            ->groupBy('kbt_floral_arrangements.pk_floral_arrangements')
            ->where('kbt_floral_arrangements.pk_product_category', $categoryId)->get();
        return view('floral-arrangement', ['flowers' => $flowers, 'products' => $products, 'categoryId' => $categoryId]);
    }
}
