<?php

namespace App\Http\Controllers;

use App\Models\CustomerService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerServiceController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $validator=   Validator::make($request->all(),[
                "fullName"=>"required|string",
                "email"=>"required|email",
                "topic"=>"required|string",
                "subject"=>"required|string",
        ]);
        $user=User::where("email","=",$request->email)->first();
        //check Email
        if ($user != true) {
            return response()->json([
                "errors"=>"your email not found"

            ],301);
        }
        //check $validator
        if ($validator->fails()) {
            return response()->json([
                "errors"=>$validator->errors()

            ],301);
        }
         //create
         CustomerService::create([
            "fullName"=>$request->fullName,
            "email"=>$request->email,
            "topic"=>$request->topic,
            "subject"=>$request->subject,
        ]);
        return response()->json([
            "message"=>"Done Successfully "
        ],201);
    }
    public function show()
    {
        // $products=product::all();
        // return view("admin.all",compact("products"));
        $messages=CustomerService::all();
        // return view("admin.Contact",compact("messages");
           return view("admin.Contact",compact("messages"));


    }
}
