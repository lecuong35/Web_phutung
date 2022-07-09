<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'destroy', 'history', 'confirm']]);
        $this->id = null;
        if(auth()->user() != null) { 
            $this->id = auth()->user()->id;

            $bill = DB::table('bills')
                ->where('handled', '=', false)
                ->where('user_id', '=', $this->id)
                ->where('status', '=', false)
                ->first();

           $this->bill_id = $bill->id;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = DB::table('bills')
                ->where('handled', '=', false)
                ->where('status', '=', true)
                ->leftJoin('users','bills.user_id', '=', 'users.id')
                ->select('bills.*', 'users.name', 'users.phone')
                ->get();

        return response()->json($bills);
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
    public function store(Request $request)
    {
        // $total = 0;
        // $carts = DB::table('carts')
        //            -> where('user_id', '=', $this->id)
        //            ->where('ordered',false)
        //            ->get();

        // if($carts !== null) {

        //     $bills_info = DB::table('carts')
        //                  ->where('ordered', false)
        //                  ->join('products','carts.product_id', '=', 'products.id')
        //                  ->select('carts.quantity', 'products.price', 'carts.id')
        //                  ->get();
        //     foreach($bills_info as $bill_info) {
        //         $quantity = $bill_info->quantity;
        //         $price =  $bill_info->price;
        //         $total = $quantity * $price;

        //         // set carts ordered = true
        //         DB::table('carts')
        //         -> where('id', '=', $bill_info->id)
        //         ->update([
        //             'ordered' => true,
        //         ]);
        //     }
    
            $bill = Bill::create([
                'status' => false,
                'handled' => false,
                'address' => $request->address,
                'able_receive' => $request->able_receive,
                'user_id' => $this->id,
                'total' => $request->total,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json($bill);
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $bills = Bill::query()
                 ->where('user_id', '=', $this->id)
                 ->get();

        return response()->json($bills);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $bill = DB::table('bills')
                ->where('id', '=', $this->bill_id)
                ->update([
                    'status' => true,
                    'address' => $request->address,
                    'able_receive' => $request->able_receive,
                    'total' => $request->total,

                ]);
    }

    public function confirm($id) {
        $this->middleware('auth:admin');
        $bill = DB::table('bills')
                ->where('id', '=', $id)
                ->update([
                    'handled' => true,
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('auth:admin');
        DB::table('bills')
        ->where('id', '=', $id)
        ->delete();

        return response()->json(['message' => 'deleted']);
    }

    //bill history 
    public function history() {
        $this->middleware('auth: admin');

        $turnover['jan'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 1)
        ->sum('total');

        $turnover['feb'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 2)
        ->sum('total');

        $turnover['mar'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 3)
        ->sum('total');

        $turnover['apr'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 4)
        ->sum('total');

        $turnover['may'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 5)
        ->sum('total');

        $turnover['jun'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 6)
        ->sum('total');

        $turnover['jul'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 7)
        ->sum('total');

        $turnover['aug'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 8)
        ->sum('total');

        $turnover['sep'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 9)
        ->sum('total');

        $turnover['oct'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 10)
        ->sum('total');

        $turnover['nov'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 11)
        ->sum('total');

        $turnover['dec'] = DB::table('bills')
        ->where('handled', '=', true)
        ->whereMonth('updated_at', '=', 12)
        ->sum('total');

        return $turnover;
    }
}
