<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'company_name'=>$this->company_name,
            'commissioner_name'=>$this->commissioner_name,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'whatsapp'=>$this->whatsapp,
            'email'=>$this->email,

        ];//parent::toArray($request);
    }
}
