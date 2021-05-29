<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Traits\GeneralAttribute;
use Livewire\WithFileUploads;
use App\Offer;
class OfferFormComponent extends Component
{
    use WithFileUploads, GeneralAttribute;
    public $form= [
        'title'=>'',
        'rate'=>'',
        'file_url'=>'',
    ];
    public $offer;
    public $file;
    public function mount()
    {
        $this->status=2;
        $this->page_title="Offer Create";
        $id = request()->input('id');
        if($id){
            $this->status=3;
            $this->offer = Offer::find($id);
            $this->form= [
                'title'=>$this->offer->title,
                'rate'=>$this->offer->rate,
                'file_url'=>$this->offer->getDocumentUrl(),
            ];
        }

       // dd($id);
    }

    public function render()
    {
        return view('admin.offer.form');
    }
    public function save(){

        $this->validate([
            'form.title' => 'required',
            'form.rate' => 'required|numeric',
            //'photo' => 'image|max:1024',
            'file' => 'mimes:doc,pdf,docx'
           // 'file' => 'file|size:2024'
        ],[],[
                'form.title'=>'title',
                'form.rate'=>'rate',
                'file'=>'file',
            ]
        );
        $file_store =$this->file?$this->file->store('public/offers'):null;
        $urls = explode('/',$file_store);
        $create = Offer::create([
            'title'=>$this->form['title'],
            'rate'=>$this->form['rate'],
            'file'=>$file_store?$urls[2]:null,
        ]);
        session()->flash('success', 'Successfully save');
        return redirect()->route('offer.index');
    }
    public function update(){
        $this->validate([
            'form.title' => 'required',
            'form.rate' => 'required|numeric',
        ],[],[
                'form.title'=>'title',
                'form.rate'=>'rate',
            ]
        );
        if($this->file){
            $file_store =$this->file?$this->file->store('public/offers'):null;
            $urls = explode('/',$file_store);
            $this->offer->update(['file'=>$file_store?$urls[2]:null]);
        }
        $this->offer->update([
            'title'=>$this->form['title'],
            'rate'=>$this->form['rate'],
        ]);
        session()->flash('success', 'Successfully save');
        return redirect()->route('offer.index');
    }

}
