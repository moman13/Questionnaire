<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseControllerApi;
use Validator;
use JWTAuth;

use App\User;

class AuthApiController extends BaseControllerApi
{

    public function login(Request $request){
        //dd($request->all());
        $rules = array(
            //  'email'=>'email|required',
            'phone'=>'numeric|required',
            'password'=>'required'
        );
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['status'=>false,'message' => implode('\n',$error->errors()->all()),'code'=>422]);
        }
        $credentials=$request->only(['phone','password']);
        $token =auth('api')->attempt($credentials);
        if(!$token){
            return response()->json(['status'=>false,
                'message'=>'معلومات المرور غير صحيحة',
                'code'=>422

            ]);
        }

        $user = auth('api')->user();
        return [ 'code'=>200,'status'=>true,'message'=>'تم الدخول بنجاح','data'=>['user'=>new UserResource($user),'token' =>$token]];
    }
    public function logout(){
        auth()->logout();
    }
    public function fcmSendAndSetLocation(Request $request){
        if(auth('api')->check()){

        $user=User::findOrFail(auth('api')->user()->id);


            // $user->update($request->all());
            if($request->header('X-Client-Platform-Name')){
                $user->device_type ='ios';
            }else{
                $user->device_type ='android';
            }
            $user->fcm_token = $request['fcm_token'];
            $user->save();

        return response()->json(
            ['status'=>true ,'code'=>200]);
        }


    }
    public function setLocation(Request $request){
        if(auth('api')->check()){

        $user=User::findOrFail(auth('api')->user()->id);
        $user->lat = $request['lat'];
        $user->lng = $request['lng'];
        if($request->header('X-Client-Platform-Name')){
            $user->device_type ='ios';
        }else{
            $user->device_type ='android';
        }
        $user->save();

        return response()->json(
            ['status'=>true ,'code'=>200]);
        }

    }
    public function register(Request $request){

        $rules = array(
            'email'=>'email|required|unique:users,email',
            'phone'=>'required|numeric|unique:users,phone',
            'first_name'=>'required',
            'country_id'=>'required',
            'last_name'=>'required',
            'password'=>'required|min:6'
        );
        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['status'=>false,'message' => implode('\n',$error->errors()->all()),'code'=>422]);
        }

        $user = User::create([
            'email'=>$request->email,
            'first_name' =>$request->first_name,
            'last_name' =>$request->last_name,
            'password'=>bcrypt($request->password),
            'phone'=>$request->phone,
            'status'=>0,
            'is_active'=>1,
            'country_id'=>$request->country_id

        ]);
        $random =$this->generateNDigitRandomNumber(6);
        $user->sms_code=$random;
        $user->save();
        $user->country;
        $message = "رمز التحقق :{$random}";
        send_smsMobile($user->phone,$message);
        if(!$token =auth('api')->attempt($request->only(['phone','password']))){
            return abort(401);
        }
        return [ 'data'=>['token' =>$token ,'user'=>new UserResource($user)],'code'=>200,'status'=>true,'message'=>'تم التسجيل  بنجاح'];

    }

    public function smsCode(Request $request){

        if(auth('api')->user()->sms_code == $request->sms_code){
            $user = User::find(auth('api')->user()->id);
            $user->status =1;
            $user->is_active =1;
            $user->verified =1;
            $user->save();
            $user->country;
            $token = JWTAuth::fromUser($user);
            return response()->json(['status'=>true,'code'=>200,
                'message'=>'تم تفعيل حسابك بنجاح',
                'data'=>['token' =>$token ,'user'=>new UserResource($user)]

            ]);
        }
        return response()->json(['status'=>false,'code'=>406,
            'message'=>'خطأ في الكود ',

        ]);

    }

    public  function resend_sms_code(){
        $user = User::find(auth('api')->user()->id);
        $random =$this->generateNDigitRandomNumber(6);
        $message = "رمز التحقق :{$random}";
        $user->sms_code =$random;
        $user->save();
        $user->country;
        $token = JWTAuth::fromUser($user);
        send_smsMobile($user->phone,$message);

        return response()->json(['status'=>true,
            'message'=>'تم اعادة ارسال كود التفعيل الي جوالك',
            'user'=>new UserResource($user),
            'token' =>$token
        ]);
    }

    public  function generateNDigitRandomNumber($length){
        return mt_rand(pow(10,($length-1)),pow(10,$length)-1);
    }
//
//    public function update(Request $request){
//        $currentUser =auth('api')->user();
//      //  if($currentUser->email != $request->email ||$currentUser->phone != $request->phone ){
////            $rules = array(
////                'email'=>['required', 'string', 'email', 'unique:users,email,'.$currentUser->id],
////                'phone'=>['required', 'numeric', 'unique:users,phone,'.$currentUser->id]
////
////            );
////
////            $error = Validator::make($request->all(), $rules);
////
////            if($error->fails())
////            {
////                return response()->json(['code'=>422,'status'=>false,'message' => implode('\n',$error->errors()->all())]);
////            }
//       // }
//
//        if($request->password){
//            $password = \Hash::make($request->password);
//            $request['password']=$password;
//            $currentUser->password=$password;
//            $currentUser->save();
//        }
//        if($request->image){
//            $allowed_extensions = ['pdf','PDF','txt','TXT','jpeg',"JPEG",'doc',"DOC",
//                'png','PNG','jpg',"JPG","gif","GIF",'ppt',"PPT",'mp4',"MP4",'avi',"AVI",'xls','XLS','docx',
//                'DOCX', 'pptx','PPTX' ,'xlsx', "XLSX",'rar',"RAR", "ZIP",'zip','psd','PSD','jfif']; // must be an array. Extensions disallowed to be uploaded
//            $hidden_extensions = ['php'];
//            $file = $request->image;
//            $extension = \File::extension($file->getClientOriginalName());
//            if(in_array($extension,$allowed_extensions)){
//                $image =saveFile($file,'drivery_user_profile');
//                $data = $request->only('first_name','last_name','email','address','phone','country_id');
//                $data['image'] = $image['path'];
//                $currentUser->update($data);
//            }
//
//        }else{
//            $currentUser->update($request->only('first_name','last_name','address','country_id'));
//        }
//        $currentUser->country;
//        return response()->json(
//            ['status'=>true ,'code'=>200,'data'=>['user'=>$currentUser],'message'=>'Update Profile Success']
//        );
//    }
//    public  function passwordChange(Request $request){
//        $this->validate($request, [
//            'password' => 'required',
//            //'password' => 'required|confirmed',
//        ]);
//        $currentUser =auth('api')->user();
//       // dd($currentUser);
//        if(\Hash::check($request->password_old, $currentUser->password )){
//            $password = \Hash::make($request->password);
//            $request['password'] = $password;
//            $currentUser->password = $password;
//            $currentUser->save();
//        }else{
//            return response()->json(
//                ['status'=>true ,'code'=>422,'data'=>['user'=>$currentUser],'message'=>'password not true']
//            );
//        }
//        $currentUser->country;
//            return response()->json(
//                ['status'=>true ,'code'=>200,'data'=>['user'=>$currentUser],'message'=>'Update Profile Success']
//            );
//
//    }

}
