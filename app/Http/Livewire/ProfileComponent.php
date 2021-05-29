<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class ProfileComponent extends Component
{
    use WithFileUploads;
    public $form= [
        'name'=>'',
        'email'=>'',
        'role_id'=>'',
        'password'=>'',
        'image_url'=>'',
    ];
    public $photo;
    public $user;
    public $page_title;
    public function mount()
    {
        $this->user= auth()->user();
        $this->form=[
            'name'=>$this->user->username,
            'email'=>$this->user->email,
            'password'=>'',
            'status'=>$this->user->status,
            'image_url'=>$this->user->avatarUrl()
        ];
    }

    public function render()
    {


        $this->page_title = "Profile";

        return view('admin.user_management.profile');
    }
    public function update(){

        //dd($this->form);
        $this->validate([
            'form.email' => 'required|email|unique:admins,email,'.$this->user->id,
            'form.name' => 'required',
        ],[],[

                'form.email'=>'email',
                'form.name'=>'name',
            ]
        );
       // dd($this->form);
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
        ]);

      return redirect()->route('home');
    }
}
