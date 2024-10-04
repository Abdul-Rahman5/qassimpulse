<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReseravtionResource;
use App\Models\DetailsPlace;
use App\Models\Reservations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationsController extends Controller
{

    public function store(Request $request)
    {
        // validation
      $validator=  Validator::make($request->all(),[
            "user_id"=>"required ",
            "timeVisit"=>"required |string",
            "id"=>"required",
        ]);
        //check $validator
        if ($validator->fails()) {
            return response()->json([
                "errors"=>$validator->errors()

            ],301);
        }
        $user=User::where("id","=",$request->user_id)->first();

        if ($user ==null) {
            return response()->json([
                "message"=>"user not found",
            ],201);
        }
        $place=DetailsPlace::where("id","=",$request->id)->first();

        if ($place ==null) {
            return response()->json([
                "message"=>"place not found",
            ],201);
        }
        $placeName=$place->name;
        $placeType=$place->type;

        //create
        Reservations::create([
            "placeName"=>$placeName,
            "type"=>$placeType,
            "timeVisit"=>$request->timeVisit,
            "user_id"=>$request->user_id,
        ]);
        return response()->json([
            "message"=>"Successfully booked"
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
            // validation
      $validator=  Validator::make($request->all(),[
        "id"=>"required",
    ]);
    //check $validator
    if ($validator->fails()) {
        return response()->json([
            "errors"=>$validator->errors()

        ],301);
    }
    // $userBooked=Reservations::where("user_id","=",$request->id)->get();
    $userBooked=Reservations::select("placeName","created_at")->where("user_id","=",$request->id)->get();

    if (count($userBooked) === 0) {
        return response()->json([
            "message"=>"user not found",
        ],201);
    }
    // return response()->json([
    //     "placeName"=>$userBooked,
    //     // "time"=>$userBooked,
    // ],201);

        // model
        $reservations= Reservations::where("user_id","=",$request->id)->get();
        return ReseravtionResource::collection($reservations);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservations $reservations)
    {
        //
    }
}
