<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $actions;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $actions=\App\ActionRole::where('admin_id', auth()->user()->id)->pluck('name')->toArray();
            if(empty($actions)){
                $actions=\App\ActionRole::where('role_id', auth()->user()->role_id)->wherenull('admin_id')->pluck('name')->toArray();

            }

            $this->actions =$actions;

            view()->share('actions', $this->actions);


            return $next($request);
        });


    }
}
