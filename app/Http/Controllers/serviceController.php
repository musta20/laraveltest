<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\ServiceModel;
use Validator;

class serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(["data"=>ServiceModel::get()],200);

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
    public function getServiceByCat($id)
    {
        $rule = ["id"=>"required|integer|min:1|max:5"];
        $validator = Validator::make(["id"=>$id],$rule);
            
        if($validator->fails())
            {
                return  response()->json($validator->errors(),401);
            }
        $service = ServiceModel::
        join('service_cat', function ($join) {
        $join->on('service.id', '=', 'service_cat.service_id');
                 
        })->where('service_cat.cat_id', $id)->select('service.*')
        ->get();
        
        return response()->json($service,200);

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }


    public function Search($keyword)
    {
     $resulate =  ServiceModel::where('name', 'LIKE', "%{$keyword}%") 
   ->orWhere('description', 'LIKE', "%{$keyword}%") 
   ->get();
        
        return response()->json($resulate,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $rule = ["id"=>"required|integer|min:1"];
        $validator = Validator::make(["id"=>$id],$rule);
            
        if($validator->fails())
            {
                return  response()->json($validator->errors(),401);
            }  
             $service = ServiceModel::find($id);
            if(is_null($service)){
                return response()->json(["message"=>"no data"], 404);
            }
    
            return  response()->json($service, 200);
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
    public function destroy($id)
    {
        //
    }
}
