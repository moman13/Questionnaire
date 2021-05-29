<?php

namespace App\Http\Livewire;

use App\Admin;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\GeneralAttribute;
use Livewire\WithFileUploads;
class UserComponent extends Component
{
    use WithPagination ,WithFileUploads, GeneralAttribute;
    public $form= [
        'name'=>'',
        'email'=>'',
        'role_id'=>'',
        'password'=>'',
        'image_url'=>'',
        'status'=>true,
    ];
    public $user;
    public $roles;
    public $photo;
    protected $listeners = ['Admin_delete'=>'delete'];
    public function mount()
    {
        $this->search_name = request()->query('search_name',$this->search_name);
    }

    public function render()
    {
        $data =Admin::query();
        if($this->search_name){
            $data->where('username','like',"%$this->search_name%")
                ->orWhere('email','like',"%$this->search_name%");
        }
        $data = $data->orderBy('updated_at','desc')->paginate(12);

        return view('admin.user_management.index',
            [
            'data' => $data,
        ]);
    }


    public function create(){
        $this->status = 2;
        $this->roles = \App\Role::all();
        $this->page_title = "Create User";
    }
    public function edit($id){

        $this->status = 3;
        $this->roles = \App\Role::all();
        $this->user = \App\Admin::find($id);
        $this->form=[
            'name'=>$this->user->username,
            'email'=>$this->user->email,
            'role_id'=>$this->user->Role?$this->user->Role->name:null,
            'password'=>'',
            'status'=>$this->user->status,
            'image_url'=>$this->user->avatarUrl()
        ];
        $this->page_title = "Edit User";

    }
    public function update(){
        $roleByName = Role::where('name',$this->form['role_id'])->first();
        $this->validate([
            'form.email' => 'required|email|unique:admins,email,'.$this->user->id,
            'form.name' => 'required',
            'form.role_id' => 'required',
        ],[],[

                'form.email'=>'email',
                'form.name'=>'name',
                'form.role_id'=>'role',
            ]
        );
        if($this->form['password']){
            $password = Hash::make($this->form['password']);
            $this->user->update(['password'=>$password]);
        }
        $photo_store =$this->photo?$this->photo->store('public/avatars'):null;
        $urls = explode('/',$photo_store);
        if($photo_store){
            $this->user->update(['image'=>$urls[2]]);
        }
        $this->user->update([
            'username'=>$this->form['name'],
            'email'=>$this->form['email'],
            'role_id'=>$roleByName->id,
            'status'=>$this->form['status']
        ]);
        $payload = ['type'=>'success','title'=>'Successfully saved!','message'=>'Data has been update '];
        $this->emitTo('notification', 'fireNotification',$payload);
        $this->rest();

    }

    public function save (){
        $password = Hash::make($this->form['password']);
        $roleByName = Role::where('name',$this->form['role_id'])->first();
        $this->validate([
            'form.password' => 'required|min:6',
            'form.email' => 'required|email|unique:admins,email',
            'form.name' => 'required',
            'form.role_id' => 'required',
            'photo' => 'image|max:1024'
        ],[],[
            'form.password'=>'password',
             'form.email'=>'email',
             'form.name'=>'name',
             'form.role_id'=>'role',
            ]
    );
        $photo_store =$this->photo?$this->photo->store('public/avatars'):null;
        $urls = explode('/',$photo_store);
    //    dd($photo_store);
        $create = Admin::create([
            'username'=>$this->form['name'],
            'email'=>$this->form['email'],
            'role_id'=>$roleByName->id,
            'password'=>$password,
            'status'=>$this->form['status'],
            'image'=>$photo_store?$urls[2]:0
        ]);
        $payload = ['type'=>'success','title'=>'Successfully saved!','message'=>'Data has been save '];
        $this->emitTo('notification', 'fireNotification',$payload);
        $this->rest();
    }

    public function destroy($id){
       Admin::find($id)->delete();

    }
    public function rest(){
        $this->form=[
            'name'=>'',
            'email'=>'',
            'role_id'=>'0',
            'password'=>'',
            'status'=>true,
            'image_url'=>'',
        ];
        $this->status  = 1;
        $this->page_title = "";
        $this->search_name;

    }

    public function setStatus(){
        $this->form['status'] = !$this->form['status'];
        dd($this->form['status']);
    }
    public function delete(){

    }




}
