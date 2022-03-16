<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Cars;
use App\Models\Tags;
use Illuminate\Http\Request;
use DB;
use Auth;
use File;
use Session;
use Illuminate\Support\Facades\Validator;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $cars = Cars::leftJoin('brands', 'brands.id', '=', 'cars.brand_id')
        ->leftJoin('cars_tags', 'cars_tags.cars_id', '=', 'cars.id')
        // ->leftJoin('tags', 'tags.id', '=', 'cars_tags.tags_id')
        ->select(
        'cars.id as id',
        'cars.model as model',
        'cars.description as desc',
        'cars.price as price',
        'cars.status as status',
        'cars.engine as engine',
        'cars.image as image',
        'brands.brand as brand',
        DB::raw('GROUP_CONCAT(cars_tags.tag) AS tags')
        )
        ->groupBy( 'cars.id','cars.model','cars.description', 'cars.price','cars.image','brands.brand','cars.status', 'cars.engine')
        ->orderBy('id', 'asc');

        return $cars->get();

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

        $image      = $request->file('img');
        $fileName   = time() . '.' . $image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());

        $img->stream(); // <-- Key point
        $id = rand(0, 255);

        $car = new Cars([
            'id' => $id,
            'brand_id' => $request->input('brand'),
            'model' => $request->input('model'),
            'description' => $request->input('desc'),
            'price' => $request->input('price'),
            'engine' => $request->input('engine'),
            'image' => "/image/$fileName",
        ]);
        
        $car->save();
        
        $cars_tags = DB::table('cars_tags');

        $tags = explode(",", $request->input('tag'));
        
        for($x=0; $x<count($tags);$x++){

        $cars_tags->insert([
            'cars_id' => $id,
            'tag' => $tags[$x],
        ]);

        }

        Storage::disk('public')->put('image'.'/'.$fileName, $img, 'public');        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Cars::with('brand')->find($id);
        return response()->json($car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function edit(Cars $cars)
    {
        //
    }

    public function search($term)
    {   
        // dd($term);
        $cars = Cars::where('model', 'like', "%$term%")
        ->orWhere('engine', 'like', "%$term%")
        ->orWhere('price', 'like', "%$term%");
        return $cars->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {   
        // dd($request->brand);
        // $data = $request->all();
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
            'model' => 'required',
            'price' => 'required',
            'engine' => 'required',

         ]);
        
        if ($validator->fails()) {    
            return response()->json(["errors" => "Each field required!"], 406);
        }

        $car = Cars::find($id);

        $car->brand_id = $request->brand_id;
        $car->model = $request->model;
        $car->price = $request->price;
        $car->engine = $request->engine;

        $car->save();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Cars::find($id);
        
        $car->delete();

        $car->get();

        Storage::disk('public')->delete("{$car->image}");

    }
}
