<?php

namespace App\Http\Controllers;

use App\Mail\HelloMail;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $email;
    protected $place_id = [];

    //register
   public function register(Request $request)  {
   $validator= Validator::make($request->all(),[
        "name"=>"required|string|max:255",
        "email"=>"required|email|unique:users,email",
        "phone"=>"required|max:20",
        "password"=>"required|min:6 |confirmed",

    ]);
    if ($validator->fails()) {

        return response()->json([
            "errors"=>$validator->errors()
        ],301);
    }
    //password has
    $password=bcrypt($request->password);
    $access_token= Str::random(64);
    //create
   $users= User::create([
        "name"=>$request->name,
        "email"=>$request->email,
        "phone"=>$request->phone,
        "password"=>$password,
        "access_token"=>$access_token
    ]);
    //OTP
    // $users->notify(new EmailVerificationNotification);

    //msg
    return response()->json([
        "success"=>"you registerd successflly",
        "access_token"=>$access_token
    ],201);

    }
    public function login(Request $request)
    {
        //vaildation
        $validator= Validator::make($request->all(),[
            "email"=>"required|email",
            "password"=>"required|min:6 ",

        ]);
        if ($validator->fails()) {

            return response()->json([
                "errors"=>$validator->errors()
            ],301);
        }
        //chech (email,password)
       $user= User::where("email","=",$request->email )->first();
       if ($user !== null) {
        # password
        $oldPassword=$user->password ;//hashed
        $access_token=Str::random(64);
      $isVerified=  Hash::check($request->password,$oldPassword);
      if ($isVerified) {
        # update...
        $user->update([
            "access_token"=>$access_token
        ]);
        return response()->json([
            "message"=>"you logged in successfuly",
            "id"=>$user->id,
            "name"=>$user->name,
            "email"=>$user->email,
            "phone"=>$user->phone,
            "access_token"=>$access_token,

        ],200);
      } else {
        # erorr...
        return response()->json([
            "message"=>"credintials not correct"
        ],404);
      }
       }else{
        return response()->json([
            "message"=>"This account not exist"
        ],404);
       }
        //update accessToken
        //msg

    }
    public function logout(Request $request)
    {
        # accessToken
       $access_token= $request->header('access_token');
       if ($access_token !==null) {
      $user=  User::where("access_token","=",$access_token)->first();
      if ($user !==null) {
        $user->update([
            "access_token"=>null
        ]);
        return response()->json([
            "message"=>"you logged out successfuly"
        ],200);
      } else {
        return response()->json([
            "message"=>"access token not correct"
        ],301);
      }
       } else {
        return response()->json([
            "message"=>"access token not found"
        ],404);
       }
        //founded
        //update access token to null
    }
    public function forgotPassword(Request $request) {
        // email
       $email= $request->email;
       if ($email !==null) {
        $user=  User::where("email","=",$email)->first();
        // $users=User::all();
        //chech this email esxits in DB
        if ($user !==null) {
        //send OTP
        // EmailVerificationNotification
        // $user->notify(new EmailVerificationNotification() );
        $token_otp= random_int(100000, 999999);
        $this->email=$user->email;
        // Mail::to("abdulrahmanom568@gmail.com")->send(new HelloMail($token_otp));
        Mail::raw(' Hello '.$user->name  . "
        use the below code for resetting your password
        code: $token_otp
        ", function ($message) {
            $message->to($this->email)
              ->subject('code: ');
          });
          //new otp
          $user->update([
            "token_OTP"=>$token_otp
        ]);

        return response()->json([
            "message"=>"An email has been sent"
        ],200);

        } else {
            return response()->json([
                "message"=>"email not correct"
            ],301);
        }

       } else {
        return response()->json([
            "message"=>"email not found"
        ],404);
       }

    }
    public function restPassword(Request $request)
    {
        //check number
        $user = User::where('email', $request->email)->first();

        if ($user !==null) {
          if ($user->token_OTP==$request->otp) {
            $user->update([
                "token_OTP"=>null,
            ]);

              return response()->json([
                  "message"=>"successflly",
              ],200);
          } else {
              return response()->json([
                  "message"=>"your number not correct"
              ],301);
          }


        } else {
         return response()->json([
             "message"=>"Email not found"
         ],404);
        }



    }
    public function newPassword(Request $request)
    {
        //email password rePassword
        //vaildation
        $validator= Validator::make($request->all(),[
            "email"=>"required|email",
            "password"=>"required|min:6 |confirmed",
        ]);
        if ($validator->fails()) {

            return response()->json([
                "errors"=>$validator->errors()
            ],301);
        }
        //hash password
       $user= User::where("email","=",$request->email )->first();
      $password=bcrypt($request->password);
        //update
      if ($user) {
        $user->update([
            "password"=>$password
        ]);

      }else{
        return response()->json([
            "message"=>"not found",
        ],301);
      }

        //massage
        return response()->json([
            "message"=>"Done successfuly",
        ],200);

    }
    public function updatePassword(Request $request)
    {
        $validator= Validator::make($request->all(),[
            "id"=>"required",
            "oldPassword"=>"required|min:6",
            "newPassword"=>"required|min:6 |confirmed",
        ]);
        if ($validator->fails()) {

            return response()->json([
                "errors"=>$validator->errors()
            ],301);
        }
        //---------
          //chech (email,password)
       $user= User::where("id","=",$request->id )->first();
       if ($user !== null) {
        # password
        $oldPasswordDb=$user->password ;//hashed
      $isVerified=  Hash::check($request->oldPassword,$oldPasswordDb);
      if ($isVerified) {
        # update...
        $user->update([
            "password"=>$request->newPassword
        ]);
        return response()->json([
            "message"=>"Password changed  successfuly",

        ],200);
      } else {
        # erorr...
        return response()->json([
            "message"=>"This password not correct"
        ],404);
      }
       }else{
        return response()->json([
            "message"=>"This account not exist"
        ],404);
       }


    }
    public function updateProflie(Request $request)
    {
        $validator= Validator::make($request->all(),[
            "id"=>"required",
            "name"=>"string",
            "email"=>"email",
            "phone"=>"string",
        ]);
        if ($validator->fails()) {

            return response()->json([
                "errors"=>$validator->errors()
            ],301);
        }
        //---------
    //    $user= User::where("id","=",$request->id )->first();
       $user= User::find($request->id);

       if ($user ==null) {
        return response()->json([
            "message"=>"This account not exist",
        ],404);
       }
       //update
       if ($request->name !=null) {
        $user->update([
            "name"=>$request->name,
        ]);
       }
       if ($request->email !=null) {
       $emailEx= User::where("email","=",$request->email)->first();
       if ($emailEx) {
        return response()->json([
            "message"=>"This email already exists",
        ],404);
       }
        $user->update([
            "email"=>$request->email,
        ]);
       }
       if ($request->phone !=null) {
        $user->update([
            "phone"=>$request->phone,
        ]);
       }
        //msg
    return response()->json([
        "success"=>"user updated successfuly",
    ],201);


    }




}
