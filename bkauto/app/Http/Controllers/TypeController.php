<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['index']]);
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
        $types = Type::all();
        return response()->json($types);
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
    public function store(AddTypeRequest $request)
    {
        $type = Type::create([
            'name' => $request->name,
            'code' => $request->code,
            'branch' => $request->branch,
            'describe' => $request->describe,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json($type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(AddTypeRequest $request, $id)
    {
        $type = DB::table('types')
                ->where('id','=', $id)
                ->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'branch' => $request->branch,
                    'describe' => $request->describe,
                    'updated_at' => now(),
                ]);
        
        return response()->json($type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('types')
        ->where('id','=', $id)
        ->delete();

        return response()->json(['message' => 'deleted']);
    }
}
