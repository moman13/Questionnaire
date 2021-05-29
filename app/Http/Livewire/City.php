<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\City as CityModel;
class City extends Component
{
    use WithPagination;

    public $status = 1;
    public $form =[
        'name_en'=>'',
        'name_ar'=>'',
    ];
    public $search_name ='';
    public $page_title = '';
    public  $city = '';
    public  $button_type = 'Save';
    protected $rules = [
        'name_en' => 'required',
        'name_ar' => 'required',
    ];
    protected $listeners = ['City_delete'=>'delete'];
    public function mount()
    {
        $this->search_name = request()->query('search_name',$this->search_name);

    }
    public function render()
    {
        // get name with _lang (exp name_ar)
//       dd(CityModel::first()->translations['name']);
        $data =CityModel::query();

        if($this->search_name ){
            $data->where('name','LIKE','%'.$this->search_name.'%');
        }
        $data = $data->orderBy('updated_at','desc')->paginate(12);

        return view('admin.cities.index', [
            'data' => $data,
        ]);

    }
    public function create(){
        $this->rest();
        $this->status=2;
    }
    public function edit( $user){
        $city = CityModel::find($user);
        $this->form =[
            'name_en'=>$city->translations['name']['en'],
            'name_ar'=>$city->translations['name']['ar'],
        ];
        $this->status = 3;
        $this->button_type ="Update";
        $this->city =$city;
    }
    public function save(){
        $lang = [
            'en'=>$this->form['name_en'],
            'ar'=>$this->form['name_ar'],

        ];
        $city = new CityModel;
        $city->name=$lang;
        $city->save();
        $payload = ['type'=>'success','title'=>'Successfully saved!','message'=>'Data has been save '];
        $this->emitTo('notification', 'fireNotification',$payload);
        $this->rest();
    }

    public function update(){

        $lang = [
            'en'=>$this->form['name_en'],
            'ar'=>$this->form['name_ar']
        ];


        $this->city->name=$lang;
        $this->city->save();

        $payload = ['type'=>'success','title'=>'Successfully saved!','message'=>'Data has been update '];
        $this->emitTo('notification', 'fireNotification',$payload);

        $this->rest();

    }


    public function destroy($user)
    {
        $user = CityModel::find($user);

        $user->delete();
    }
    function  rest(){
        $this->search_name='';
        $this->form =[
            'name_en'=>'',
            'name_ar'=>'',
        ];
        $this->status = 1;
        $this->button_type = 'Save';
    }
    public function delete(){

    }
}
