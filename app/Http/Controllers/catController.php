<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\model\CatModel;
use Validator;

class catController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return response()->json(["data"=>CatModel::get()],200);
       $cat_Array =[];
       $data = CatModel::where('categories.parent', 0)->get();
      // return response()->json($data,200);

        foreach ($data as &$item){
            $sub_cat = $this->GetSubCatByCatId($item->id);
            if(count($sub_cat) !=0){
            array_push($cat_Array,["cat"=>$item,"sub_cat"=> $sub_cat]);
        }
        }
        return response()->json($cat_Array,200);
       // return $cat_Array;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     

    }
//gettheparentbyserv

public function gettheparentbyserv ($id){
    $cat_id = DB::table('service_cat')->where('service_id',$id)->get();
  
    return response()->json($this->GetSCatId([],$cat_id[0]->cat_id),200);
}


public function gettheparent($id) {
        
   return response()->json($this->GetSCatId([],$id),200);
}

public function GetSCatId($cat_Array,$id)
    {
         if($id!=0){
            $cat = CatModel::find($id);
           array_push($cat_Array,$cat);
      return     $this->GetSCatId($cat_Array,$cat->parent);
        }
        else {

            return $cat_Array;

        }
    
}

    public function getParentCat($id)
    {
       $cat_Array =[];
     
       $data = CatModel::where('categories.id', $id)->get();

        foreach ($data as &$item){
            $sub_cat = $this->GetSubCatByCatId($item->id);
            if(count($sub_cat) !=0){
            array_push($cat_Array,["cat"=>$item,"sub_cat"=> $sub_cat]);
        }
        }
        return response()->json($cat_Array,200);
    }


    public function GetSubCatByCatId($id)
    {
        
        $cat = CatModel::where('categories.parent', $id)->select('categories.*')
        ->get();
        
        return $cat;

    }

    public function GetSubCatByCat($id)
    {
        $rule = ["id"=>"required|integer|min:1|max:5"];
        $validator = Validator::make(["id"=>$id],$rule);
            
        if($validator->fails())
            {
                return  response()->json($validator->errors(),401);
            }
        $cat = CatModel::
        join('sub_cat', function ($join) {
        $join->on('categories.id', '=', 'sub_cat.sub_cat');
                 
        })->where('sub_cat.cat', $id)->select('categories.*')
        ->get();
        
        return response()->json($cat,200);

    }


    //SELECT categories.id , categories.cat_name FROM `categories` 



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = ['cat_name'=>"required|string|min:4|max:15"];
        $validator = Validator::make($request->all(),$rule);
            
        if($validator->fails())
            {
                return  response()->json($validator->errors(),401);
            }
        $cat = CatModel::create($request->all());
            return response()->json($cat, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = CatModel::find($id);
        if(is_null($cat)){
        return response()->json(["message"=>"no data"],404);
                         }

                         
        $sub_cat = $this->GetSubCatByCatId($cat->id);
        if(!is_null($cat)){
            $cat->sub_cat= $sub_cat;
                             }
        return response()->json($cat,200);
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
        $rule = [
            'cat_name'=>"required|string|min:4|max:15"];

        $validator = Validator::make($request->all(),$rule);
        if($validator->fails()){

            return response()->json(["message"=>$validator->errors()], 400);

        }

        $cat = CatModel::find($id);
        $cat->update($request->all());

        return response()->json($cat, 200);
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

 

    public function gettheKids($id) {
        
        //return 
       
        echo'[';
        $this->GetSCatIdKids(array(),intval($id),0);
        echo "]";
         
      //  json_encode();

         }
      
         public function GetSCatIdKids($cat_Array,$id,$Start)
         {

            
            $cat = CatModel::where('categories.parent', $id)->get();
            if(count($cat) != 0){
                if($id !=0){
                    $cat_name_all = CatModel::find($id);
                    $cat_name = $cat_name_all->cat_name;
                    $parent = $cat_name_all->parent;
                }else{
                    $cat_name ="zero";
                    $parent =0;
                }
                    $x = new rowobj();
                    $x->id = $id;
                    $x->cat_name =  $cat_name;
                    $x->parent =  $parent;
                    $x->kids = $cat;
                
                 if($Start!=0){
                     echo ",";
                   }
    
     echo json_encode($x);

                
                
                    foreach ($cat as  &$value) {

                            $this->GetSCatIdKids($cat_Array,$value->id,1);
                    }
                       
            }else{
               
            }

         
            }




            public function getAlltheKids($id) {
        
                //return 
               
                echo'[';
                $this->GetAllSCatIdKids(array(),intval($id),0);
                echo "]";
                 
              //  json_encode();
        
                 }
              
                 public function GeAlltSCatIdKids($cat_Array,$id,$Start)
                 {
                    $cat = CatModel::where('categories.parent', $id)->get();     
                    if(count($cat) != 0){
                        
                          $x = new rowobj();
                          $x->id = $id;
                                $x->kids = $cat;
                             if($Start!=0){
                                 echo ",";
                               }
                
                 echo json_encode($x);
        
                            foreach ($cat as  &$value) {
        
                                    $this->GetSCatIdKids($cat_Array,$value->id,1);
                            }
                               
                    }else{
                       
                    }
        
                 
                    }
        
        




}
class rowobj{
    public $id;
    public $kids;
    public  $cat_name;
    public  $parent;
   // public $cat_array= array();

 }