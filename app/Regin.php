<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Regin extends Model
{
    use HasTranslations;
    protected $guarded=[];


    public $translatable = ['name'];

    public function city()
    {
        return $this->belongsTo(City::class );
    }
}
