<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded=[];

    public function getDocumentUrl(){

            return asset('storage/public/offers/'.$this->file);//:'https://www.gravatar.com/avatar/'.md5(strtolower(trim($this->email)));

    }
}
