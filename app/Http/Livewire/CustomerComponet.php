<?php

namespace App\Http\Livewire;

use App\Customer;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\GeneralAttribute;

class CustomerComponet extends Component
{
    use WithPagination , GeneralAttribute;
    public $form=[
            'company_name'=>'',
            'commissioner_name'=>'',
            'phone'=>'',
            'address'=>'',
            'whatsapp'=>'',
            'email'=>'',
    ];
    public $customer;

    protected $listeners = ['Customer_delete'=>'delete'];
    public function mount()
    {
        $this->search_name = request()->query('search_name',$this->search_name);
    }

    public function render()
    {
        $data =Customer::query();
        $search=$this->search_name;
        if($this->search_name){
            $data->whereHas('delegates', function($q) use($search){

                $q->where('first_name', 'LIKE', '%'.$search.'%')->orWhere('last_name', 'LIKE', '%'.$search.'%');
            })
            ->orWhere('company_name','like',"%$this->search_name%")
                ->orWhere('commissioner_name','like',"%$this->search_name%")
                ->orWhere('phone','like',"%$this->search_name%")
                ->orWhere('address','like',"%$this->search_name%")
                ->orWhere('whatsapp','like',"%$this->search_name%")
                ->orWhere('email','like',"%$this->search_name%");
        }
       // dd($data->with('delegates')->get());
        $data = $data->orderBy('updated_at','desc')->paginate(12);

        return view('admin.customer.index',
            [
                'data' => $data,
            ]);
    }


    public function edit($id){
        $customer =Customer::find($id);
        $this->form=[
            'company_name'=>$customer->company_name,
            'commissioner_name'=>$customer->commissioner_name,
            'phone'=>$customer->phone,
            'address'=>$customer->address,
            'whatsapp'=>$customer->whatsapp,
            'email'=>$customer->email,
        ];
        $this->status = 3;
        $this->page_title='Edit Customer';
        $this->customer = $customer;
    }

    public function update(){
        $this->validate([
            'form.company_name'=>'required',
            'form.commissioner_name'=>'required',
            'form.phone'=>'numeric|required|unique:customers,phone,'. $this->customer->id,
            'form.address'=>'required',
            'form.whatsapp'=>'required',
            'form.email'=>'required|email|unique:customers,email,'. $this->customer->id,
        ],[],[
            'form.company_name'=>'company name',
            'form.commissioner_name'=>'commissioner name',
            //'form.phone'=>'phone',
            //'form.address'=>'address',
            //'form.whatsapp'=>'whatsapp',
            //'form.email'=>'required|email|unique:customers,email,'. $this->customer->id,
        ]);
        $this->customer->update($this->form);

        $payload = ['type'=>'success','title'=>'Successfully saved!','message'=>'Data has been update '];
        $this->emitTo('notification', 'fireNotification',$payload);
        $this->status = 1;

    }
    public function delete(){

    }
}
