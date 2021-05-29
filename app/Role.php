<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";
    protected $guarded = [];

    public function getPermissionByName(){
        $actions=\App\ActionRole::where('role_id', $this->id)->wherenull('admin_id')->pluck('name')->toArray();
        return $actions;

    }
}
