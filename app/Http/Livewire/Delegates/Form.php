<?php

namespace App\Http\Livewire\Delegates;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
class Form extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $password;
    public $page_title = 'Create delegates ';
    public $updateMode = false;

    protected $rules = [
        'password' => 'required|min:6',
        'phone' => 'required|numeric|unique:users,phone',
        'first_name' => 'required',
    ];
    public function mount()
    {
        dd(request()->query('id'));
    }

    public function render()
    {
        return view('admin.delegates.form');
    }
    public function save(){

        $this->validate($this->rules);


        $create =User::create([
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'phone'=>$this->phone,
            'password'=>Hash::make($this->password),


        ]);

        return redirect()->route('delegates.index');
    }
}
