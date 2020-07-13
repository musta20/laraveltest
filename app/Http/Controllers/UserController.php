<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function login(Request $request)
    {
        $rule = [
            'password'=>"required|string",
            'email'=>"required|string|email"];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()){
                return response()->json(["message"=>$validator->errors()], 404);
            }
        $user = User::where('email',$request->email)->first();
            if(!$user || !Hash::check($request->password,$user->password))
            {
                return response()->json(["message"=>"the proviede cordintal is worng"], 401);
            }
                $thetoken =  $user->createToken("thetoken")->plainTextToken;
               

        return $thetoken;
    }

    public function Register(Request $request)
    {
        $rule = [
            'name'=>"required|string|min:5|max:100",
            'password'=>"required|string|min:8|max:100",
            'email'=>"required|string|unique:users|email"];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()){
    
                return response()->json(["message"=>$validator->errors()], 404);
    
            }
        $User = $request->all();
        $User['password'] = Hash::make($request->password);
        $User = User::create($User);
        return response()->json(["message"=>"user created"], 200);
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
