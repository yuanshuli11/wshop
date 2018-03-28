<?php

namespace App\Http\Controllers\Api\User\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function add(){
        return $this->apiResponse(0,"success","调用成功了～");
    }
}
