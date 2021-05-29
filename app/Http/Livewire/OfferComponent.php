<?php

namespace App\Http\Livewire;

use App\Offer;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\GeneralAttribute;
use Livewire\WithFileUploads;
class OfferComponent extends Component
{
    use WithPagination ,WithFileUploads, GeneralAttribute;
    public $form= [
        'title'=>'',
        'image_url'=>'',
    ];
    public $file;
    protected $listeners = ['Offer_delete'=>'delete'];
    public function mount()
    {
        $this->search_name = request()->query('search_name',$this->search_name);
    }

    public function render()
    {
        $data =Offer::query();
        if($this->search_name){

            $data->where('title','like',"%$this->search_name%");
        }
        $data = $data->orderBy('updated_at','desc')->paginate(12);

        return view('admin.offer.index',
            [
                'data' => $data,
            ]);
    }


    public function create(){
        return redirect()->route('offer.create');
    }
    public function edit($id){
        $url = route('offer.create').'?id='.$id;
        return \Redirect::to($url);
    }

    public function destroy($id){
        Offer::find($id)->delete();

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

    public function download($id){
        $offer = Offer::find($id);
        return redirect()->to($offer->getDocumentUrl());
    }
    public function delete(){

    }
}
