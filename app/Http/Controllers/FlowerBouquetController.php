<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Flower;
use App\ColorFlower;
use App\VaseType;
use App\VaseColor;

class FlowerBouquetController extends Controller {
   
    public function index(){ 
      $flowers      = Flower::all();
      $colorFlowers = ColorFlower::all();
      $vaseTypes    = VaseType::all();
      $vaseColors   = VaseColor::all();
      return view('flower-bouquet',['vaseColors'=>$vaseColors,'flowers'=>$flowers,'colorFlowers'=>$colorFlowers,'vaseTypes'=>$vaseTypes]);
    }

    public function cart(Request $request){


      if($request->isMethod('post')){  

        $validated = $request->validate([
          'flower' => 'required',
          'color' => 'required',
          'price' => 'required',
          'quantity' => 'required',
          'vase_type' => 'required', 
        ]); 

        // Get Flower List Data RJ

        $flowerSubscription = $request->all(); 

        $flower_name = Flower::find($request->flower); 
        $flower_description = !empty($flower_name->description)?$flower_name->description:'';
        $flower_name = !empty($flower_name->flowers)?$flower_name->flowers:'';
        

        $colorflower_name = ColorFlower::find($request->color);
        $colorflower_name = !empty($colorflower_name->color_flower)?$colorflower_name->color_flower:'';

        $vasetype_name    = VaseType::find($request->vase_type);
        $vasetype_name    = !empty($vasetype_name->vase_type)?$vasetype_name->vase_type:'';

        $vasecolors_name    = VaseColor::find(!empty($request->vase_color)?$request->vase_color:'');
        $vasecolors_name    = !empty($vasecolors_name->vase_colors)?$vasecolors_name->vase_colors:'';

        $flower_bouquet_data = join(' - ',array_filter(array($flower_name,$colorflower_name,$vasetype_name,$vasecolors_name))); 

        $quantity = !empty($request->quantity)?$request->quantity:0;
        $price    = !empty($request->price)?$request->price:0;




        // Add in Cart Session RJ

        $oth_cart           = session()->get('oth_cart');
        $oth_total_quantity = session()->get('oth_total_quantity');
        $oth_total_hit      = session()->get('oth_total_hit');

        if($oth_total_hit == '' || $oth_total_hit == null){
            $oth_total_hit = 0;
        }else{
            $oth_total_hit +=1;
        }
        session()->put('oth_total_hit', $oth_total_hit); 

        // if cart is empty then this the first product

        if(!$oth_cart) {

            $oth_cart[$oth_total_hit] = [
                "name" => $flower_bouquet_data,
                "description" => $flower_description,
                "quantity" => $quantity,
                "price" => $price,
                "photo" => '',
                "type" => 4
            ];  

            $oth_total_quantity += 1;
            session()->put('oth_cart', $oth_cart);
            session()->put('oth_total_quantity', $oth_total_quantity);
            session()->put('oth_total_hit', $oth_total_hit+1);


            
            session()->flash('message','Individual flower added to cart successfully!');
            session()->flash('level','success'); 
            return redirect('/other-cart'); 

            //$htmlCart = view('_header_cart')->render(); 
            //return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]); 
        }

        // if cart not empty then check if this product exist then increment quantity

        if(isset($oth_cart[$oth_total_hit])) {

            $oth_cart[$oth_total_hit]['quantity']++;
            $oth_total_quantity += 1;

            session()->put('oth_cart', $oth_cart);
            session()->put('oth_total_quantity', $oth_total_quantity);
            session()->put('oth_total_hit', $oth_total_hit+1); 

            session()->flash('message','Individual flower added to cart successfully!');
            session()->flash('level','success'); 
            return redirect('/other-cart'); 

            //$htmlCart = view('_header_cart')->render();
            //return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);

        }

        // if item not exist in cart then add to cart with quantity = 1
        
        $oth_cart[$oth_total_hit] = [ 
            "name" => $flower_bouquet_data,
            "description" => $flower_description,
            "quantity" => $quantity,
            "price" => $price,
            "photo" => '',
            "type" => 4 
        ];

        $oth_total_quantity += 1;

        session()->put('oth_cart', $oth_cart);
        session()->put('oth_total_quantity', $oth_total_quantity);
        session()->put('oth_total_hit', $oth_total_hit+1);

        session()->flash('message','Individual flower added to cart successfully!');
        session()->flash('level','success'); 
        return redirect('/other-cart'); 

        //$htmlCart = view('_header_cart')->render(); 
        //return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);  

        //echo "<pre>"; print_r($flower_description); die;

        
      }  
      //echo "<pre>"; print_r($flowerSubscription); die;
      //return view('flower-bouquet-cart',['flowers'=>$flowers,'colorFlowers'=>$colorFlowers,'vaseTypes'=>$vaseTypes,'vaseColors'=>$vaseColors,'flowerSubscription' => $flowerSubscription]);
    }


}
