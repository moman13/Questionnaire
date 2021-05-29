<?php

namespace App\Http\Livewire\Delegates;

use App\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
class Index extends Component
{
    use WithPagination;
    public $full_name_search;
    public $phone_search;
    public $status = 1;
    public $first_name;
    public $last_name;
    public $phone;
    public $password;
    public $page_title = 'Create delegates ';
    public $user;
    protected $listeners = ['User_delete'=>'delete'];

    protected $rules = [
        'password' => 'required|min:6',
        'phone' => 'required|numeric|unique:users,phone',
        'first_name' => 'required',
    ];
    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->full_name_search = request()->query('search_name',$this->full_name_search);
    }

    public function render()
    {
        $users =User::query();

        if($this->full_name_search ){
            $users->where('first_name','like',"%$this->full_name_search%")
                ->orWhere('last_name','like',"%$this->full_name_search%")
                ->orWhere('phone','like',"%$this->full_name_search%");
        }

        $users = $users->orderBy('updated_at','desc')->paginate(12);

        return view('admin.delegates.index', [
        'users' => $users,
        ]);
    }
    public function create(){
        $this->rest();
        $this->status=2;
    }

    public function edit( $user){
        $user = User::find($user);
        $this->first_name = $user->first_name;
        $this->last_name=$user->last_name;
        $this->phone=$user->phone;
        $this->status = 3;
        $this->user =$user;
    }
    public function save(){

        $this->validate($this->rules);


        $create =User::create([
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'phone'=>$this->phone,
            'password'=>Hash::make($this->password),


        ]);
        $payload = ['type'=>'success','title'=>'Successfully saved!','message'=>'Data has been save '];
        $this->emitTo('notification', 'fireNotification',$payload);
        $this->rest();
    }

    public function update(){
        $this->validate([

            'phone' => 'required|numeric|unique:users,phone,'.$this->user->id,
            'first_name' => 'required',
        ]);

        $this->user->phone =$this->phone ;
        $this->user->first_name =$this->first_name ;
        $this->user->last_name = $this->last_name ;
        $this->user->save();
        if($this->password){
            $this->user->password =  Hash::make($this->password);
        }

        $payload = ['type'=>'success','title'=>'Successfully saved!','message'=>'Data has been update '];
        $this->emitTo('notification', 'fireNotification',$payload);
        $this->rest();

    }


    public function destroy($user)
    {
        $user = User::find($user);

        $user->delete();
    }
    public function delete(){

    }
    function  rest(){
        $this->first_name='';
        $this->last_name='';
        $this->phone='';
        $this->password='';
        $this->status = 1;
    }
}
