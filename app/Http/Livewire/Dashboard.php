<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data=\App\Customer::orderBy('created_at','desc')->paginate(10);

        return view('admin.dashboard',compact('data'));
        //return view('livewire.dashboard');
    }
}
