<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Answer extends Model
{
    use HasTranslations;
    protected $guarded=[];


    public $translatable = ['title'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
