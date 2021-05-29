<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\AnswerQuestion;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Question;
use Illuminate\Http\Request;

class QuestionApiController extends Controller
{
    public function getAllQuestion(){
        $questions = Question::all();
        return response()->json(
            [
                'status'=>true,
                'code'=>200,
                'message'=>'success',
                'data'=>[
                    'questions'=>QuestionResource::collection($questions)
                ],

            ]
        );


    }

    public function answersSave(Request $request){
        $answer = Answer::find($request->answer_id);
        $questions = Question::find($request->question_id);
        $customer = Customer::find($request->customer_id);
        $user = auth('api')->user();
        $answer_qestion = AnswerQuestion::create([
           'answer_id' =>$answer->id,
           'question_id' =>$questions->id,
           'customer_id' =>$questions->id,
           'user_id' =>$user->id,
        ]);
        return response()->json(
            [
                'status'=>true,
                'code'=>200,
                'message'=>'success',
            ]
        );
    }
}
