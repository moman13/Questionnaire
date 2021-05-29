<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Validator;

class CustomerApiController extends Controller
{
    public function store(Request $request){
        if($request->customer_id){
            return $this->update($request);
        }
        $rules = array(
            //  'email'=>'email|required',
            'company_name'=>'required',
            'commissioner_name'=>'required',
            'phone'=>'numeric|required|unique:customers,phone',
            'address'=>'required|',
            'whatsapp'=>'required|',
            'email'=>'required|email|unique:customers,email',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['status'=>false,'message' => implode('\n',$error->errors()->all()),'code'=>422]);
        }

        $customer = Customer::create($request->all());
        $customer->user_id = auth('api')->user()->id;
        $customer->save();
        return response()->json(
            [
                'status'=>true,
                'code'=>200,
                'message'=>'success',
                'data'=>['customer'=>$customer],

            ]
        );

    }
    public function update(Request $request){
        $customer=Customer::find($request->customer_id);
        $rules = array(
            //  'email'=>'email|required',
            'company_name'=>'required',
            'commissioner_name'=>'required',
            'phone'=>'numeric|required|unique:customers,phone,'.$customer->id,
            'address'=>'required|',
            'whatsapp'=>'required|',
            'email'=>'required|email|unique:customers,email,'.$customer->id,
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['status'=>false,'message' => implode('\n',$error->errors()->all()),'code'=>422]);
        }

        $customer->update($request->except('customer_id'));
        $customer->user_id = auth('api')->user()->id;
        $customer->save();
        return response()->json(
            [
                'status'=>true,
                'code'=>200,
                'message'=>'success',
                'data'=>['customer'=>new CustomerResource($customer)],

            ]
        );

    }

    public function delete(Request $request){
        $customer=Customer::find($request->customer_id);
        $customer->delete();
        return response()->json(
            [
                'status'=>true,
                'code'=>200,
                'message'=>'Delete Successfully',


            ]
        );

    }

}
