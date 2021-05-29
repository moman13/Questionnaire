<?php
/**
 * Created by PhpStorm.
 * User: mm_20
 * Date: 24/09/2020
 * Time: 10:54
 */

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BaseControllerApi extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}