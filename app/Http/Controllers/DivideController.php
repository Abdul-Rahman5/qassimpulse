<?php

namespace App\Http\Controllers;

use App\Http\Resources\DivideResource;
use App\Models\Divide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DivideController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     //dashpord
    public function index()
    {
       $divides= Divide::all();
       return view("admin.allDiv",compact("divides"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.createSection");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            "name"=>"required|string|max:255",
          "image"=>"required|image|mimes:png,jpg,jpeg",
        ]);
        //store image
        $data['image']=   Storage::putFile("imageSection",$data['image']);
        Divide::create($data);
        return redirect(url('createSection'))->with("success","data inserted successfuly");










        
    //     //api
    //     $validator= Validator::make($request->all(),[
    //         "name"=>"required|string|max:255",
    //         "image"=>"required|image|mimes:png,jpg,jpeg",

    //     ]);
    //     if ($validator->fails()) {

    //         return response()->json([
    //             "errors"=>$validator->errors()
    //         ],301);
    //     }
    //     //stor
    //   $imageName=  Storage::putFile("divide",$request->image);

    //     //create
    //     $divide= Divide::create([
    //         "name"=>$request->name,
    //         "image"=>$$imageName,
    //     ]);
    //     return response()->json([
    //         "success"=>"Section added successfully",
    //     ],201);



    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $divide=Divide::all();
        return DivideResource::collection($divide);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $product=Divide::findOrFail($id);
        return view("admin.editDiv",compact("product"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $data=$request->validate([
            "name"=>"required|string|max:255",
          "image"=>"image|mimes:png,jpg,jpeg",
        ]);
        $product=Divide::findOrFail($id);
            if ($request->has("image")) {
               Storage::delete($product->image);
               $data['image']=   Storage::putFile("imageSection",$data['image']);
            }
        //store image
        $product->update($data);
        return redirect(url("showSection/$id"))->with("success","data updated   successfuly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $product=Divide::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();
       return  redirect(url('allSection'))->with("success","data deleted successfuly");


    }
    public function showSection($id)
    {
        $product= Divide::findOrFail($id);
        return view("admin.showDiv",compact("product"));
    }

}
