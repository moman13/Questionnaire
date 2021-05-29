<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Question extends Model
{
    use HasTranslations;
    protected $guarded=[];


    public $translatable = ['title'];
    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id');
    }

}
