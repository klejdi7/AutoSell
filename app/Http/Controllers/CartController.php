<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Cars;
use App\Models\Cart;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
	Get Cart Items
	*/
    public function index()
    {
        $data = Session::get('cart');

        if(!$data){
            
            return response()->json([ 'cart_msg' => 'Cart is Empty' ], 406);
            
        }
        else{ 

            $total = array_sum(array_column($data, 'price_t'));

            return response()->json([ 'cart' => $data, 'total' => $total, 'count' => count($data) ], 200);
            
        }
    }

    /*
	Check if item exists in cart
	*/
    public function show()
    {   
        
        $data = Session::get('cart');

        if(!$data){

            return response()->json([ 'check' => false ], 200);
        }

        else {

            $keys = array_column($data, 'car', 'car_id');

            return response()->json([ 'cart' => $keys, 'count' => count($data)], 200);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {   

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
            ]);
        
        if ($validator->fails()) {    
            return response()->json(["errors" => "All fields are required!"], 406);
        }
        $data = Session::get('cart');

        if(!$data){

            return response()->json(["errors" => "Cannot checkout with empty cart!"], 406);

        }

        else if(!Auth::check()){

            return response()->json(["errors" => "You need to log in to checkout!"], 406);

        }

        else {

        $user_id = Auth::user()->id;
        $name = $request->input('name');
        $state = $request->input('state');
        $city = $request->input('city');
        $zip = $request->input('zip');
        $total = array_sum(array_column($data, 'price_t'));
        
        $order_id = rand(0, 255);

        DB::table('clients')->insert([
            'order_id' => $order_id,
            'user_id' => $user_id,
            'name' => $name,
            'state' => $state,
            'city' => $city,
            'zip' => $zip,
            'total' => $total,
        ]);
        
        $items = DB::table('items_purchased');

        foreach($data as $d) {
        $items->insert([
            'order_id' => $order_id,
            'user_id' => $user_id,
            'car' => $d['car'],
            'quantity' => $d['qty'],
            'price' => $d['price_s'],
            'total' => $d['price_t'],
        ]);
        }

            Session::put('cart');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*
	Add cart item
	*/
    public function addToCart(Request $request) {

        $id = $request->input('id');
        $car = $request->input('car');
        $price = $request->input('price');
        $qty = 1;
        $cart = array(
            'car_id' => $id,
            'car' => $car,
            'qty' => $qty,
            'price_s' => $price,
            'price_t' => $price * $qty,
        );
        $car_id = $cart['car_id'];
        // settype($car_id, "string");

        Session::push( "cart" , $cart);

        return response()->json([ 'cart_msg' => "Item added to cart!" ], 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*
	Edit cart item quantity
	*/
    public function edit($id, Request $request)
    {

        $data = session()->get('cart');
        
        $q = $request->input('q');
        
        if($data){

            $keys = array_column($data, 'car_id');

            $c = array_combine($keys, $data);

            if (array_key_exists($id, $c)) {

                $c[$id]['qty'] = $q;
                $c[$id]['price_t'] = $c[$id]['price_s'] * $q;

                Session::put('cart', $c);
                
                return response()->json('Updated', 200);
            }
        }
        else {

            return response()->json([ 'cart_msg' => 'Cart is Empty' ], 400);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /*
	Remove cart item
	*/
    public function destroy($id)
    {

        $data = session()->get('cart');
        
        if($data){

            $keys = array_column($data, 'car_id');

            $c = array_combine($keys, $data);

            if (array_key_exists($id, $c)) {

                unset($c[$id]);

                Session::put('cart', $c);
                
                return response()->json('Deleted', 200);
            }
        }
        else {

            return response()->json([ 'cart_msg' => 'Cart is Empty' ], 400);

        }
    }
}