<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notification extends Component
{
    protected $listeners = ['fireNotification' => 'show'];
    public $status =false;
    public $type;
    public $title;
    public $message;
    public $icon = [
        'success'=>'<svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>',
        'error'=>' <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>'
    ];

    public function render()
    {
        return view('livewire.notification');
    }
    public function show ($data){

        $this->status =true;
        $this->title = $data['title'];
        $this->message = $data['message'];
        $this->type = $data['type'];


    }
}
