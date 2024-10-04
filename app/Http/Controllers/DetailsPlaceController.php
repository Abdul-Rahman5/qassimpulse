<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailsPlaceResource;
use App\Models\DetailsPlace;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DetailsPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailsPlace = DetailsPlace::all();
        return DetailsPlaceResource::collection($detailsPlace);
    }
    public function create()
    {
        return view("admin.createPlace");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storePlace(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "type" => "required|string|max:255",
            "data" => "required|string|max:500",
            "evaluation" => "required|string",
            "contact" => "required|string",
            "timeVisit" => "required|string",
            "images" => "required|image|mimes:png,jpg,jpeg",
            "link" => "required",
        ]);
        //store
        $data['images'] =   Storage::putFile("DetailsPlace", $data['images']);

        DetailsPlace::create($data);
        return redirect(url('createPlace'))->with("success", "data inserted successfuly");


        // api
        //         $validator= Validator::make($request->all(),[
        //             "name"=>"required|string",
        //             "type"=>"required|string|max:255",
        //             "data"=>"required|string|max:500",
        //             "evaluation"=>"required|string",
        //             "contact"=>"required|string",
        //             "timeVisit"=>"required|string",
        //             "images"=>"required|image|mimes:png,jpg,jpeg",
        //             "link"=>"required",
        //     ]);
        //     //errors
        //     if ($validator->fails()) {

        //         return response()->json([
        //             "errors"=>$validator->errors()
        //         ],301);
        //     }
        //     //storage
        //   $imageName=  Storage::putFile("DetailsPlace",$request->images);
        //     //create
        //      DetailsPlace::create([
        //            "name"=>$request->name,
        //             "type"=>$request->type,
        //             "data"=>$request->data,
        //             "evaluation"=>$request->evaluation,
        //             "contact"=>$request->contact,
        //             "timeVisit"=>$request->timeVisit,
        //             "images"=>$imageName,///image Upload
        //             "link"=>$request->link,
        //     ]);
        //     return response()->json([
        //         "success"=>" added successfully",
        //     ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
         //validation
         $validator =   Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()

            ], 404);
        }

        $detailsPlace = DetailsPlace::where("id", "=", $request->id)->get();

        return DetailsPlaceResource::collection($detailsPlace);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //id
        //validation
        $validator =   Validator::make($request->all(), [
            "id" => "required",
            "user_id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()

            ], 404);
        }
        $addFav = DetailsPlace::where("id", "=", $request->id)->where('user_id', '=', '')->first();
        if ($addFav) {
            $addFav->update([
                "fav" => 1,
            ]);

            return response()->json([
                "message" => "Successfully added to favorites"

            ], 201);
        } else {
            return response()->json([
                "message" => "error"

            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function favorite(Request $request)
    {
        //validation
        $validator =   Validator::make($request->all(), [
            "id" => "required",
            "place_id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()

            ], 404);
        }
        //check user exits or not
        $user = User::where("id", "=", $request->id)->first();
        if ($user) {
            //check place exits or not
            $place = DetailsPlace::where("id", "=", $request->place_id)->first();
            if ($place) {

                // array_push
                // القيمة الحالية لـ place_id
                $currentPlaceIds = json_decode($user->place_id, true);

                // التحقق من وجود القيمة الحالية وتحويلها إلى مصفوفة إذا كانت `null`
                $currentPlaceIds = is_array($currentPlaceIds) ? $currentPlaceIds : [];

                if (!in_array($request->place_id, $currentPlaceIds)) {
                    $currentPlaceIds[] = $request->place_id;

                    // قم بتحديث القيمة في قاعدة البيانات
                    $user->update([
                        "place_id" => $currentPlaceIds
                    ]);
                    return response()->json([
                        "message" => "Added to favorite ",
                    ], 200);
                } else {
                    // رسالة خطأ أو إجراء آخر إذا كان الرقم موجودًا بالفعل
                    return response()->json([
                        "message" => "place already exists",

                    ], 404);
                }
            } else {
                return response()->json([
                    "errors" => "place not found"
                ], 301);
            }
        } else {
            return response()->json([
                "errors" => "user not found"
            ], 404);
        }
    }
    public function favoriteShow(Request $request)
    {
        //validation
        $validator =   Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()

            ], 404);
        }
        $user = User::where("id", "=", $request->id)->first();
        if ($user) {
            //
            $favUser = json_decode($user->place_id, true);
            if ($favUser==null) {
                return response()->json([
                    "message" => "no data founded",
                ], 301);
            }
            $startNumber = min($favUser);
            $allPlaceData = [];

            foreach ($favUser as $item) {
                # code...
                $detailsPlace = DetailsPlace::select('id', 'name', 'type', 'data', 'evaluation', 'contact', 'timeVisit', "images")
                    ->where("id", "=", $item)->get();
                $allPlaceData[] = $detailsPlace;
            }

            return response()->json([
                "allPlace" => $allPlaceData,
            ], 200);
        } else {
            return response()->json([
                "errors" => "user not found"

            ], 404);
        }
    }
    public function removeFavorite(Request $request)
    {
        //validation
        $validator =   Validator::make($request->all(), [
            "id" => "required",
            "place_id" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()

            ], 404);
        }

        //check user exits or not
        $user = User::where("id", "=", $request->id)->first();
        if ($user) {
            $favUser = json_decode($user->place_id, true);
            $allPlaceData = [];
            foreach ($favUser as $item) {
                # code...
                $detailsPlace = $item;
                $allPlaceData[] = $item;
            }

            $keyFavRemo= array_search($request->place_id, $allPlaceData);

            // Check if the key is found (not equal to false)
            if ($keyFavRemo !== false) {
                // Remove the element with the found key
                 unset($allPlaceData[$keyFavRemo]);
                 $user->update([
                    "place_id" => $allPlaceData
                ]);
            }
            return response()->json([
                "message" => "Successfully removed from favorites",
                // "test" => $element,
            ], 404);
        } else {
            return response()->json([
                "errors" => "user not found"

            ], 404);
        }
    }
    ///////////////////////////////////////web
    public function allPlace(){
        $places=DetailsPlace::all();
        return view("admin.allPlace",compact("places"));
    }
    public function showPlace($id){
        $place=DetailsPlace::findOrFail($id);
        return view("admin.showPlace",compact("place"));
    }
    public function showPlaceEdit($id){
        $place=DetailsPlace::findOrFail($id);
        return view("admin.editPlace",compact("place"));
    }
    public function PlaceUpdate( Request $request , $id){
        $data = $request->validate([
            "name" => "required|string",
            "type" => "required|string|max:255",
            "data" => "required|string|max:500",
            "evaluation" => "required|string",
            "contact" => "required|string",
            "timeVisit" => "required|string",
            "images" => "image|mimes:png,jpg,jpeg",
            "link" => "required",
        ]);
        // findOrFail
        $place=DetailsPlace::findOrFail($id);
        if ($request->has("images")) {
            Storage::delete($place->images);
            $data['images']=   Storage::putFile("DetailsPlace",$data['images']);
        }
        $place->update($data);
        return redirect(url("showPlace/$id"))->with("success","data updated  successfuly");

    }
    public function destroy( $id)
    {
        $place=DetailsPlace::findOrFail($id);
        Storage::delete($place->images);
        $place->delete();
        return  redirect(url('allPlace'))->with("success","data deleted successfuly");




    }
}
