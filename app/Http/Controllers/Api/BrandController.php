<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return $brands;
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
        $validator = Validator::make($request->all(), [
            'brand' => 'required',
         ]);
        
        if ($validator->fails()) {    
            return response()->json(["errors" => "Brand field required!"], 406);
        }

        $brands = Brand::where('brand', $request->input('brand'))->first();

        if($brands){

            return response()->json(["errors" => "Brand already exists!"], 406);

        } else {
        $brand = new Brand([
            'brand' => $request->input('brand'),
        ]);
        $brand->save();

        return response()->json(["msg" => "Brand created successfully!"], 200);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return $brand;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'brand' => 'required',
         ]);
        
        if ($validator->fails()) {    
            return response()->json(["errors" => "Brand field required!"], 406);
        }

        $brands = Brand::where('brand', $request->input('brand'))->first();

        if($brands){

            return response()->json(["errors" => "Brand already exists!"], 406);

        } else {

        $brand = Brand::find($id);
        $brand->update($request->all());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        // return response()->json('Product deleted!');
    }
}
