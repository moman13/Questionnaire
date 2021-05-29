<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Regin ;
class Regoin extends Component
{
    use WithPagination;
    protected $listeners = [
                            'selected_valueUpdated' => 'selectedValue',
                            'Regin_delete'=>'delete'];
    public $status = 1;
    public $form =[
        'name_en'=>'',
        'name_ar'=>'',
        'city_id'=>'',
    ];
    public $search_name ='';
    public $search_city_id ='';
    public $page_title = '';
    public  $single_object = '';
    public  $button_type = 'Save';
    public $select_value='';
    protected $rules = [
        'name_en' => 'required',
        'name_ar' => 'required',
    ];

    public function mount()
    {
        $this->search_name = request()->query('search_name',$this->search_name);
        $this->search_city_id = request()->query('city_id',$this->search_city_id);

    }
    public function render()
    {
        // get name with _lang (exp name_ar)
//       dd(CityModel::first()->translations['name']);
       // dd($this->search_city_id);
        $data =Regin::query();

        if($this->search_name ){
            $data->where('name','LIKE','%'.$this->search_name.'%');
        }
        if($this->search_city_id ){
            $data->where('city_id',$this->search_city_id);
        }

        $data = $data->orderBy('updated_at','desc')->paginate(12);

        return view('admin.regins.index',[
            'data' => $data,
            'cities'=>\App\City::all()
        ]);

    }
    public function create(){
        $this->rest();
        $this->status=2;
    }
    public function edit( $user){
        $single_object = Regin::find($user);
        $this->form =[
            'name_en'=>$single_object->translations['name']['en'],
            'name_ar'=>$single_object->translations['name']['ar'],
            'city_id'=>$single_object->city_id
        ];
        $this->status = 3;
        $this->button_type ="Update";
        $this->single_object =$single_object;

        $this->select_value =$single_object->city_id;

    }
    public function save(){
        $lang = [
            'en'=>$this->form['name_en'],
            'ar'=>$this->form['name_ar'],

        ];
        $single_object = new Regin;
        $single_object->name=$lang;
        $single_object->city_id=$this->form['city_id'];
        $single_object->save();
     //   $this->rest();
        return redirect()->route('regins.index');
    }

    public function update(){

        $lang = [
            'en'=>$this->form['name_en'],
            'ar'=>$this->form['name_ar'],];


        $this->single_object->name=$lang;
        $this->single_object->city_id=$this->form['city_id'];
        $this->single_object->save();
       // $this->rest();
        return redirect()->route('regins.index');
    }


    public function destroy($user)
    {
        $user = Regin::find($user);

        $user->delete();
    }
    function  rest(){
        $this->search_name='';
        $this->form =[
            'name_en'=>'',
            'name_ar'=>'',
            'city_id'=>'',
        ];
        $this->status = 1;
        $this->search_city_id = '';
        $this->button_type = 'Save';
    }
    public function selectedValue($data){
//dd($data);
        $this->form['city_id']=$data['value'];
    }
    public function delete(){

    }
}
