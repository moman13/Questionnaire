<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
class Admin extends Authenticatable
{
    use Notifiable ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'username','image', 'password','status','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function Role()
    {
        return $this->belongsTo(Role::class,   'role_id');
    }
    public function getPermissionByName(){
        $actions=\App\ActionRole::where('admin_id', $this->id)->pluck('name')->toArray();
        if(empty($actions)){
            $actions=\App\ActionRole::where('role_id', $this->id->role_id)->wherenull('admin_id')->pluck('name')->toArray();
        }

    }

    public function avatarUrl(){
        return $this->image?asset('storage/public/avatars/'.$this->image):'https://www.gravatar.com/avatar/'.md5(strtolower(trim($this->email)));
    }


    public function getStatus(){
        if($this->status){
            return ['name'=>'Active','class'=>'bg-green-300'];
        }else{
            return ['name'=>'inActive','class'=>'bg-red-500'];
        }
    }

}
