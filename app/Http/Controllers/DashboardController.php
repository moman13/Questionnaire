<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
use App\Role;
use App\ActionRole;
class DashboardController extends Controller
{

    public  function  index(){
        $data=\App\Customer::orderBy('created_at','desc')->paginate(10);
        return view('admin.dashboard',compact('data'));
    }

    public function questionSave(Request $request){
       // dd($request->all());
        $lang = [
            'en'=>$request->title_en,
            'ar'=>$request->title_ar
        ];

        $question = Question::create([
            'title'=>$lang
        ]);

        foreach ($request->question_ansers_array as $answer){
            $lang = [
                'en'=>$answer['answers_en'],
                'ar'=>$answer['answers_ar']
            ];
            $create = Answer::create([
                'title'=>$lang,
                'rating'=>$answer['rating'],
                'question_id'=>$question->id
            ]);


        }
        session()->flash('success', 'Successfully save.');
        return redirect()->route('question.index');

    }
    public function questionUpdate(Request $request,Question $question){
       // dd($request->all());
        $lang = [
            'en'=>$request->title_en,
            'ar'=>$request->title_ar
        ];

        $question->update(['title'=>$lang]);
        $question->answers()->delete();
        foreach ($request->question_ansers_array as $answer){
            $lang = [
                'en'=>$answer['answers_en'],
                'ar'=>$answer['answers_ar']
            ];
            $answer = Answer::create([
                'title'=>$lang,
                'rating'=>$answer['rating'],
                'question_id'=>$question->id
            ]);


        }
        session()->flash('success', 'Successfully update.');
        return redirect()->route('question.index');
    }

    public function role_save(Request $request){
      //dd($request->all());
        \DB::beginTransaction();
        $role = Role::create(['name' => $request->name]);
        if($request->permissions){
            foreach( $request->permissions as $items) {
                foreach ($items as $item){
                    ActionRole::create([
                        'name' => $item,
                        'role_id' => $role->id
                    ]);

                }
            }
        }

        \DB::commit();
        session()->flash('success', 'Successfully save.');
        return redirect()->route('role.index');

    }
    public function role_update(Request $request,Role $role){
      //dd($request->all());
        \DB::beginTransaction();
        $role->update(['name' => $request->name]);
        if($request->permissions){
            ActionRole::where('role_id',$role->id)->wherenull('admin_id')->delete();
            foreach( $request->permissions as $items) {
                foreach ($items as $item){
                    ActionRole::create([
                        'name' => $item,
                        'role_id' => $role->id
                    ]);

                }
            }
        }

        \DB::commit();
        session()->flash('success', 'Successfully update.');
        return redirect()->route('role.index');

    }
}
