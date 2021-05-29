<?php

namespace App\Http\Livewire;

use App\Question;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
class QuestionLiveWired extends Component
{
    use WithPagination;
    public $answers = [['answers_en' => '', 'answers_ar' => '','rating'=>''],
        ['answers_en' => '', 'answers_ar' => '','rating'=>''],
        ['answers_en' => '', 'answers_ar' => '','rating'=>''],
        ['answers_en' => '', 'answers_ar' => '','rating'=>'']
        ];

    public $status = 1;
    public $form =[
        'title_en'=>'',
        'title_ar'=>'',
    ];
    public $question = '';
    public $full_name_search ='';
    public $page_title ='Create';
    protected $listeners = ['Question_delete'=>'delete'];
    public function mount()
    {

        $this->search_name = request()->query('full_name_search',$this->full_name_search);


    }
    public function render()
    {
        // get name with _lang (exp name_ar)

        $data =Question::query();

        if($this->full_name_search ){
            $data->where('title','LIKE','%'.$this->full_name_search.'%');
        }
        $data = $data->orderBy('updated_at','desc')->paginate(12);

        return view('admin.question.index', [
            'data' => $data,
        ]);

    }

    public function create(){
        $this->rest();

        $this->status=2;

    }
    function  rest(){
        $this->page_title='Create';
        $this->search_name='';
        $this->status = 1;
    }

    function edit($id){
        $question = Question::find($id);
        $answers = $question->answers;
        $this->answers=[];
        //$city->translations['name']['en'];
        foreach ($answers as $answer){
            $arrayPrepare=['answers_en' => $answer->translations['title']['en'], 'answers_ar' => $answer->translations['title']['ar'],'rating'=>$answer->rating];
            $this->answers[]=$arrayPrepare;
        }
        $this->form =[
            'title_en'=>$question->translations['title']['en'],
            'title_ar'=>$question->translations['title']['ar'],
        ];
        $this->question = $question;
        $this->status = 3;

    }
    public function destroy($id)
    {
        $record = Question::find($id);

        $record->delete();
    }
    public function addHeader()
    {

        $this->answers[] = ['answers_en' => '', 'answers_ar' => '','rating'=>''];
    }
    public function removeHeader(int $i)
    {
        unset($this->answers[$i]);

        $this->answers = array_values($this->answers);
    }

    public function delete(){

    }

}
