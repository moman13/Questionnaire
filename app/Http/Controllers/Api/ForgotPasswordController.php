<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Transformers\Json;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Password Reset Controller
   |--------------------------------------------------------------------------
   |
   | This controller is responsible for handling password reset emails and
   | includes a trait which assists in sending these notifications from
   | your application to your users. Feel free to explore this trait.
   |
    */
    use SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getResetToken(Request $request)
    {
        $this->validate($request, ['phone' => 'numeric|required']);

        if ($request->input('phone')) {
            $user = User::where('phone', $request->input('phone'))->first();
            if (!$user) {
                return response()->json(
                    ['status'=>false,
                    'message'=>'الهاتف غير موجود']
                );
            }
            $password = $this->generateNDigitRandomNumber(6);

            $hashed_random_password = Hash::make($password);
           // Mail::to($user->email)->send(new SendMailable($user,$password));
            $user->password=$hashed_random_password;
            $user->save();

            $msg = "{$password} كلمة المرور الجديدة :";

            send_smsMobile($user->phone,$msg);

            return response()->json(['status'=>true,
                'password'=>$password,
                'message'=>'تم ارسال بنجاح الرجاء التحقق من الهاتف']);
        }
    }
    public  function generateNDigitRandomNumber($length){
        return mt_rand(pow(10,($length-1)),pow(10,$length)-1);
    }

}

