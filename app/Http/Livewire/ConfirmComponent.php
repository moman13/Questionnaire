<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfirmComponent extends Component
{
    public $status;
    public $info ;
    protected $listeners = ['confirm'];
    public function render()
    {
        return view('livewire.confirm-component');
    }

    public function confirm($data){
        //dd($data);
        $array_split = explode('_',$data);
        $this->info =$array_split;
        $this->status =1;
    }

    public  function delete(){
        $class = 'App\\'.$this->info[0];
        $instance = new $class;
        $instance::find($this->info[1])->delete();
        $this->status = 2;
        $this->emit($this->info[0].'_delete');
    }
    public  function cancel(){
        $this->status = 0;
    }
    public  function ok(){
        $this->status = 0;
    }

}
