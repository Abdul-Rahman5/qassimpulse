<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequset;
use Illuminate\Http\Request;
use Otp;
class EmailVerificationController extends Controller
{
    private $otp;
    public function __construct() {
        $this->otp =new Otp;
    }
    public function number_verification(Request $request)  {
        $otp2=$this->otp->validate($request->otp);
        if (!$otp2->status ) {
            return response()->json([
                "message"=>$otp2
               ],401);

        }else{
            return response()->json([
                "message"=>"successfuly"
               ],200);
        }



    }
}
