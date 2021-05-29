<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;

class GeneralApiController extends Controller
{
    public function home(Request $request){
        $currentUser = auth('api')->user()->id;
        $getCustomerForThisUser = Customer::query();
        if($request->search_query){
            $getCustomerForThisUser
                ->where('first_name','like',"%$request->search_query%")
                ->orWhere('last_name','like',"%$request->search_query%");
        }
        $getCustomerForThisUser = $getCustomerForThisUser->orderBy('created_at','desc')->paginate(10);
        return response()->json(
            [
                'status'=>true,
                'code'=>200,
                'message'=>'success',
                'data'=>[
                    'customers'=>CustomerResource::collection($getCustomerForThisUser),

                ],

            ]
        );
    }
}
