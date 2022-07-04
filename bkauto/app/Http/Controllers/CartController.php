<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['cartForBill']]);
        
        $this->id = null;
        if(auth()->user() != null) {
            $this->id = auth()->user()->id;
            $bill = DB::table('bills')
                   ->where('user_id', '=', $this->id)
                   ->where('status', '=', false)
                   ->where('handled', '=', false)
                   ->first();
            
            if($bill != null) {
                $this->bill_id = $bill->id;
            }
            else{
                $newBill = Bill::create([
                    'status' => false,
                    'handled' => false,
                    'address' => auth()->user()->phone,
                    'able_receive' => now(),
                    'user_id' => $this->id,
                    'total' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $this->bill_id = $newBill->id;
            }
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = DB::table('carts')
                ->where('user_id', '=', $this->id)
                ->where('ordered', '=', false)
                ->leftJoin('products','carts.product_id', '=', 'products.id')
                ->select('carts.*', 'products.name', 'products.price', 'products.image')
                ->get();

        return response()->json($carts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        
        $cart = Cart::create([
            'user_id' => $this->id,
            'bill_id' => $this->bill_id,
            'product_id' => $id,
            'quantity' => 1,
            'ordered' => false,
            'handled' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);
           
        return response()->json($cart);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showHistory()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($bill_id)
    {
        $carts = DB::table('carts')
        ->where('bill_id','=', $bill_id)
        ->update([
           'handled' => true
        ]);
        return response()->json($carts);
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
        $cart = DB::table('carts')
                ->where('id','=', $id)
                ->update([
                    'quantity' => $request->quantity, 
                    'ordered' => true,
                    'updated_at' => now(),
                ]);
        return response()->json($cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::table('carts')
            ->where('id','=', $id)
            ->delete();
        
        return response()->json(['deleted']);
    }

    public function history() 
    {
        $carts = DB::table('carts')
                ->where('user_id', '=', $this->id)
                ->where('ordered', '=', true)
                ->leftJoin('products','carts.product_id', '=', 'products.id')
                ->select('carts.*', 'products.name', 'products.price', 'products.image')
                ->get();

        return response()->json($carts);
    }

    public function cartForBill() {
        $this->middleware('auth: admin');
        $carts = DB::table('carts')
        ->where('ordered', '=', true)
        ->where('handled', '=', false)
        ->leftJoin('products','carts.product_id', '=', 'products.id')
        ->select('carts.*', 'products.name', 'products.price')
        ->get();

        return response()->json($carts);
    }
}