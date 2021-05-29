<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function delegates(){
        return $this->belongsTo(User::class,'user_id');
    }
}
