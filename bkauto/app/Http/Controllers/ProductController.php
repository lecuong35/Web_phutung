<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Http\Requests\AddProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['show','sortByTpye', 'searchByName','exportIntoExcel', 'index']]);
        $this->id = null;
        if(auth()->guard('admin')->user() != null) {
            $this->id = auth()->guard('admin')->user()->id;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
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
    public function store(AddProductRequest $request)
    {
        if($request->hasFile('image')) {
            $destination_path = 'public/images/products';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $image_name);
            // Storage::putFile('photos', new File('/public/storage/images/products'));
            $request->image = $image_name;

            // return $path;

         }

        $product  = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'describe' => $request->describe,
            'image' =>$request->image,
            'type_id' => $request->type_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')
                   ->where('id','=', $id)
                   ->get();

        return response()->json($product);
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
    public function update(AddProductRequest $request, $id)
    {
        $input = $request->all();
        if($request->hasFile('image')) {
            $destination_path = 'public/images/products';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path, $image_name);
            $input['image'] = $image_name;

        }

        DB::table('products')
        ->where('id','=', $id)
        ->update([
          'name' => $input['name'],
          'price' => $input['price'],
          'describe' => $input['describe'],
          'image' => $input['image'],
          'type_id' => $input['type_id'],
          'updated_at' => now(),
        ]);

        $product = DB::table('products')
        ->where('id','=', $id)
        ->get();

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =  DB::table('products')
        ->where('id','=', $id)
        ->count();
       if($product > 0) {
           DB::table('products')
           ->where('id','=', $id)
           ->delete();

           return response()->json(['message' => 'deleted']);
       }
       return response()->json(['error' => 'this product is not exist']);
    }


    // sort - search by type
    public function sortById($id)
    {
        $product = DB::table('products')
        ->where('id','=', $id)
        ->get();

        return response()->json($product);
    }

    //search by name
    public function searchByName($name) 
    {
        $products = Product::query()
                   ->where('name','LIKE', "%{$name}%")
                   ->get();

        return response()->json($products);
    }

    // xuat file bao gia
    public function exportIntoExcel()
    {
        return Excel::download(new ProductExport, 'bangbaogiaBKAuto.xlsx');
    }
}
